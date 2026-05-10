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
            'waktu_mulai'   => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        ]);

        $lapangan = Lapangan::findOrFail($request->id_lapangan);

        $mulai = Carbon::createFromFormat('H:i', $request->waktu_mulai);
        $selesai = Carbon::createFromFormat('H:i', $request->waktu_selesai);
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
            'metode_pembayaran' => 'transfer_bank', // Default, bisa diubah user nanti
            'status_bayar'      => 'unpaid',
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

        return view('penyewa.riwayat', compact('riwayat', 'currentStatus'));
    }

    /**
     * ==========================================
     * FITUR UNTUK ADMIN / OWNER
     * ==========================================
     */

    // Menampilkan semua daftar pemesanan (Riwayat Keseluruhan)
    public function adminIndex()
    {
        // Menarik data pemesanan beserta user dan lapangannya (Eager Loading untuk menghindari N+1 query)
        $pemesanans = Pemesanan::with(['user', 'lapangan'])->latest()->get();
        return view('admin.pemesanan', compact('pemesanans'));
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
    public function adminPembatalanIndex()
    {
        // Menampilkan data pemesanan yang statusnya dibatalkan
        $pemesanans = Pemesanan::with(['user', 'lapangan'])
            ->byStatus('cancelled') // Menggunakan local scope byStatus dari model Pemesanan
            ->latest()
            ->get();

        return view('admin.pembatalan', compact('pemesanans'));
    }
}