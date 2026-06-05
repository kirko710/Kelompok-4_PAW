<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    // Menampilkan halaman form pembayaran untuk penyewa
    public function show(Request $request, $id_pemesanan)
    {
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
            'tanggal_pembayaran' => now(),
        ]);

        return redirect()->route('home')->with('success', 'Pembayaran berhasil dikirim dan sedang menunggu verifikasi.');
    }

    // Menampilkan halaman daftar pembayaran yang butuh diverifikasi admin
    public function daftarVerifikasi()
    {
        $pemesanans = Pemesanan::with(['user', 'lapangan', 'pembayaran'])
            ->whereHas('pembayaran', fn($q) => $q->where('status_bayar', ['pending', 'unpaid']))
            ->whereHas('lapangan.venue', fn($q) => $q->where('id_user', Auth::id()))
            ->latest()
            ->get();

        return view('admin.verifikasi', compact('pemesanans'));
    }

    // Memproses verifikasi (Terima/Tolak) oleh Admin
    public function prosesVerifikasi(Request $request, $id)
    {
        $aksi = $request->input('action', $request->input('aksi'));

        $pemesanan  = Pemesanan::findOrFail($id);
        $pembayaran = $pemesanan->pembayaran;

        if ($aksi === 'terima') {
            $pembayaran?->update(['status_bayar' => 'paid']);
            $pemesanan->update(['status_pesanan' => 'confirmed']);
            $pesan = 'Pembayaran berhasil diverifikasi.';
        } else {
            $pembayaran?->update(['status_bayar' => 'failed']);
            $pemesanan->update(['status_pesanan' => 'cancelled']);
            $pesan = 'Pembayaran ditolak.';
        }

        return redirect()->route('admin.verifikasi')->with('success', $pesan);
    }
}