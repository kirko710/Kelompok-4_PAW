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
.payment-option--active {
    border-color: var(--brand-primary) !important;
    background: rgba(153,87,179,0.05);
}
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
        <a href="{{ route('venue.show', $pemesanan->lapangan->id_venue) }}" class="back-btn">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="page-title">Detail Pemesanan</h1>
    </div>

    @php
        $tanggal = \Carbon\Carbon::parse($pemesanan->tanggal_pesan)->translatedFormat('d F Y');
        $mulai = \Carbon\Carbon::parse($pemesanan->waktu_mulai);
        $selesai = \Carbon\Carbon::parse($pemesanan->waktu_selesai);
        
        $durasi = $mulai->diffInHours($selesai);
        $hargaPerJam = $pemesanan->lapangan->harga_sewa;
        
        $subtotal = $pemesanan->total_harga;
        $pajak = $subtotal * 0.12;
        $totalAkhir = $subtotal + $pajak;
    @endphp

    @for($i = 0; $i < $durasi; $i++)
        @php
            $slotMulai = $mulai->copy()->addHours($i);
            $slotSelesai = $mulai->copy()->addHours($i + 1);
        @endphp
        
        <div class="booking-item">
            <div>
                <div class="booking-item__venue">{{ $pemesanan->lapangan->venue->nama }}</div>
                <div class="booking-item__court">{{ $pemesanan->lapangan->nama }}</div>
            </div>
            <div class="booking-item__details">
                <span>{{ $tanggal }}</span>
                <span class="booking-item__time">{{ $slotMulai->format('H.i') }}-{{ $slotSelesai->format('H.i') }}</span>
                <span>Rp {{ number_format($hargaPerJam, 2, ',', '.') }}</span>
            </div>
        </div>
    @endfor

    <div class="summary">
        <div class="summary-row">
            <span class="summary-label">Subtotal ({{ $durasi }} Jam)</span>
            <span class="summary-value">Rp {{ number_format($subtotal, 2, ',', '.') }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Pajak (12%)</span>
            <span class="summary-value">Rp {{ number_format($pajak, 2, ',', '.') }}</span>
        </div>
        <hr class="divider">
        <div class="summary-row summary-total">
            <span class="summary-label">Total</span>
            <span class="summary-value">Rp {{ number_format($totalAkhir, 2, ',', '.') }}</span>
        </div>
    </div>

    <form action="{{ route('pembayaran.show', $pemesanan->id) }}" method="GET">
        <div class="payment-section">
            <h2 class="payment-title">Metode Pembayaran</h2>
            
            <input type="hidden" name="metode" id="input_metode" value="qris">

            <div class="payment-options">
                <div class="payment-option payment-option--active" data-value="qris" onclick="selectPayment(this)">
                    <div class="payment-option__label">QRIS</div>
                </div>
                <div class="payment-option" data-value="transfer_bank" onclick="selectPayment(this)">
                    <div class="payment-option__label">Transfer Bank</div>
                </div>
                <div class="payment-option" data-value="tunai" onclick="selectPayment(this)">
                    <div class="payment-option__label">Tunai</div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn-cta">Lanjutkan ke Pembayaran</button>
    </form>
</div>
@push('scripts')
<script>
    function selectPayment(element) {
        document.querySelectorAll('.payment-option').forEach(opt => {
            opt.classList.remove('payment-option--active');
        });

        element.classList.add('payment-option--active');

        const metode = element.getAttribute('data-value');
        document.getElementById('input_metode').value = metode;
    }
</script>
@endpush
@endsection