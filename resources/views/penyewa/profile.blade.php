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
    
    .btn-save { background: #9333ea; color: white; border: none; padding: 10px 24px; border-radius: 8px; font-weight: 500; cursor: pointer; }
    .booking-card { border: 1px solid #bfdbfe; border-radius: 12px; padding: 20px; position: relative; padding-top: 52px; }    
    .booking-badge { 
        position: absolute; top: 16px; right: 20px; 
        background: #9333ea; color: white; padding: 6px 10px; border-radius: 8px;
        font-size: 12px; font-weight: 600; z-index: 5;
    }    
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
            {{-- Edit form (penyewa) --}}
            <form action="{{ route('user.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-input" value="{{ old('tanggal_lahir', optional($profile)->tanggal_lahir) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input" value="{{ old('email', $user->email) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="telepon" class="form-input" value="{{ old('telepon', optional($profile)->telepon) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-input" value="{{ old('alamat', optional($profile)->alamat) }}">
                </div>

                <div style="text-align: right; margin-top: 24px;">
                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                </div>
            </form>
        </div>

        <div>
            <div class="right-grid-top">
                {{-- Ringkasan transaksi singkat (tetap minimal) --}}
                <div class="card">
                    <div style="display: flex; gap: 8px; margin-bottom: 20px;">
                        <button style="padding: 6px 12px; border-radius: 8px; border: none; background: #9333ea; color: white; font-size: 12px;">Ringkasan</button>
                    </div>

                    <div style="font-size:14px; color:#111827;">
                        <p><strong>{{ $totalTransaksi ?? 0 }} Transaksi</strong></p>
                        <p style="margin-top:8px;">Total pengeluaran: <strong>Rp {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}</strong></p>
                    </div>
                </div>
            </div>

            {{-- Jadwal terdekat dari sekarang (dipindah ke sisi kanan) --}}
            <div class="booking-card" style="margin-top:24px;">
                <span class="booking-badge">Jadwal Terdekat</span>
                @if($upcomingBookings && $upcomingBookings->count())
                    @foreach($upcomingBookings as $booking)
                        @php
                            $datePart = \Carbon\Carbon::parse($booking->tanggal_pesan)->format('Y-m-d');
                            $timePart = \Carbon\Carbon::parse($booking->waktu_mulai)->format('H:i:s');
                            $start = \Carbon\Carbon::parse($datePart . ' ' . $timePart);
                            $label = $start->translatedFormat('D, d M Y') . ' - ' . $start->format('H:i');
                        @endphp

                        <div style="display:flex; justify-content:space-between; gap:16px; padding:12px 0; border-bottom:1px solid #f3f4f6;">
                            <div style="flex:1;">
                                <div style="font-weight:700;">{{ $booking->lapangan->nama ?? 'Lapangan' }}</div>
                                <div style="color:#6b7280; font-size:13px;">{{ $booking->lapangan->venue->lokasi ?? '' }}</div>
                            </div>
                            <div style="text-align:right;">
                                <div style="font-weight:600;">{{ $label }}</div>
                                <div style="color:#4b5563; margin-top:6px;">Durasi: {{ \Carbon\Carbon::parse($booking->waktu_mulai)->diffInMinutes(\Carbon\Carbon::parse($booking->waktu_selesai)) / 60 }} Jam</div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div style="text-align:center; padding:20px; color:#6b7280;">Tidak ada jadwal mendatang.</div>
                @endif
            </div>
        </div>
    </div>
@endsection