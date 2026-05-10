@extends('layouts.layout')
@section('title', 'Detail Transaksi - Courtee')

@push('styles')
<style>
    .receipt-container { max-width: 600px; margin: 40px auto; padding: 0 24px; }
    .receipt-card { background: #fff; border: 1px solid var(--stroke-secondary); border-radius: 16px; overflow: hidden; }
    .receipt-header { background: var(--brand-primary); color: white; padding: 24px; text-align: center; }
    .receipt-body { padding: 24px; }
    .receipt-row { display: flex; justify-content: space-between; margin-bottom: 16px; font-size: 14px; }
    .receipt-label { color: var(--text-secondary); }
    .receipt-val { font-weight: 600; color: var(--text-primary); text-align: right; }
    .divider { border: none; border-top: 1px dashed #ccc; margin: 20px 0; }
    .badge-status { padding: 6px 16px; border-radius: 20px; font-weight: 600; font-size: 14px; display: inline-block; margin-top: 12px; }
</style>
@endpush

@section('content')
<div class="receipt-container">
    <a href="{{ route('user.riwayat') }}" style="display: inline-flex; align-items: center; gap: 8px; color: var(--brand-primary); text-decoration: none; font-weight: 600; margin-bottom: 24px;">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
        Kembali ke Riwayat
    </a>

    <div class="receipt-card">
        <div class="receipt-header">
            <h2 style="margin: 0; font-size: 20px;">Detail Pesanan</h2>
            <p style="margin: 4px 0 0; opacity: 0.8; font-size: 14px;">#ORD-{{ str_pad($pemesanan->id, 5, '0', STR_PAD_LEFT) }}</p>
            
            @if($pemesanan->status_pesanan == 'confirmed' || $pemesanan->status_pesanan == 'completed')
                <div class="badge-status" style="background: #dcfce7; color: #16a34a;">Pembayaran Berhasil</div>
            @elseif($pemesanan->status_pesanan == 'pending')
                <div class="badge-status" style="background: #fef3c7; color: #d97706;">Menunggu Pembayaran</div>
            @else
                <div class="badge-status" style="background: #fee2e2; color: #dc2626;">Dibatalkan</div>
            @endif
        </div>

        <div class="receipt-body">
            <h3 style="font-size: 16px; margin-bottom: 16px; color: var(--brand-primary);">Informasi Lapangan</h3>
            <div class="receipt-row">
                <span class="receipt-label">Venue</span>
                <span class="receipt-val">{{ $pemesanan->lapangan->venue->nama }}</span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">Lapangan</span>
                <span class="receipt-val">{{ $pemesanan->lapangan->nama }}</span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">Jadwal Main</span>
                <span class="receipt-val">
                    {{ \Carbon\Carbon::parse($pemesanan->tanggal_pesan)->translatedFormat('d F Y') }}<br>
                    {{ \Carbon\Carbon::parse($pemesanan->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($pemesanan->waktu_selesai)->format('H:i') }}
                </span>
            </div>

            <hr class="divider">

            <h3 style="font-size: 16px; margin-bottom: 16px; color: var(--brand-primary);">Rincian Pembayaran</h3>
            <div class="receipt-row">
                <span class="receipt-label">Metode Pembayaran</span>
                <span class="receipt-val" style="text-transform: uppercase;">
                    {{ $pemesanan->pembayaran->metode_pembayaran ?? 'Belum Dipilih' }}
                </span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">Harga Sewa</span>
                <span class="receipt-val">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">Pajak Aplikasi (12%)</span>
                <span class="receipt-val">Rp {{ number_format($pemesanan->total_harga * 0.12, 0, ',', '.') }}</span>
            </div>
            
            <div class="receipt-row" style="margin-top: 24px; font-size: 18px;">
                <span class="receipt-label" style="font-weight: 700; color: #111827;">Total Dibayar</span>
                <span class="receipt-val" style="color: var(--brand-primary);">Rp {{ number_format($pemesanan->total_harga * 1.12, 0, ',', '.') }}</span>
            </div>

            @if($pemesanan->status_pesanan == 'pending')
                <a href="{{ route('pembayaran.show', $pemesanan->id) }}" style="display: block; width: 100%; text-align: center; background: var(--brand-primary); color: white; padding: 14px; border-radius: 8px; text-decoration: none; font-weight: 600; margin-top: 24px;">Lanjutkan Pembayaran</a>
            @endif
        </div>
    </div>
</div>
@endsection