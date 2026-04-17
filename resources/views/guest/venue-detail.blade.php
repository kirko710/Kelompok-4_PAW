@extends('layouts.layout')
@section('title', 'Venue Detail - Courtee')

@push('styles')
<style>
.venue-hero { width: 100%; height: 300px; overflow: hidden; }
.venue-hero img { width: 100%; height: 100%; object-fit: cover; }
.venue-info { padding: 40px 0; }
.venue-info__name { font-size: 32px; font-weight: 700; color: var(--text-primary); }
.venue-info__location { font-size: 16px; color: var(--text-secondary); margin-top: 4px; }
.venue-socials { display: flex; gap: 12px; margin-top: 16px; }
.venue-social-icon {
    width: 36px; height: 36px; border-radius: 50%;
    background: rgba(153,87,179,0.1); display: flex; align-items: center; justify-content: center;
    color: var(--brand-primary); transition: background var(--transition);
}
.venue-social-icon:hover { background: rgba(153,87,179,0.2); }
.court-card {
    border: 1px solid var(--stroke-secondary); border-radius: 16px;
    overflow: hidden; margin-bottom: 24px; display: flex;
}
.court-card__image { width: 40%; min-height: 280px; }
.court-card__image img { width: 100%; height: 100%; object-fit: cover; }
.court-card__body { width: 60%; padding: 24px; }
.court-card__name { font-size: 18px; font-weight: 700; color: var(--text-primary); }
.court-card__desc { font-size: 14px; color: var(--text-secondary); margin-top: 8px; line-height: 1.6; }
.court-slots { display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px; margin-top: 16px; }
.court-slot {
    display: flex; justify-content: space-between; align-items: center;
    padding: 8px 12px; border-radius: var(--radius-sm); font-size: 12px; font-weight: 500;
}
.court-slot--available {
    border: 1px solid rgba(153,87,179,0.3); background: rgba(153,87,179,0.05);
    color: var(--brand-primary); cursor: pointer;
}
.court-slot--available:hover { background: var(--brand-primary); color: white; }
.court-slot--unavailable {
    border: 1px solid var(--stroke-secondary); background: #f5f5f5;
    color: #ccc; cursor: not-allowed;
}
.btn-cta {
    width: 100%; padding: 16px; background: var(--brand-primary); color: white;
    border: none; border-radius: 12px; font-size: 16px; font-weight: 600;
    font-family: var(--font-base); cursor: pointer; margin-top: 32px;
    transition: opacity var(--transition);
}
.btn-cta:hover { opacity: 0.85; }
@media (max-width: 768px) {
    .court-card { flex-direction: column; }
    .court-card__image, .court-card__body { width: 100%; }
    .court-slots { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')
<div class="venue-hero">
    <img src="https://images.unsplash.com/photo-1529900748604-07564a03e7a6?w=1400&q=80" alt="Venue">
</div>

<div class="container">
    <div class="venue-info">
        <h1 class="venue-info__name">Longfield Sport Center</h1>
        <p class="venue-info__location">Jakarta Pusat</p>
        <div class="venue-socials">
            <a href="#" class="venue-social-icon"><svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069z"/></svg></a>
            <a href="#" class="venue-social-icon"><svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
        </div>

        <div style="margin-top: 32px;">
            <select class="filter-input" style="max-width: 300px; padding: 10px 16px;">
                <option>20 Desember 2025</option>
                <option>21 Desember 2025</option>
            </select>
        </div>

        <h2 style="font-size: 22px; font-weight: 700; margin-top: 40px; margin-bottom: 24px;">Lapangan yang Tersedia</h2>

        @php
            $courts = [
                ['name' => 'Lapangan Sejahtera', 'desc' => 'Lapangan rumput sintetis berkualitas dengan penerangan malam, gawang standar, dan area bersih. Cocok untuk latihan, pertandingan persahabatan, serta kegiatan komunitas.', 'img' => 'https://images.unsplash.com/photo-1575361204480-aadea25e6e68?w=600&q=80'],
                ['name' => 'Lapangan Makmur', 'desc' => 'Lapangan rumput sintetis berkualitas dengan penerangan malam, gawang standar, dan area bersih. Cocok untuk latihan dan pertandingan.', 'img' => 'https://images.unsplash.com/photo-1529900748604-07564a03e7a6?w=600&q=80'],
            ];
            $timeSlots = [
                ['time' => '06.00-07.00', 'price' => 'Rp 24.000,00', 'available' => true],
                ['time' => '07.00-08.00', 'price' => 'Rp 24.000,00', 'available' => true],
                ['time' => '09.00-10.00', 'price' => 'Rp 24.000,00', 'available' => true],
                ['time' => '10.00-11.00', 'price' => 'Rp 24.000,00', 'available' => false],
                ['time' => '11.00-12.00', 'price' => 'Rp 24.000,00', 'available' => false],
                ['time' => '13.00-14.00', 'price' => 'Rp 24.000,00', 'available' => false],
                ['time' => '14.00-15.00', 'price' => 'Rp 24.000,00', 'available' => true],
                ['time' => '16.00-17.00', 'price' => 'Rp 24.000,00', 'available' => true],
            ];
        @endphp

        @foreach($courts as $court)
        <div class="court-card">
            <div class="court-card__image">
                <img src="{{ $court['img'] }}" alt="{{ $court['name'] }}">
            </div>
            <div class="court-card__body">
                <h3 class="court-card__name">{{ $court['name'] }}</h3>
                <p class="court-card__desc">{{ $court['desc'] }}</p>
                <div class="court-slots">
                    @foreach($timeSlots as $slot)
                        <div class="court-slot {{ $slot['available'] ? 'court-slot--available' : 'court-slot--unavailable' }}">
                            <span>{{ $slot['time'] }}</span>
                            <span>{{ $slot['price'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach

        <a href="/detail-pemesanan"><button class="btn-cta">Lanjutkan ke Pembayaran</button></a>
    </div>
</div>
@endsection
