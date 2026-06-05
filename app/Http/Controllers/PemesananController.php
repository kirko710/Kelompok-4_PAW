<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Pembayaran;
use App\Models\Lapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PemesananController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_lapangan'   => 'required|exists:lapangans,id',
            'tanggal_pesan' => 'required|date|after_or_equal:today',
            'waktu_mulai'   => 'required|date_format:H:i:s',
            'waktu_selesai' => 'required|date_format:H:i:s|after:waktu_mulai',
        ]);

        $lapangan = Lapangan::findOrFail($request->id_lapangan);

        $mulai = Carbon::createFromFormat('H:i:s', $request->waktu_mulai);
        $selesai = Carbon::createFromFormat('H:i:s', $request->waktu_selesai);
        $durasiMenit = $mulai->diffInMinutes($selesai);
        $durasiJam = $durasiMenit / 60;

        $totalHarga = $lapangan->harga_sewa * $durasiJam;

        $pemesanan = Pemesanan::create([
            'id_user'        => Auth::id(),
            'id_lapangan'    => $lapangan->id,
            'tanggal_pesan'  => $request->tanggal_pesan,
            'waktu_mulai'    => $request->waktu_mulai,
            'waktu_selesai'  => $request->waktu_selesai,
            'total_harga'    => $totalHarga,
            'status_pesanan' => 'pending', 
        ]);

        Pembayaran::create([
            'id_pemesanan'      => $pemesanan->id,
            'metode_pembayaran' => 'transfer_bank',
            'status_bayar'      => 'pending',
        ]);

        return redirect()->route('pemesanan.detail', ['id' => $pemesanan->id])
                         ->with('success', 'Pesanan berhasil dibuat. Silakan lanjutkan ke pembayaran.');
    }

    public function detailPemesanan($id)
    {
        $pemesanan = Pemesanan::with(['lapangan.venue', 'pembayaran'])
            ->where('id_user', Auth::id())
            ->findOrFail($id);

        if ($pemesanan->cekDanBatalJikaKedaluwarsa()) {
            return redirect()->back()->with('error', 'Pesanan Anda telah dibatalkan otomatis karena melewati batas waktu pembayaran 1 jam.');
        }
    
        return view('penyewa.detail-pemesanan', compact('pemesanan'));
    }

    public function halamanPembayaran($id)
    {
        $pemesanan = Pemesanan::with('pembayaran')
            ->where('id_user', Auth::id())
            ->findOrFail($id);

        return view('penyewa.pembayaran', compact('pemesanan'));
    }

    public function prosesPembayaran(Request $request, $id)
    {
        $pemesanan = Pemesanan::where('id_user', Auth::id())->findOrFail($id);
        $pembayaran = Pembayaran::where('id_pemesanan', $pemesanan->id)->firstOrFail();

        $pembayaran->update([
            'metode_pembayaran'  => $request->metode_pembayaran ?? $pembayaran->metode_pembayaran,
            'status_bayar'       => 'pending', // Menunggu verifikasi owner
            'tanggal_pembayaran' => now(),
            'nomor_referensi'    => $request->nomor_referensi,
        ]);

        return redirect()->route('pemesanan.detail', ['id' => $pemesanan->id])
                         ->with('success', 'Pembayaran sedang diproses. Menunggu verifikasi admin.');
    }

    public function showRiwayat($id)
    {
        $pemesanan = Pemesanan::with(['lapangan.venue', 'pembayaran'])
            ->where('id_user', \Illuminate\Support\Facades\Auth::id())
            ->findOrFail($id);

        return view('penyewa.riwayat-detail', compact('pemesanan'));
    }

    public function riwayatIndex(Request $request)
    {
        $currentStatus = $request->query('status', 'all');

        $query = Pemesanan::with(['lapangan.venue', 'pembayaran'])
            ->where('id_user', \Illuminate\Support\Facades\Auth::id())
            ->orderBy('created_at', 'desc');

        if ($currentStatus !== 'all') {
            $query->where('status_pesanan', $currentStatus);
        }

        $riwayat = $query->get();

        if ($request->ajax() || $request->wantsJson()) {
            $mappedRiwayat = $riwayat->map(function ($item) {
                $statusText = '';
                if ($item->status_pesanan == 'pending') $statusText = 'Menunggu';
                elseif ($item->status_pesanan == 'confirmed') $statusText = 'Dikonfirmasi';
                elseif ($item->status_pesanan == 'completed') $statusText = 'Selesai';
                else $statusText = 'Dibatalkan';

                return [
                    'id' => $item->id,
                    'status_pesanan' => $item->status_pesanan,
                    'status_text' => $statusText,
                    'venue_nama' => $item->lapangan->venue->nama ?? 'Venue',
                    'lapangan_nama' => $item->lapangan->nama ?? 'Lapangan',
                    // Format waktu & angka langsung dari backend agar rapi
                    'tanggal_main' => \Carbon\Carbon::parse($item->tanggal_pesan)->translatedFormat('d F Y'),
                    'waktu_mulai' => \Carbon\Carbon::parse($item->waktu_mulai)->format('H:i'),
                    'waktu_selesai' => \Carbon\Carbon::parse($item->waktu_selesai)->format('H:i'),
                    'id_pesanan_format' => '#ORD-' . str_pad($item->id, 5, '0', STR_PAD_LEFT),
                    'total_harga_format' => number_format($item->total_harga * 1.12, 0, ',', '.'),
                    // URL Actions
                    'detail_url' => route('riwayat.detail', $item->id),
                    'bayar_url' => route('pembayaran.show', $item->id),
                ];
            });

            return response()->json([
                'status' => 'success',
                'data' => $mappedRiwayat
            ]);
        }

        return view('penyewa.riwayat', compact('riwayat', 'currentStatus'));
    }

    // Menampilkan semua daftar pemesanan (Riwayat Keseluruhan)
    public function adminIndex()
    {
        // Eager Loading user, lapangan, dan pembayaran untuk menghindari N+1 query
        $pemesanans = Pemesanan::with(['user', 'lapangan', 'pembayaran'])->latest()->get();
        return view('admin.pemesanan', compact('pemesanans'));
    }

    // Endpoint AJAX untuk filter & search daftar pemesanan (return JSON)
    public function adminFilter(Request $request)
    {
        $query = Pemesanan::with(['user', 'lapangan', 'pembayaran'])
            ->latest()
            // Filter: nama pelanggan (LIKE)
            ->when($request->search, function ($q) use ($request) {
                $q->whereHas('user', function ($uq) use ($request) {
                    $uq->where('name', 'LIKE', '%' . $request->search . '%');
                });
            })
            // Filter: status_pesanan
            ->when($request->status && $request->status !== 'all', function ($q) use ($request) {
                $q->where('status_pesanan', $request->status);
            })
            // Filter: status_bayar (via relasi pembayaran)
            ->when($request->pembayaran && $request->pembayaran !== 'all', function ($q) use ($request) {
                $filterBayar = $request->pembayaran === 'paid' ? 'paid' : ['unpaid', 'pending', 'failed'];
                $q->whereHas('pembayaran', function ($pq) use ($filterBayar) {
                    if (is_array($filterBayar)) {
                        $pq->whereIn('status_bayar', $filterBayar);
                    } else {
                        $pq->where('status_bayar', $filterBayar);
                    }
                });
            })
            // Filter: rentang tanggal (N hari terakhir)
            ->when($request->rentang && $request->rentang !== 'all', function ($q) use ($request) {
                $hari = (int) $request->rentang;
                $q->where('tanggal_pesan', '>=', Carbon::now()->subDays($hari)->toDateString());
            });

        $pemesanans = $query->get();

        $data = $pemesanans->map(function ($p) {
            // Hitung durasi dari selisih waktu_mulai dan waktu_selesai
            $mulai   = Carbon::parse($p->waktu_mulai);
            $selesai = Carbon::parse($p->waktu_selesai);
            $durasi  = $mulai->diffInHours($selesai);

            // Label status pembayaran
            $statusBayar      = optional($p->pembayaran)->status_bayar ?? 'unpaid';
            $statusBayarLabel = $statusBayar === 'paid' ? 'Lunas' : 'Belum Lunas';

            // Label status pesanan
            $labelMap = [
                'pending'   => 'Menunggu',
                'confirmed' => 'Dikonfirmasi',
                'completed' => 'Selesai',
                'cancelled' => 'Dibatalkan',
            ];
            $statusPesananLabel = $labelMap[$p->status_pesanan] ?? ucfirst($p->status_pesanan);

            // Tombol Batalkan hanya muncul jika status masih bisa dibatalkan
            $bisaBatalkan = in_array($p->status_pesanan, ['pending', 'confirmed']);

            return [
                'id'                  => $p->id,
                'nama_pelanggan'      => optional($p->user)->name ?? '-',
                'lapangan'            => optional($p->lapangan)->nama ?? '-',
                'tanggal'             => Carbon::parse($p->tanggal_pesan)->translatedFormat('d F Y'),
                'waktu_mulai'         => Carbon::parse($p->waktu_mulai)->format('H:i'),
                'waktu_selesai'       => Carbon::parse($p->waktu_selesai)->format('H:i'),
                'durasi'              => $durasi . ' Jam',
                'status_bayar'        => $statusBayar,
                'status_bayar_label'  => $statusBayarLabel,
                'status_pesanan'      => $p->status_pesanan,
                'status_pesanan_label'=> $statusPesananLabel,
                'bisa_batalkan'       => $bisaBatalkan,
            ];
        });

        return response()->json([
            'status' => 'success',
            'data'   => $data,
        ]);
    }

    // Menampilkan daftar pesanan yang butuh verifikasi pembayaran
    public function adminVerifikasiIndex()
    {
        // Menggunakan Eloquent Has (whereHas) untuk memfilter pemesanan yang pembayarannya berstatus 'pending'
        $pemesanans = Pemesanan::with(['user', 'lapangan', 'pembayaran'])
            ->whereHas('pembayaran', function ($query) {
                $query->where('status_bayar', 'pending');
            })->latest()->get();

        return view('admin.verifikasi', compact('pemesanans'));
    }

    // Eksekusi verifikasi pembayaran oleh Owner
    public function verifikasiPembayaran(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pembayaran = Pembayaran::where('id_pemesanan', $pemesanan->id)->firstOrFail();

        if ($request->action === 'terima') {
            $pembayaran->update(['status_bayar' => 'paid']);
            $pemesanan->update(['status_pesanan' => 'confirmed']);
            $pesan = 'Pembayaran berhasil diverifikasi.';
        } else {
            $pembayaran->update(['status_bayar' => 'failed']);
            $pemesanan->update(['status_pesanan' => 'cancelled']);
            $pesan = 'Pembayaran ditolak.';
        }

        return redirect()->route('admin.verifikasi')->with('success', $pesan);
    }

    // Menampilkan daftar pesanan yang dibatalkan
    public function adminPembatalanIndex(Request $request)
    {
        $userId = Auth::id();

        $query = Pemesanan::with(['user', 'lapangan', 'pembayaran'])
            ->byStatus('cancelled')
            ->whereHas('lapangan.venue', fn($q) => $q->where('id_user', $userId))
            ->latest();

        // Filter opsional
        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->whereHas('user', fn($q) => $q->where('name', 'LIKE', "%{$cari}%"));
        }
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_pesan', $request->tanggal);
        }

        $pemesanans = $query->get();

        return view('admin.pembatalan', compact('pemesanans'));
    }

    // Admin membatalkan pesanan (dari halaman daftar pemesanan)
    public function adminBatalkan(Request $request, $id)
    {
        $pemesanan = Pemesanan::whereHas('lapangan.venue', fn($q) => $q->where('id_user', Auth::id()))
            ->findOrFail($id);

        if (!in_array($pemesanan->status_pesanan, ['pending', 'confirmed'])) {
            return response()->json(['message' => 'Pesanan tidak dapat dibatalkan.'], 422);
        }

        $pemesanan->update(['status_pesanan' => 'cancelled']);

        if ($pemesanan->pembayaran) {
            $pemesanan->pembayaran->update(['status_bayar' => 'failed']);
        }

        return response()->json(['message' => 'Pesanan berhasil dibatalkan.']);
    }

    // Admin menandai refund sebagai selesai
    public function adminProsesRefund(Request $request, $id)
    {
        $pemesanan = Pemesanan::with('pembayaran')
            ->whereHas('lapangan.venue', fn($q) => $q->where('id_user', Auth::id()))
            ->byStatus('cancelled')
            ->findOrFail($id);

        // Tandai pembayaran sebagai refunded (gunakan status 'refunded')
        if ($pemesanan->pembayaran) {
            $pemesanan->pembayaran->update(['status_bayar' => 'refunded']);
        }

        return redirect()->route('admin.pembatalan')->with('success', 'Refund berhasil diproses.');
    }
}