@extends('layouts.layout')
@section('title', 'Cari Venue - Courtee')

@push('styles')
<style>
.search-section {
    background: linear-gradient(135deg, rgba(153,87,179,0.08), rgba(77,45,108,0.05));
    padding: 40px 0;
}
.search-section__title {
    font-size: 18px;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.search-filters {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 16px;
    margin-bottom: 16px;
}
.filter-input {
    padding: 12px 16px;
    background: var(--fill-base);
    border: 1px solid var(--stroke-secondary);
    border-radius: var(--radius-sm);
    font-size: 14px;
    font-family: var(--font-base);
    color: var(--text-secondary);
    outline: none;
}
.filter-input:focus { border-color: var(--brand-primary); }
.venue-results {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
    padding: 40px 0;
}
.venue-result-card {
    background: rgba(153,87,179,0.05);
    border: 1px solid rgba(153,87,179,0.15);
    border-radius: 16px;
    padding: 24px;
}
.venue-result-card__name {
    font-size: 18px;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 4px;
}
.venue-result-card__meta {
    font-size: 14px;
    color: var(--text-secondary);
    line-height: 1.6;
}
.venue-result-card__slots {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 16px;
}
.slot-badge {
    padding: 8px 16px;
    border: 1px solid rgba(153,87,179,0.3);
    border-radius: var(--radius-sm);
    font-size: 12px;
    font-weight: 500;
    color: var(--brand-primary);
    background: var(--fill-base);
    cursor: pointer;
    transition: all var(--transition);
}
.slot-badge:hover {
    background: var(--brand-primary);
    color: var(--text-white);
}
@media (max-width: 768px) {
    .search-filters { grid-template-columns: 1fr; }
    .venue-results { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')
<section class="search-section">
    <div class="container">
        <div class="search-section__title">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
            BOOKING LAPANGAN YANG ANDA INGINKAN
        </div>
        <div class="search-filters">
            <select class="filter-input">
                <option>Jenis Lapangan</option>
                <option>Futsal</option>
                <option>Badminton</option>
                <option>Tennis</option>
            </select>
            <input type="text" class="filter-input" placeholder="Lapangan">
            <input type="text" class="filter-input" placeholder="Lokasi">
            <input type="date" class="filter-input">
            <select class="filter-input">
                <option>Harga</option>
                <option>Termurah</option>
                <option>Termahal</option>
            </select>
        </div>
        <button class="btn btn--primary" style="padding: 12px 32px;">Cari</button>
    </div>
</section>

<div class="container">
    <div class="venue-results">
        @php
            $venues = [
                ['name' => 'Longfield Sport Centre', 'type' => 'Lapangan Mini Soccer', 'location' => 'Jakarta Selatan', 'date' => 'Sabtu, 25-9-2022'],
                ['name' => 'Sigmoid Badminton', 'type' => 'Lapangan Badminton', 'location' => 'Tangerang Selatan', 'date' => 'Sabtu, 25-9-2022'],
                ['name' => 'Culture Padel', 'type' => 'Lapangan Padel', 'location' => 'Tangerang Selatan', 'date' => 'Sabtu, 25-9-2022'],
                ['name' => 'Bikasoga Swimming', 'type' => 'Kolam Renang', 'location' => 'Bandung', 'date' => 'Sabtu, 25-9-2022'],
            ];
            $slots = ['07.00-08.00','08.00-09.00','10.00-11.00','13.00-14.00','14.00-15.00'];
        @endphp

        @foreach($venues as $v)
        <div class="venue-result-card">
            <div class="venue-result-card__name">{{ $v['name'] }}</div>
            <div class="venue-result-card__meta">
                {{ $v['type'] }}<br>
                {{ $v['location'] }}<br>
                {{ $v['date'] }}
            </div>
            <div class="venue-result-card__slots">
                @foreach($slots as $slot)
                    <span class="slot-badge">{{ $slot }}</span>
                @endforeach
            </div>
            <div style="margin-top: 20px; text-align: right;">
                <a href="/venue/1" class="btn btn--primary" style="padding: 10px 24px;">Check Details</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
