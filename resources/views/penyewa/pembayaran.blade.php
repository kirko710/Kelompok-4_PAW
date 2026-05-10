@extends('layouts.layout')
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
    border-radius: 16px; display: flex; align-items: center; justify-content: center; overflow: hidden;
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
.input-ref {
    width: 100%; padding: 14px; margin-top: 16px; border: 1px solid var(--stroke-secondary);
    border-radius: 8px; font-family: var(--font-base);
}
</style>
@endpush

@section('content')
@php
    $totalTagihan = $pembayaran->pemesanan->total_harga * 1.12;
    $metode = request('metode', $pembayaran->metode_pembayaran);

    if ($metode === 'tunai') {
        // 1. Ambil murni TANGGAL saja (Y-m-d)
        $tglSaja = \Carbon\Carbon::parse($pembayaran->pemesanan->tanggal_pesan)->format('Y-m-d');
        
        // 2. Ambil murni JAM saja (H:i:s) dari kolom waktu_mulai
        $jamSaja = \Carbon\Carbon::parse($pembayaran->pemesanan->waktu_mulai)->format('H:i:s');
        
        // 3. Gabungkan dengan rapi
        $jadwalMain = \Carbon\Carbon::parse($tglSaja . ' ' . $jamSaja);
        
        $batasWaktu = $jadwalMain->subMinutes(30);
    } else {
        $batasWaktu = \Carbon\Carbon::parse($pembayaran->pemesanan->created_at)->addMinutes(60);
    }

    $sisaDetik = (int) max(0, \Carbon\Carbon::now()->diffInSeconds($batasWaktu, false));
@endphp

<div class="container" style="max-width: 700px; padding: 40px 24px;">
    <div class="page-header">
        <a href="{{ route('pemesanan.detail', $pembayaran->id_pemesanan) }}" class="back-btn">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="page-title">Pembayaran</h1>
    </div>

    @if($metode === 'qris')
        <p class="payment-info">Silahkan scan dan lakukan pembayaran melalui QR Code di bawah menggunakan aplikasi e-wallet pilihan anda.</p>
    @elseif($metode === 'va_bank')
        <p class="payment-info">Silahkan transfer menggunakan Virtual Account ke nomor rekening yang tertera di bawah ini.</p>
    @elseif($metode === 'tunai')
        <p class="payment-info">Anda memilih pembayaran Tunai (Bayar di Tempat). Silahkan tunjukkan nomor pesanan Anda ke kasir.</p>
    @else
        <p class="payment-info">Selesaikan pembayaran Anda menggunakan dompet digital (E-Wallet).</p>
    @endif

    <div class="payment-amount">
        <p>Nominal yang harus dibayarkan <strong style="font-size: 18px;">Rp {{ number_format($totalTagihan, 2, ',', '.') }}</strong></p>
        <p>Selesaikan pembayaran dalam <strong id="countdown" style="color: #ef4444; font-size: 16px;">--:--</strong></p>
    </div>

    @if($metode === 'qris')
        <div class="qr-container">
            <div class="qr-box">
                <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg" alt="QRIS" style="width: 100%; height: 100%; padding: 16px;">
            </div>
            <button class="download-qr">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Download QR
            </button>
        </div>

        <div class="guide">
            <h3>Panduan Pembayaran QRIS</h3>
            <ol>
                <li>Buka aplikasi e-wallet atau M-Banking Anda.</li>
                <li>Pilih menu bayar melalui QR.</li>
                <li>Scan QR di atas (atau unggah dari galeri jika sudah didownload).</li>
                <li>Masukan nominal sesuai tagihan Anda.</li>
                <li>Selesaikan transfer.</li>
            </ol>
        </div>
    @elseif($metode === 'transfer_bank')
        <div class="qr-container" style="align-items: flex-start; background: #f9fafb; padding: 24px; border-radius: 12px; width: 100%;">
            <p style="margin-bottom: 8px; color: var(--text-secondary);">Nomor Virtual Account:</p>
            <h2 style="font-size: 28px; letter-spacing: 2px;">8890 1234 5678 9012</h2>
            <p style="margin-top: 8px; font-size: 14px;">Bank BCA (a/n Courtee Venue)</p>
        </div>
        <div class="guide">
            <h3>Panduan Transfer Bank</h3>
            <ol>
                <li>Login ke aplikasi M-Banking Anda.</li>
                <li>Pilih menu Transfer > Antar Rekening / Virtual Account.</li>
                <li>Masukkan nomor Virtual Account di atas.</li>
                <li>Pastikan nama penerima adalah "Courtee Venue".</li>
                <li>Selesaikan transfer.</li>
            </ol>
        </div>
    @elseif($metode === 'tunai')
        <div class="qr-container" style="background: #f9fafb; padding: 32px; border-radius: 12px; text-align: center; width: 100%;">
            <p style="color: var(--text-secondary); margin-bottom: 8px;">ID Pesanan Anda:</p>
            <h1 style="font-size: 32px; color: var(--brand-primary); letter-spacing: 2px;">ORD-{{ str_pad($pembayaran->pemesanan->id, 5, '0', STR_PAD_LEFT) }}</h1>
            <p style="margin-top: 16px; font-size: 14px; color: #ef4444;">Harap lakukan pembayaran di kasir maksimal 30 menit sebelum jadwal main.</p>
        </div>
    @endif

    <form action="{{ route('pembayaran.proses', $pembayaran->id) }}" method="POST" style="margin-top: 32px;">
        @csrf
        
        @if($metode !== 'tunai')
            <div style="margin-bottom: 24px;">
                <label style="font-weight: 600; color: var(--text-primary);">Bukti Pembayaran / Nomor Referensi (Opsional)</label>
                <input type="text" name="nomor_referensi" class="input-ref" placeholder="Cth: Nama Pengirim atau Nomor Ref Transaksi">
            </div>
            <input type="hidden" name="metode_pembayaran" value="{{ $metode }}">
            <button type="submit" class="btn-cta">Konfirmasi Pembayaran</button>
        @else
            <input type="hidden" name="metode_pembayaran" value="tunai">
            <button type="submit" class="btn-cta">Selesai & Tutup</button>
        @endif
    </form>
</div>

@push('scripts')
<script>
    let time = {{ $sisaDetik }};
    const el = document.getElementById('countdown');
    
    const metodePembayaran = "{{ $metode }}"; 

    if (time > 0) {
        const timerInterval = setInterval(() => {
            if (time <= 0) {
                clearInterval(timerInterval);
                el.textContent = "00:00";
                alert("Waktu pembayaran Anda telah habis.");
                window.location.href = "{{ route('pemesanan.detail', $pembayaran->id_pemesanan) }}";
                return;
            }
            time--;
            const d = Math.floor(time / (24 * 3600));
            const h = Math.floor((time % (24 * 3600)) / 3600).toString().padStart(2, '0');
            const m = Math.floor((time % 3600) / 60).toString().padStart(2, '0');
            const s = Math.floor(time % 60).toString().padStart(2, '0');
            
            if (metodePembayaran === 'tunai') {
                if (d > 0) {
                    el.textContent = d + ' Hari ' + h + ':' + m + ':' + s;
                } else {
                    el.textContent = h + ':' + m + ':' + s;
                }
            } else {
                el.textContent = m + ':' + s;
            }
        }, 1000);
    } else {
        el.textContent = "Kedaluwarsa";
    }
</script>
@endpush
@endsection