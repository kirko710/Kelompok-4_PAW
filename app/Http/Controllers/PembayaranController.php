<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * ==========================================
     * FITUR UNTUK PENYEWA (USER)
     * ==========================================
     */

    // Menampilkan halaman form pembayaran untuk penyewa
    public function show(Request $request, $id_pemesanan)
    {
        // Mencari data pembayaran berdasarkan ID pemesanan.
        // Relasi dan validasi Auth::id() digunakan agar user lain tidak bisa melihat pembayaran yang bukan miliknya.
        $pembayaran = Pembayaran::with('pemesanan.lapangan')
            ->where('id_pemesanan', $id_pemesanan)
            ->whereHas('pemesanan', function ($query) {
                $query->where('id_user', Auth::id());
            })
            ->firstOrFail();

        if ($pembayaran->pemesanan->cekDanBatalJikaKedaluwarsa() || $pembayaran->status_bayar === 'failed') {
            return redirect()->route('pemesanan.detail', $id_pemesanan)
                                ->with('error', 'Waktu pembayaran telah habis.');
        }

        $metode = $request->query('metode', $pembayaran->metode_pembayaran);

        if ($pembayaran->metode_pembayaran !== $metode) {
            $pembayaran->update(['metode_pembayaran' => $metode]);
        }

        return view('penyewa.pembayaran', compact('pembayaran', 'metode'));
    }

    // Memproses submit bukti pembayaran oleh penyewa
    public function proses(Request $request, $id)
    {
        // Validasi input dari form pembayaran
        $request->validate([
            'metode_pembayaran' => 'required|in:transfer_bank,qris,tunai',
            'nomor_referensi'   => 'nullable|string',
            'catatan'           => 'nullable|string'
        ]);

        // Memastikan pembayaran yang diubah adalah milik user yang sedang login
        $pembayaran = Pembayaran::whereHas('pemesanan', function ($query) {
                $query->where('id_user', Auth::id());
            })
            ->where('id', $id)
            ->firstOrFail();

        // Update data dan ubah status menjadi pending (menunggu verifikasi admin)
        $pembayaran->update([
            'metode_pembayaran'  => $request->metode_pembayaran,
            'nomor_referensi'    => $request->nomor_referensi,
            'catatan'            => $request->catatan,
            'status_bayar'       => 'pending',
            'tanggal_pembayaran' => now(), // Mencatat waktu submit
        ]);

        return redirect()->route('home')->with('success', 'Pembayaran berhasil dikirim dan sedang menunggu verifikasi.');
    }


    /**
     * ==========================================
     * FITUR UNTUK ADMIN / OWNER
     * ==========================================
     */

    // Menampilkan halaman daftar pembayaran yang butuh diverifikasi admin
    public function daftarVerifikasi()
    {
        // Menggunakan scope 'byStatus' dari model untuk memfilter yang statusnya 'pending'
        // Eager load relasi pemesanan, user, dan lapangan untuk mencegah N+1 Query problem di view
        $pembayarans = Pembayaran::with(['pemesanan.user', 'pemesanan.lapangan'])
            ->byStatus('pending')
            ->latest()
            ->get();

        return view('admin.verifikasi', compact('pembayarans'));
    }

    // Memproses verifikasi (Terima/Tolak) oleh Admin
    public function prosesVerifikasi(Request $request, $id)
    {
        $request->validate([
            'aksi' => 'required|in:terima,tolak',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pemesanan = $pembayaran->pemesanan; // Memanggil relasi pemesanan terkait

        if ($request->aksi === 'terima') {
            // Jika diterima, ubah status bayar menjadi paid
            $pembayaran->update(['status_bayar' => 'paid']);
            // Opsional: sinkronisasi update status di tabel pemesanan menjadi confirmed
            $pemesanan->update(['status_pesanan' => 'confirmed']);

            $pesan = 'Pembayaran berhasil diverifikasi (Diterima).';
        } else {
            // Jika ditolak, ubah status bayar menjadi failed
            $pembayaran->update(['status_bayar' => 'failed']);
            // Sinkronisasi status pesanan menjadi cancelled
            $pemesanan->update(['status_pesanan' => 'cancelled']);

            $pesan = 'Pembayaran ditolak.';
        }

        return redirect()->route('admin.verifikasi')
            ->with('success', $pesan);
    }
}