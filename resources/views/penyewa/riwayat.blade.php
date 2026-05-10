@extends('layouts.layout')
@section('title', 'Riwayat Pemesanan - Courtee')

@push('styles')
<style>
    .history-container { max-width: 900px; margin: 0 auto; padding: 40px 24px; }
    .page-title { font-size: 28px; font-weight: 700; color: var(--brand-primary); margin-bottom: 8px; }
    .page-subtitle { color: var(--text-secondary); margin-bottom: 32px; font-size: 15px; }

    /* Filter Styles */
    .filter-wrapper { display: flex; gap: 12px; overflow-x: auto; padding-bottom: 8px; margin-bottom: 24px; scrollbar-width: none; }
    .filter-wrapper::-webkit-scrollbar { display: none; }
    .filter-btn {
        padding: 8px 20px; border-radius: 20px; border: 1px solid var(--stroke-secondary);
        background: #fff; color: var(--text-secondary); font-size: 14px; font-weight: 500;
        cursor: pointer; white-space: nowrap; transition: 0.3s;
    }
    .filter-btn.active { background: var(--brand-primary); color: #fff; border-color: var(--brand-primary); }

    /* Card Styles */
    .booking-card {
        background: #fff; border: 1px solid var(--stroke-secondary); border-radius: 16px;
        padding: 20px; margin-bottom: 20px; transition: transform 0.2s;
    }
    .booking-card:hover { transform: translateY(-2px); box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
    
    .card-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px; }
    .venue-info { display: flex; gap: 16px; align-items: center; }
    .venue-icon { 
        width: 48px; height: 48px; background: #f3e8ff; border-radius: 12px; 
        display: flex; align-items: center; justify-content: center; color: var(--brand-primary);
    }
    .venue-name { font-size: 16px; font-weight: 700; color: var(--text-primary); margin-bottom: 2px; }
    .court-name { font-size: 13px; color: var(--text-secondary); }

    /* Badges */
    .badge { padding: 6px 14px; border-radius: 8px; font-size: 12px; font-weight: 600; text-transform: capitalize; }
    .badge-pending { background: #fef3c7; color: #d97706; }    /* Kuning */
    .badge-confirmed { background: #dcfce7; color: #16a34a; }  /* Hijau */
    .badge-completed { background: #eff6ff; color: #1d4ed8; }  /* Biru */
    .badge-cancelled { background: #fee2e2; color: #dc2626; }  /* Merah */

    .card-body { 
        display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); 
        gap: 16px; padding: 16px 0; border-top: 1px dashed var(--stroke-secondary);
        border-bottom: 1px dashed var(--stroke-secondary);
    }
    .info-label { font-size: 12px; color: var(--text-secondary); margin-bottom: 4px; }
    .info-value { font-size: 14px; font-weight: 600; color: var(--text-primary); }

    .card-footer { display: flex; justify-content: space-between; align-items: center; margin-top: 16px; }
    .total-price { font-size: 14px; color: var(--text-secondary); }
    .total-price strong { font-size: 18px; color: var(--brand-primary); margin-left: 4px; }
    
    .action-btns { display: flex; gap: 8px; }
    .btn-sm { 
        padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 600; 
        cursor: pointer; border: none; transition: 0.3s; text-decoration: none;
    }
    .btn-outline { border: 1px solid var(--stroke-secondary); background: #fff; color: var(--text-secondary); }
    .btn-primary-sm { background: var(--brand-primary); color: #fff; }
    .btn-outline:hover { background: #f9fafb; }
</style>
@endpush

@section('content')
<div class="history-container">
    <h1 class="page-title">Riwayat Pemesanan</h1>
    <p class="page-subtitle">Pantau semua status pemesanan dan jadwal olahraga Anda di sini.</p>

    <div class="filter-wrapper">
        <a href="{{ route('user.riwayat', ['status' => 'all']) }}" 
           class="filter-btn {{ $currentStatus == 'all' ? 'active' : '' }}" 
           style="text-decoration: none;">Semua</a>
           
        <a href="{{ route('user.riwayat', ['status' => 'pending']) }}" 
           class="filter-btn {{ $currentStatus == 'pending' ? 'active' : '' }}" 
           style="text-decoration: none;">Menunggu Bayar</a>
           
        <a href="{{ route('user.riwayat', ['status' => 'confirmed']) }}" 
           class="filter-btn {{ $currentStatus == 'confirmed' ? 'active' : '' }}" 
           style="text-decoration: none;">Dikonfirmasi</a>
           
        <a href="{{ route('user.riwayat', ['status' => 'completed']) }}" 
           class="filter-btn {{ $currentStatus == 'completed' ? 'active' : '' }}" 
           style="text-decoration: none;">Selesai</a>
           
        <a href="{{ route('user.riwayat', ['status' => 'cancelled']) }}" 
           class="filter-btn {{ $currentStatus == 'cancelled' ? 'active' : '' }}" 
           style="text-decoration: none;">Dibatalkan</a>
    </div>

    @forelse($riwayat as $item)
    <div class="booking-card">
            <div class="card-header">
                <div class="venue-info">
                    <div class="venue-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 21h18M3 10h18M5 6l7-3 7 3M4 10v11m16-11v11"/></svg>
                    </div>
                    <div>
                        <div class="venue-name">{{ $item->lapangan->venue->nama ?? 'Venue' }}</div>
                        <div class="court-name">{{ $item->lapangan->nama ?? 'Lapangan' }}</div>
                    </div>
                </div>
                <span class="badge badge-{{ $item->status_pesanan }}">
                    @if($item->status_pesanan == 'pending') Menunggu @elseif($item->status_pesanan == 'confirmed') Dikonfirmasi @elseif($item->status_pesanan == 'completed') Selesai @else Dibatalkan @endif
                </span>
            </div>

            <div class="card-body">
                <div>
                    <div class="info-label">Tanggal Main</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($item->tanggal_pesan)->translatedFormat('d F Y') }}</div>
                </div>
                <div>
                    <div class="info-label">Waktu</div>
                    <div class="info-value">
                        {{ \Carbon\Carbon::parse($item->waktu_mulai)->format('H:i') }} - 
                        {{ \Carbon\Carbon::parse($item->waktu_selesai)->format('H:i') }}
                    </div>
                </div>
                <div>
                    <div class="info-label">ID Pesanan</div>
                    <div class="info-value">#ORD-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</div>
                </div>
            </div>

            <div class="card-footer">
                <div class="total-price">
                    Total: <strong>Rp {{ number_format($item->total_harga * 1.12, 0, ',', '.') }}</strong>
                </div>
                <div class="action-btns">
                    <a href="{{ route('riwayat.detail', $item->id) }}" class="btn-sm btn-outline">Detail</a>
                    
                    @if($item->status_pesanan == 'pending')
                        <a href="{{ route('pembayaran.show', $item->id) }}" class="btn-sm btn-primary-sm">Bayar Sekarang</a>
                    @endif

                    @if($item->status_pesanan == 'completed')
                        <button class="btn-sm btn-primary-sm" style="background: #16a34a;">Beri Ulasan</button>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div style="text-align: center; padding: 60px 0;">
            <img src="https://cdni.iconscout.com/illustration/premium/thumb/empty-cart-2130356-1800917.png" alt="Empty" style="width: 200px; opacity: 0.5;">
            <p style="color: var(--text-secondary); margin-top: 20px;">Belum ada riwayat pemesanan untuk status ini.</p>
        </div>
    @endforelse
</div>
@endsection