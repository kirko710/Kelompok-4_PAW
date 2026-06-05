<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Venue;
use App\Models\Lapangan;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $venues = Venue::active()->latest()->take(6)->get();
        return view('home.index', compact('venues'));
    }

    public function adminDashboard()
    {
        $userId = Auth::id();

        // ── 1. Total Pendapatan (pembayaran paid, venue milik owner ini) ────────
        $totalPendapatan = Pemesanan::whereHas('lapangan.venue', fn($q) => $q->where('id_user', $userId))
            ->whereHas('pembayaran', fn($q) => $q->where('status_bayar', 'paid'))
            ->sum('total_harga');

        // ── 2. Pemesanan Hari Ini ───────────────────────────────────────────────
        $pemesananHariIni = Pemesanan::whereDate('tanggal_pesan', today())
            ->whereHas('lapangan.venue', fn($q) => $q->where('id_user', $userId))
            ->count();

        $sedangBerlangsung = Pemesanan::whereDate('tanggal_pesan', today())
            ->where('status_pesanan', 'confirmed')
            ->whereHas('lapangan.venue', fn($q) => $q->where('id_user', $userId))
            ->count();

        // ── 3. Jumlah Lapangan milik owner ─────────────────────────────────────
        $totalLapangan = Lapangan::whereHas('venue', fn($q) => $q->where('id_user', $userId))
            ->count();

        // Pemesanan pending menunggu konfirmasi
        $pemesananPending = Pemesanan::where('status_pesanan', 'pending')
            ->whereHas('lapangan.venue', fn($q) => $q->where('id_user', $userId))
            ->count();

        // ── 4. Grafik 7 hari terakhir (total pendapatan per hari) ───────────────
        $chartRaw = Pemesanan::selectRaw('DATE(tanggal_pesan) as hari, SUM(total_harga) as total')
            ->whereHas('lapangan.venue', fn($q) => $q->where('id_user', $userId))
            ->whereHas('pembayaran', fn($q) => $q->where('status_bayar', 'paid'))
            ->where('tanggal_pesan', '>=', now()->subDays(6)->toDateString())
            ->groupBy('hari')
            ->pluck('total', 'hari');

        $chartData = collect(range(6, 0))->map(function ($daysAgo) use ($chartRaw) {
            $date  = now()->subDays($daysAgo);
            $total = (float) ($chartRaw[$date->toDateString()] ?? 0);
            return ['day' => $date->translatedFormat('D'), 'total' => $total, 'date' => $date->toDateString()];
        });

        $maxTotal  = $chartData->max('total') ?: 1; // hindari division by zero
        $chartData = $chartData->map(fn($d) => array_merge($d, [
            'pct' => max(4, (int) round(($d['total'] / $maxTotal) * 85)),
        ]));

        // Y-axis labels (dibagi 4 level dari max ke 0)
        $yLabels = collect(range(3, 0))->map(function ($i) use ($maxTotal) {
            $val = ($maxTotal / 3) * $i;
            return $val >= 1_000_000
                ? number_format($val / 1_000_000, 1) . 'Jt'
                : number_format($val / 1_000, 0) . 'K';
        })->toArray();

        // ── 5. Notifikasi: pembayaran pending menunggu verifikasi ───────────────
        $notifPembayaran = Pembayaran::with(['pemesanan.user', 'pemesanan.lapangan'])
            ->where('status_bayar', 'pending')
            ->whereHas('pemesanan.lapangan.venue', fn($q) => $q->where('id_user', $userId))
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalPendapatan',
            'pemesananHariIni',
            'sedangBerlangsung',
            'totalLapangan',
            'pemesananPending',
            'chartData',
            'yLabels',
            'notifPembayaran'
        ));
    }

    public function adminLaporan()
    {
        $userId = Auth::id();
        $vf = fn($q) => $q->where('id_user', $userId);

        // ── Stat Cards ──────────────────────────────────────────────────────────
        $totalPendapatan = Pemesanan::whereHas('lapangan.venue', $vf)
            ->whereHas('pembayaran', fn($q) => $q->where('status_bayar', 'paid'))
            ->sum('total_harga');

        $pemesananPaid = Pemesanan::select('waktu_mulai', 'waktu_selesai')
            ->whereHas('lapangan.venue', $vf)
            ->whereHas('pembayaran', fn($q) => $q->where('status_bayar', 'paid'))
            ->get();
        $totalJamBooking = $pemesananPaid->sum(
            fn($p) => Carbon::parse($p->waktu_mulai)->diffInHours(Carbon::parse($p->waktu_selesai))
        );

        $totalPelanggan = Pemesanan::whereHas('lapangan.venue', $vf)
            ->distinct()->count('id_user');

        // ── Rincian Per Lapangan ────────────────────────────────────────────────
        $rincianLapangan = Lapangan::withCount([
                'pemesanans as total_booking' => fn($q) =>
                    $q->whereHas('pembayaran', fn($pq) => $pq->where('status_bayar', 'paid')),
            ])
            ->withSum([
                'pemesanans as total_pendapatan' => fn($q) =>
                    $q->whereHas('pembayaran', fn($pq) => $pq->where('status_bayar', 'paid')),
            ], 'total_harga')
            ->whereHas('venue', $vf)
            ->orderByDesc('total_booking')
            ->get();

        // ── Chart Data (7 hari = mingguan, 30 hari = harian) ───────────────────
        $past7  = collect(range(6, 0))->map(fn($d) => now()->subDays($d)->toDateString());
        $past30 = collect(range(29, 0))->map(fn($d) => now()->subDays($d)->toDateString());

        $tren7raw = Pemesanan::selectRaw('DATE(tanggal_pesan) as hari, COUNT(*) as jumlah')
            ->whereHas('lapangan.venue', $vf)
            ->whereHas('pembayaran', fn($q) => $q->where('status_bayar', 'paid'))
            ->where('tanggal_pesan', '>=', now()->subDays(6)->toDateString())
            ->groupBy('hari')->pluck('jumlah', 'hari');

        $tren30raw = Pemesanan::selectRaw('DATE(tanggal_pesan) as hari, COUNT(*) as jumlah')
            ->whereHas('lapangan.venue', $vf)
            ->whereHas('pembayaran', fn($q) => $q->where('status_bayar', 'paid'))
            ->where('tanggal_pesan', '>=', now()->subDays(29)->toDateString())
            ->groupBy('hari')->pluck('jumlah', 'hari');

        $lapangans      = Lapangan::whereHas('venue', $vf)->get();
        $lapanganColors = ['rgb(99,102,241)', 'rgb(251,146,60)', 'rgb(34,211,238)', 'rgb(251,191,36)', 'rgb(167,139,250)', 'rgb(52,211,153)'];

        $buildDatasets = function ($dates) use ($lapangans, $lapanganColors) {
            return $lapangans->map(function ($lap, $idx) use ($dates, $lapanganColors) {
                $raw = Pemesanan::selectRaw('DATE(tanggal_pesan) as hari, COUNT(*) as jumlah')
                    ->where('id_lapangan', $lap->id)
                    ->whereHas('pembayaran', fn($q) => $q->where('status_bayar', 'paid'))
                    ->where('tanggal_pesan', '>=', $dates->first())
                    ->groupBy('hari')->pluck('jumlah', 'hari');
                return [
                    'label'           => $lap->nama,
                    'data'            => $dates->map(fn($d) => (int) ($raw[$d] ?? 0))->values()->toArray(),
                    'backgroundColor' => $lapanganColors[$idx % count($lapanganColors)],
                    'borderRadius'    => 2,
                ];
            })->values()->toArray();
        };

        $chartDataJson = [
            'mingguan' => [
                'labels'   => $past7->map(fn($d) => Carbon::parse($d)->translatedFormat('D'))->values()->toArray(),
                'tren'     => $past7->map(fn($d) => (int) ($tren7raw[$d] ?? 0))->values()->toArray(),
                'datasets' => $buildDatasets($past7),
            ],
            'harian' => [
                'labels'   => $past30->map(fn($d) => Carbon::parse($d)->format('j'))->values()->toArray(),
                'tren'     => $past30->map(fn($d) => (int) ($tren30raw[$d] ?? 0))->values()->toArray(),
                'datasets' => $buildDatasets($past30),
            ],
        ];

        return view('admin.laporan', compact(
            'totalPendapatan', 'totalJamBooking', 'totalPelanggan',
            'rincianLapangan', 'chartDataJson', 'lapanganColors'
        ));
    }

    public function adminJadwal()
    {
        $userId = Auth::id();

        $lapangans   = Lapangan::whereHas('venue', fn($q) => $q->where('id_user', $userId))->get();
        $lapanganIds = $lapangans->pluck('id')->toArray();

        $pemesananHariIni = Pemesanan::with(['user', 'lapangan'])
            ->whereHas('lapangan.venue', fn($q) => $q->where('id_user', $userId))
            ->whereDate('tanggal_pesan', today())
            ->whereIn('status_pesanan', ['pending', 'confirmed'])
            ->get();

        $colorMap = ['confirmed' => 'green', 'pending' => 'pink'];

        $events = $pemesananHariIni->map(function ($p) use ($lapanganIds, $colorMap) {
            $lapIdx  = array_search($p->id_lapangan, $lapanganIds);
            $mulai   = Carbon::parse($p->waktu_mulai);
            $selesai = Carbon::parse($p->waktu_selesai);
            $start   = $mulai->hour + $mulai->minute / 60;
            $dur     = max(0.5, $mulai->diffInMinutes($selesai) / 60);
            return [
                (int) ($lapIdx !== false ? $lapIdx : 0),
                $start,
                $dur,
                ucfirst($p->status_pesanan),
                optional($p->user)->name ?? '-',
                $colorMap[$p->status_pesanan] ?? 'pink',
            ];
        })->toArray();

        $detailPemesanan = $pemesananHariIni->where('status_pesanan', 'confirmed')->first()
            ?? $pemesananHariIni->first();

        // ── Kalender bulan ini ─────────────────────────────────────────────────
        $now         = now();
        $firstDay    = $now->copy()->startOfMonth();
        $startOffset = $firstDay->dayOfWeek === 0 ? 6 : $firstDay->dayOfWeek - 1;
        $daysInMonth = $now->daysInMonth;
        $calendarWeeks = [];
        $currentWeek   = array_fill(0, $startOffset, null);
        for ($d = 1; $d <= $daysInMonth; $d++) {
            $currentWeek[] = $d;
            if (count($currentWeek) === 7) { $calendarWeeks[] = $currentWeek; $currentWeek = []; }
        }
        if (!empty($currentWeek)) {
            while (count($currentWeek) < 7) $currentWeek[] = null;
            $calendarWeeks[] = $currentWeek;
        }

        // ── Deteksi konflik jadwal hari ini ────────────────────────────────────
        $konflikList = collect();
        foreach ($lapangans as $lap) {
            $pemLap = $pemesananHariIni->where('id_lapangan', $lap->id)->sortBy(fn($p) => Carbon::parse($p->waktu_mulai)->timestamp);
            $prev = null;
            foreach ($pemLap as $pem) {
                if ($prev && Carbon::parse($pem->waktu_mulai)->lt(Carbon::parse($prev->waktu_selesai))) {
                    $konflikList->push($lap->nama);
                    break;
                }
                $prev = $pem;
            }
        }

        return view('admin.jadwal', compact(
            'lapangans', 'events', 'detailPemesanan', 'now', 'calendarWeeks', 'konflikList'
        ));
    }

    public function adminProfile()
    {
        $user    = Auth::user()->load('profile', 'venues.lapangans');
        $profile = $user->profile;
        $venue   = $user->venues->first();
        $totalLapangan = $user->venues->sum(fn($v) => $v->lapangans->count());

        $bookingBulanIni = Pemesanan::whereHas('lapangan.venue', fn($q) => $q->where('id_user', $user->id))
            ->whereMonth('tanggal_pesan', now()->month)
            ->whereYear('tanggal_pesan', now()->year)
            ->count();

        $pendapatanBulanIni = Pemesanan::whereHas('lapangan.venue', fn($q) => $q->where('id_user', $user->id))
            ->whereHas('pembayaran', fn($q) => $q->where('status_bayar', 'paid'))
            ->whereMonth('tanggal_pesan', now()->month)
            ->whereYear('tanggal_pesan', now()->year)
            ->sum('total_harga');

        return view('admin.profile', compact(
            'user', 'profile', 'venue', 'totalLapangan',
            'bookingBulanIni', 'pendapatanBulanIni'
        ));
    }

    public function adminProfileEdit()
    {
        $user    = Auth::user()->load('profile', 'venues');
        $profile = $user->profile;
        $venue   = $user->venues->first();
        return view('admin.profile-edit', compact('user', 'profile', 'venue'));
    }

    public function adminProfileUpdate(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'telepon'        => 'nullable|string|max:20',
            'alamat'         => 'nullable|string|max:500',
            'tanggal_lahir'  => 'nullable|date',
        ]);

        $user = Auth::user();
        $user->update(['name' => $request->name]);

        \App\Models\UserProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'nama_lengkap'  => $request->name,
                'telepon'       => $request->telepon,
                'alamat'        => $request->alamat,
                'tanggal_lahir' => $request->tanggal_lahir,
            ]
        );

        return redirect()->route('admin.profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function adminRekeningUpdate(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'bank'     => 'required|string|max:100',
            'rekening' => 'required|string|max:50',
        ]);

        $user = Auth::user();

        \App\Models\UserProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'bank'     => $request->bank,
                'rekening' => $request->rekening,
            ]
        );

        return redirect()->route('admin.profile')->with('success', 'Info rekening berhasil diperbarui.');
    }
}
