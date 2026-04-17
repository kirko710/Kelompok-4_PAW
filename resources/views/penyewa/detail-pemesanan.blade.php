@extends('layouts.layout')
@section('title', 'Detail Pemesanan - Courtee')

@push('styles')
<style>
.page-header { display: flex; align-items: center; gap: 16px; margin-bottom: 32px; }
.back-btn {
    width: 40px; height: 40px; border-radius: 50%; background: rgba(153,87,179,0.1);
    display: flex; align-items: center; justify-content: center; color: var(--brand-primary);
    transition: background var(--transition);
}
.back-btn:hover { background: rgba(153,87,179,0.2); }
.page-title { font-size: 24px; font-weight: 700; color: var(--brand-primary); }
.booking-item {
    border: 1px solid var(--stroke-secondary); border-radius: 12px;
    padding: 20px; margin-bottom: 12px;
    display: flex; justify-content: space-between; align-items: center;
}
.booking-item__venue { font-weight: 600; color: var(--text-primary); }
.booking-item__court { font-size: 14px; color: var(--text-secondary); }
.booking-item__details { display: flex; align-items: center; gap: 16px; font-size: 14px; }
.booking-item__time { color: var(--brand-primary); font-weight: 600; }
.summary { margin-top: 32px; }
.summary-row { display: flex; justify-content: space-between; padding: 8px 0; font-size: 14px; }
.summary-label { color: var(--brand-primary); font-weight: 500; }
.summary-value { color: var(--text-primary); font-weight: 500; }
.summary-total .summary-label { font-weight: 700; }
.summary-total .summary-value { font-size: 18px; font-weight: 700; }
.divider { border: none; border-top: 1px solid var(--stroke-secondary); margin: 8px 0; }
.payment-section { margin-top: 40px; }
.payment-title { font-size: 22px; font-weight: 700; color: var(--brand-primary); margin-bottom: 16px; }
.payment-options { display: flex; gap: 16px; }
.payment-option {
    flex: 1; border: 2px solid var(--stroke-secondary); border-radius: 12px;
    padding: 24px; text-align: center; cursor: pointer; transition: all var(--transition);
}
.payment-option:hover, .payment-option--active {
    border-color: #22c55e; background: rgba(34,197,94,0.05);
}
.payment-option__label { font-size: 20px; font-weight: 700; color: var(--text-primary); }
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
        <a href="/venue/1" class="back-btn">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="page-title">Detail Pemesanan</h1>
    </div>

    <div class="booking-item">
        <div>
            <div class="booking-item__venue">Longfield Sport Center</div>
            <div class="booking-item__court">Lapangan Makmur</div>
        </div>
        <div class="booking-item__details">
            <span>20 Desember 2025</span>
            <span class="booking-item__time">09.00-10.00</span>
            <span>Rp 25.000,00</span>
        </div>
    </div>

    <div class="booking-item">
        <div>
            <div class="booking-item__venue">Longfield Sport Center</div>
            <div class="booking-item__court">Lapangan Makmur</div>
        </div>
        <div class="booking-item__details">
            <span>20 Desember 2025</span>
            <span class="booking-item__time">10.00-11.00</span>
            <span>Rp 25.000,00</span>
        </div>
    </div>

    <div class="summary">
        <div class="summary-row">
            <span class="summary-label">Subtotal</span>
            <span class="summary-value">Rp 50.000,00</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Pajak (12%)</span>
            <span class="summary-value">Rp 5.100,00</span>
        </div>
        <hr class="divider">
        <div class="summary-row summary-total">
            <span class="summary-label">Total</span>
            <span class="summary-value">Rp 55.100,00</span>
        </div>
    </div>

    <div class="payment-section">
        <h2 class="payment-title">Metode Pembayaran</h2>
        <div class="payment-options">
            <div class="payment-option payment-option--active">
                <div class="payment-option__label">QRIS</div>
            </div>
            <div class="payment-option">
                <div style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 21h18M3 10h18M5 6l7-3 7 3M4 10v11m16-11v11M8 14v3m4-3v3m4-3v3"/></svg>
                    <span class="payment-option__label" style="font-size: 16px;">Mobile Banking</span>
                </div>
            </div>
        </div>
    </div>

    <a href="/pembayaran"><button class="btn-cta">Lanjutkan ke Konfirmasi Pembayaran</button></a>
</div>
@endsection
