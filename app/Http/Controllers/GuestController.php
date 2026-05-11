<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use App\Models\Pemesanan;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class GuestController extends Controller
{
    /**
     * Halaman daftar venue (pencarian).
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $lokasi = $request->query('lokasi');
        $jenis  = $request->query('jenis_olahraga');
        $sort   = $request->query('sort_harga');

        $query = Venue::active()->with('lapangans');

        $query->when($search, function ($q) use ($search) {
            return $q->where('nama', 'like', "%{$search}%");
        });

        $query->when($lokasi, function ($q) use ($lokasi) {
            return $q->where('lokasi', 'like', "%{$lokasi}%");
        });

        $query->when($jenis, function ($q) use ($jenis) {
            return $q->whereHas('lapangans', function ($sq) use ($jenis) {
                $sq->where('jenis_olahraga', $jenis);
            });
        });

        $query->when($sort, function ($q) use ($sort) {
            if ($sort === 'termurah') {
                return $q->withMin('lapangans', 'harga_sewa')->orderBy('lapangans_min_harga_sewa', 'asc');
            } elseif ($sort === 'termahal') {
                return $q->withMax('lapangans', 'harga_sewa')->orderBy('lapangans_max_harga_sewa', 'desc');
            }
        });

        $venues = $query->latest()->get();

        return view('guest.venue-search', compact('venues'));
    }

    /**
     * Halaman detail venue beserta lapangan-lapangannya.
     */
    public function show(string $id)
    {
        $venue = Venue::with('lapangans')->active()->findOrFail($id);
        $lapangan = $venue->lapangans;

        return view('guest.venue-detail', compact('venue', 'lapangan'));
    }

    /**
     * API endpoint: kembalikan slot ketersediaan untuk lapangan pada tanggal tertentu.
     * GET /lapangan/{id}/slots?tanggal=YYYY-MM-DD
     */
    public function getSlots(Request $request, int $id)
    {
        $lapangan = Lapangan::findOrFail($id);

        $tanggal = $request->query('tanggal');
        if (!$tanggal || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $tanggal)) {
            return response()->json(['error' => 'Parameter tanggal harus diisi (format: YYYY-MM-DD)'], 422);
        }

        // Jika jam operasional belum di-set, kembalikan array kosong
        if (!$lapangan->jam_buka || !$lapangan->jam_tutup) {
            return response()->json([
                'lapangan_id' => $lapangan->id,
                'tanggal'     => $tanggal,
                'harga_sewa'  => (float) $lapangan->harga_sewa,
                'slots'       => [],
                'jam_belum_diset' => true,
            ]);
        }

        // Ambil semua pemesanan aktif/confirmed/pending pada lapangan & tanggal ini
        $pemesanans = Pemesanan::where('id_lapangan', $lapangan->id)
            ->where('tanggal_pesan', $tanggal)
            ->whereNotIn('status_pesanan', ['cancelled'])
            ->get(['waktu_mulai', 'waktu_selesai','status_pesanan']);

        // Generate slot per jam
        $jamBuka   = Carbon::parse($lapangan->jam_buka);
        $jamTutup  = Carbon::parse($lapangan->jam_tutup);
        $slots     = [];
        $current   = $jamBuka->copy();

        while ($current->lt($jamTutup)) {
            $next = $current->copy()->addHour();
            $mulai    = $current->format('H:i');
            $selesai  = $next->format('H:i');

            // Cek apakah slot ini overlap dengan pemesanan yang ada
            $terpesan = false;
            $statusTeks = 'Tersedia';
            foreach ($pemesanans as $p) {
                // Overlap jika mulai slot < waktu_selesai pemesanan DAN selesai slot > waktu_mulai pemesanan
                $pMulai = Carbon::parse($p->waktu_mulai, $current->timezone);
                $pSelesai = Carbon::parse($p->waktu_selesai, $current->timezone);

                // Cek Overlap: (Mulai Slot < Selesai Pesanan) DAN (Selesai Slot > Mulai Pesanan)
                if ($current->lt($pSelesai) && $next->gt($pMulai)) {
                    $terpesan = true;

                    if ($p->status_pesanan === 'pending') {
                        $statusTeks = 'Sedang Dipesan';
                    } else {
                        $statusTeks = 'Terpesan';
                    }

                    break;
                }
            }

            $slots[] = [
                'mulai'    => $mulai,
                'selesai'  => $selesai,
                'label'    => "{$mulai} - {$selesai}",
                'tersedia' => !$terpesan,
                'status_teks' => $statusTeks,
            ];

            $current->addHour();
        }

        return response()->json([
            'lapangan_id' => $lapangan->id,
            'tanggal'     => $tanggal,
            'harga_sewa'  => (float) $lapangan->harga_sewa,
            'slots'       => $slots,
        ]);
    }
}
