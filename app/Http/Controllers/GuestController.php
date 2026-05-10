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
    public function index()
    {
        $venues = Venue::latest()->get();
        return view('guest.venue-search', compact('venues'));
    }

    /**
     * Halaman detail venue beserta lapangan-lapangannya.
     */
    public function show(string $id)
    {
        $venue = Venue::with('lapangans')->findOrFail($id);
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
            ->get(['waktu_mulai', 'waktu_selesai']);

        // Generate slot per jam
        $jamBuka   = Carbon::parse($lapangan->jam_buka);
        $jamTutup  = Carbon::parse($lapangan->jam_tutup);
        $slots     = [];
        $current   = $jamBuka->copy();

        while ($current->lt($jamTutup)) {
            $mulai    = $current->format('H:i');
            $selesai  = $current->copy()->addHour()->format('H:i');

            // Cek apakah slot ini overlap dengan pemesanan yang ada
            $terpesan = false;
            foreach ($pemesanans as $p) {
                // Overlap jika mulai slot < waktu_selesai pemesanan DAN selesai slot > waktu_mulai pemesanan
                if ($mulai < $p->waktu_selesai && $selesai > $p->waktu_mulai) {
                    $terpesan = true;
                    break;
                }
            }

            $slots[] = [
                'mulai'    => $mulai,
                'selesai'  => $selesai,
                'label'    => "{$mulai} - {$selesai}",
                'tersedia' => !$terpesan,
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
