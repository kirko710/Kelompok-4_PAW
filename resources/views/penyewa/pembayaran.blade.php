@extends('layout.layout')
@section('title', 'Pembayaran - Courtee')

@push('styles')
<style>
.page-header { display: flex; align-items: center; gap: 16px; margin-bottom: 24px; }
.back-btn {
    width: 40px; height: 40px; border-radius: 50%; background: rgba(153,87,179,0.1);
    display: flex; align-items: center; justify-content: center; color: var(--brand-primary);
}
.page-title { font-size: 24px; font-weight: 700; color: var(--brand-primary); }
.payment-info { font-size: 16px; color: var(--text-secondary); line-height: 1.6; }
.payment-amount { margin-top: 24px; }
.payment-amount p { font-size: 14px; color: var(--brand-primary); font-weight: 500; }
.payment-amount strong { color: var(--text-primary); }
.qr-container { margin-top: 32px; display: flex; flex-direction: column; align-items: center; }
.qr-box {
    width: 280px; height: 280px; background: #f5f5f5; border: 2px solid var(--stroke-secondary);
    border-radius: 16px; display: flex; align-items: center; justify-content: center;
}
.download-qr {
    margin-top: 16px; padding: 10px 24px; background: #374151; color: white;
    border: none; border-radius: var(--radius-sm); font-size: 14px; font-weight: 500;
    font-family: var(--font-base); cursor: pointer; display: flex; align-items: center; gap: 8px;
}
.guide { margin-top: 40px; background: #f9fafb; border-radius: 12px; padding: 24px; }
.guide h3 { font-size: 18px; font-weight: 700; margin-bottom: 16px; }
.guide ol { padding-left: 20px; font-size: 14px; color: var(--text-secondary); line-height: 2; }
.btn-cta {
    width: 100%; padding: 16px; background: var(--brand-primary); color: white;
    border: none; border-radius: 12px; font-size: 16px; font-weight: 600;
    font-family: var(--font-base); cursor: pointer; margin-top: 32px;
}
.btn-cta:hover { opacity: 0.85; }
</style>
@endpush

@section('content')
<div class="container" style="max-width: 700px; padding: 40px 24px;">
    <div class="page-header">
        <a href="/pemesanan" class="back-btn">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="page-title">Pembayaran</h1>
    </div>

    <p class="payment-info">Silahkan scan dan lakukan pembayaran melalui QR Code di bawah menggunakan aplikasi e-wallet pilihan anda.</p>

    <div class="payment-amount">
        <p>Nominal yang harus dibayarkan <strong>Rp 55.100,00</strong></p>
        <p>Selesaikan pembayaran dalam <strong id="countdown">60:00</strong></p>
    </div>

    <div class="qr-container">
        <div class="qr-box">
            <svg width="120" height="120" fill="#ccc" viewBox="0 0 24 24"><path d="M3 3h8v8H3V3zm2 2v4h4V5H5zm8-2h8v8h-8V3zm2 2v4h4V5h-4zM3 13h8v8H3v-8zm2 2v4h4v-4H5zm11-2h2v2h-2v-2zm-4 0h2v2h-2v-2zm0 4h2v2h-2v-2zm4 0h2v2h-2v-2zm2-4h2v2h-2v-2zm0 4h2v2h-2v-2zm2-2h2v2h-2v-2z"/></svg>
        </div>
        <button class="download-qr">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            Download QR
        </button>
    </div>

    <div class="guide">
        <h3>Panduan Pembayaran</h3>
        <ol>
            <li>Buka aplikasi e-wallet anda</li>
            <li>Pilih menu bayar melalui QR</li>
            <li>Scan QR di atas</li>
            <li>Masukan nominal sesuai tagihan anda</li>
            <li>Selesaikan transfer</li>
            <li>Tekan tombol konfirmasi di bawah</li>
        </ol>
    </div>

    <a href="/"><button class="btn-cta">Konfirmasi</button></a>
</div>

@push('scripts')
<script>
    let time = 3600;
    const el = document.getElementById('countdown');
    setInterval(() => {
        if (time <= 0) return;
        time--;
        const m = Math.floor(time / 60).toString().padStart(2, '0');
        const s = (time % 60).toString().padStart(2, '0');
        el.textContent = m + ':' + s;
    }, 1000);
</script>
@endpush
@endsection
