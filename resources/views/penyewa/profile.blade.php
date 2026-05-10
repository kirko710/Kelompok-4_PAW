@extends('layouts.layout')
@section('title', 'Profile - Courtee')

@push('styles')
<style>
    .profile-container { max-width: 1000px; margin: 0 auto; padding: 0 24px 64px 24px; }
    .card { background: #fff; border: 1px solid var(--stroke-secondary, #e5e7eb); border-radius: 16px; padding: 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.02); }
    
    .profile-banner { 
        height: 160px; width: 100%; border-radius: 0 0 24px 24px; 
        background: url('https://images.unsplash.com/photo-1552667466-07770ae110d0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80') center/cover;
        position: relative; margin-bottom: 80px;
    }
    .profile-header {
        position: absolute; bottom: -50px; left: 40px; display: flex; align-items: flex-end; gap: 24px;
    }
    .profile-avatar {
        width: 120px; height: 120px; border-radius: 50%; border: 4px solid #fff;
        object-fit: cover; background: #eee; box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .btn-logout {
        background: #ef4444; color: #fff; padding: 10px 32px; border-radius: 8px; font-weight: 600;
        border: none; cursor: pointer; transition: 0.3s; margin-bottom: 12px;
    }
    .btn-logout:hover { background: #dc2626; }

    .profile-grid { display: grid; grid-template-columns: 1fr; gap: 24px; margin-bottom: 24px; }
    @media(min-width: 800px) { .profile-grid { grid-template-columns: 350px 1fr; } }
    
    .right-grid-top { display: grid; grid-template-columns: 1fr; gap: 24px; margin-bottom: 24px; }
    @media(min-width: 1000px) { .right-grid-top { grid-template-columns: 1.5fr 1fr; } }

    .form-group { margin-bottom: 16px; }
    .form-label { display: block; font-size: 13px; color: #4b5563; margin-bottom: 6px; }
    .form-input {
        width: 100%; padding: 10px 16px; border: 1px solid #d1d5db; border-radius: 8px;
        font-family: inherit; font-size: 14px; color: #111827; background: #fff;
    }
    .form-input:disabled { background: #f9fafb; color: #6b7280; }
    
    .btn-icon {
        background: #9333ea; color: white; border: none; padding: 8px 24px; border-radius: 8px;
        font-size: 14px; font-weight: 500; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;
    }
    .btn-save { background: #9333ea; color: white; border: none; padding: 10px 24px; border-radius: 8px; font-weight: 500; cursor: pointer; }
    
    .history-item { display: flex; align-items: center; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #f3f4f6; font-size: 13px; }
    .history-item:last-child { border-bottom: none; }
    .badge { padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; }
    .badge-success { background: #dcfce7; color: #16a34a; }
    .badge-danger { background: #fee2e2; color: #dc2626; }
    .badge-warning { background: #fef3c7; color: #d97706; }
    
    .toggle-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; font-size: 13px; }
    .toggle-switch { position: relative; display: inline-block; width: 44px; height: 24px; }
    .toggle-switch input { opacity: 0; width: 0; height: 0; }
    .slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #e5e7eb; transition: .4s; border-radius: 24px; }
    .slider:before { position: absolute; content: ""; height: 18px; width: 18px; left: 3px; bottom: 3px; background-color: white; transition: .4s; border-radius: 50%; }
    input:checked + .slider { background-color: #9333ea; }
    input:checked + .slider:before { transform: translateX(20px); }

    .tags-container { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 12px; }
    .tag { background: #f3e8ff; color: #9333ea; padding: 4px 12px; border-radius: 16px; font-size: 12px; display: flex; align-items: center; gap: 6px; }
    .tag-close { cursor: pointer; font-weight: bold; }

    .booking-card { border: 1px solid #bfdbfe; border-radius: 12px; padding: 20px; position: relative; }
    .booking-badge { position: absolute; top: 20px; right: 20px; background: #9333ea; color: white; padding: 4px 12px; border-radius: 8px; font-size: 12px; font-weight: 500; }
    .booking-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin: 20px 0; font-size: 14px; }
    .booking-actions { display: flex; gap: 12px; margin-top: 24px; }
    .btn-action { flex: 1; padding: 12px; border-radius: 8px; font-size: 14px; font-weight: 600; text-align: center; cursor: pointer; border: none; }
    .btn-action.purple { background: #9333ea; color: white; }
    .btn-action.gray { background: #f3f4f6; color: #4b5563; }
    .btn-action.red { background: #ef4444; color: white; }
</style>
@endpush

@section('content')
<div class="profile-banner">
    <div class="profile-header">
        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6b7280&color=fff&size=128" alt="Profile" class="profile-avatar">
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
</div>

<div class="profile-container">
    <div class="profile-grid">
        
        <div class="card">
            <div class="form-group">
                <label class="form-label">Nama</label>
                <input type="text" class="form-input" value="{{ Auth::user()->name }}" disabled>
            </div>
            <div class="form-group">
                <label class="form-label">Tanggal Lahir</label>
                <input type="text" class="form-input" value="31 - Oktober - 1982" disabled>
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-input" value="{{ Auth::user()->email }}" disabled>
            </div>
            <div class="form-group">
                <label class="form-label">Nomor Telepon</label>
                <input type="text" class="form-input" value="081923129" disabled>
            </div>
            <div class="form-group">
                <label class="form-label">Alamat</label>
                <input type="text" class="form-input" value="Jalan Icikiwir No.68, Tangerang, Indonesia" disabled>
            </div>
            <div style="text-align: right; margin-top: 24px;">
                <button class="btn-icon">
                    Edit <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                </button>
            </div>
        </div>

        <div>
            <div class="right-grid-top">
                @php
                    $riwayatTransaksi = \App\Models\Pemesanan::with(['lapangan', 'pembayaran'])
                        ->where('id_user', \Illuminate\Support\Facades\Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->take(5) // Batasi misal 5 transaksi terakhir agar tidak kepanjangan
                        ->get();

                    $totalTransaksi = \App\Models\Pemesanan::where('id_user', \Illuminate\Support\Facades\Auth::id())->count();
                    
                    $totalPengeluaran = \App\Models\Pemesanan::where('id_user', \Illuminate\Support\Facades\Auth::id())
                        ->where('status_pesanan', 'confirmed') 
                        ->sum('total_harga'); 
                @endphp

                <div class="card">
                    <div style="display: flex; gap: 8px; margin-bottom: 20px;">
                        <button style="padding: 6px 12px; border-radius: 8px; border: none; background: #9333ea; color: white; font-size: 12px;">Berdasarkan ▼</button>
                        <button style="padding: 6px 12px; border-radius: 8px; border: none; background: #9333ea; color: white; font-size: 12px;">Semua Status ▼</button>
                    </div>
                    
                    @forelse($riwayatTransaksi as $pesanan)
                        @php
                            $tanggal = \Carbon\Carbon::parse($pesanan->created_at)->translatedFormat('d M');
                            
                            switch ($pesanan->status_pesanan) {
                                case 'pending':
                                    $statusText = 'Tertunda';
                                    $badgeClass = 'badge-warning'; // Kuning
                                    break;
                                case 'confirmed':
                                    $statusText = 'Dikonfirmasi';
                                    $badgeClass = 'badge-success'; // Hijau
                                    break;
                                case 'completed':
                                    $statusText = 'Selesai';
                                    $badgeClass = 'badge-success'; // Hijau
                                    break;
                                case 'cancelled':
                                    $statusText = 'Dibatalkan';
                                    $badgeClass = 'badge-danger'; // Merah
                                    break;
                                default:
                                    $statusText = 'Tidak Diketahui';
                                    $badgeClass = 'badge-warning';
                                    break;
                            }
                        @endphp

                        <div class="history-item">
                            <span style="width: 60px;">{{ $tanggal }}</span>
                            
                            <span style="font-weight: 600; color: #111827; flex: 1;">
                                {{ \Illuminate\Support\Str::limit($pesanan->lapangan->nama ?? 'Lapangan', 15) }}
                            </span>
                            
                            <span style="margin-right: 12px;">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                            <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                        </div>
                    @empty
                        <div style="text-align: center; padding: 20px; color: #6b7280; font-size: 13px;">
                            Belum ada riwayat transaksi.
                        </div>
                    @endforelse

                    <div style="display: flex; justify-content: space-between; margin-top: 16px; font-weight: 600; font-size: 12px;">
                        <span>{{ $totalTransaksi }} Transaksi</span>
                        <span>Total: Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="card">
                    <h3 style="font-size: 14px; font-weight: 600; margin-bottom: 16px;">Notification Settings</h3>
                    
                    <div class="toggle-row">
                        <span>Payment Receipt</span>
                        <label class="toggle-switch"><input type="checkbox" checked><span class="slider"></span></label>
                    </div>
                    <div class="toggle-row">
                        <span>Payment Reminder</span>
                        <label class="toggle-switch"><input type="checkbox" checked><span class="slider"></span></label>
                    </div>
                    <div class="toggle-row">
                        <span>Offer and Promotions</span>
                        <label class="toggle-switch"><input type="checkbox"><span class="slider"></span></label>
                    </div>
                    <div class="toggle-row">
                        <span>Security Alert</span>
                        <label class="toggle-switch"><input type="checkbox" checked><span class="slider"></span></label>
                    </div>
                </div>
            </div>

            <div class="card">
                <label class="form-label">Olahraga Favorit</label>
                <div style="display: flex; align-items: flex-start; gap: 16px;">
                    <div style="flex: 1;">
                        <input type="text" class="form-input" value="Pilih olahraga favorit anda (multiseleksi)">
                        <div class="tags-container">
                            <span class="tag">Sepak Bola <span class="tag-close">×</span></span>
                            <span class="tag">Basket <span class="tag-close">×</span></span>
                            <span class="tag">Tenis <span class="tag-close">×</span></span>
                        </div>
                    </div>
                    <button class="btn-save">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="booking-card">
        <span class="booking-badge">Segera</span>
        <div style="display: flex; align-items: center; gap: 16px;">
            <div style="width: 48px; height: 48px; background: #eff6ff; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #3b82f6;">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <h2 style="font-size: 18px; font-weight: 700; color: #111827;">Lapangan Futsal A</h2>
                <div style="display: flex; align-items: center; gap: 6px; font-size: 14px; color: #6b7280; margin-top: 4px;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    GOR Bakti
                </div>
            </div>
        </div>

        <div class="booking-grid">
            <div style="display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span style="font-weight: 500;">Senin, 1 Des - 09:00</span>
            </div>
            <div style="display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                <span style="font-weight: 500;">Tim Futsal A</span>
            </div>
            <div style="color: #4b5563;">Durasi: <span style="font-weight: 600; color: #111827; margin-left: 8px;">2 Jam</span></div>
            <div style="color: #4b5563;">Harga: <span style="font-weight: 600; color: #111827; margin-left: 8px;">Rp200.000</span></div>
        </div>

        <hr style="border: none; border-top: 1px solid #bfdbfe; margin: 0 -20px;">

        <div class="booking-actions">
            <button class="btn-action purple">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; margin-right: 6px;" viewBox="0 0 24 24"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                Atur Pengingat
            </button>
            <button class="btn-action gray">Lihat Detail</button>
            <button class="btn-action red">Batalkan</button>
        </div>
    </div>
</div>
@endsection