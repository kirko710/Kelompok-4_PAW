<x-layout.layout title="Home">
    @push('styles')
    <style>
        .hero-overlay { background: linear-gradient(180deg, rgba(88,28,135,0.6) 0%, rgba(126,34,206,0.45) 100%); }
        .venue-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .venue-card:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(126,34,206,0.12); }
        .time-slot { transition: background-color 0.2s, color 0.2s; }
        .time-slot:hover { background-color: #7e22ce; color: white; }
    </style>
    @endpush

    {{-- ========== HERO SECTION ========== --}}
    <section class="relative h-[420px] bg-gradient-to-r from-courtee-900 to-courtee-600 overflow-hidden">
        {{-- Background Image --}}
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1574629810360-7efbbe195018?w=1400&q=80');">
            <div class="hero-overlay absolute inset-0"></div>
        </div>

        {{-- Search Form --}}
        <div class="relative z-10 max-w-2xl mx-auto px-6 pt-20">
            <div class="space-y-3">
                <div class="bg-white/90 backdrop-blur-sm rounded-lg px-5 py-3 flex items-center gap-3 shadow-lg">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <select class="flex-1 bg-transparent text-gray-700 text-sm outline-none appearance-none cursor-pointer">
                        <option>Daerah</option>
                        <option>Jakarta Pusat</option>
                        <option>Jakarta Selatan</option>
                        <option>Bandung</option>
                        <option>Malang</option>
                        <option>Bekasi</option>
                    </select>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"/></svg>
                </div>

                <div class="bg-white/90 backdrop-blur-sm rounded-lg px-5 py-3 flex items-center gap-3 shadow-lg">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    <select class="flex-1 bg-transparent text-gray-700 text-sm outline-none appearance-none cursor-pointer">
                        <option>Jenis Olahraga</option>
                        <option>Futsal</option>
                        <option>Badminton</option>
                        <option>Tenis</option>
                        <option>Basket</option>
                        <option>Renang</option>
                    </select>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"/></svg>
                </div>

                <div class="bg-white/90 backdrop-blur-sm rounded-lg px-5 py-3 flex items-center gap-3 shadow-lg">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <input type="date" class="flex-1 bg-transparent text-gray-700 text-sm outline-none cursor-pointer" placeholder="Tanggal">
                </div>

                <button class="w-full bg-courtee-700 text-white py-3 rounded-lg font-semibold text-sm hover:bg-courtee-800 transition shadow-lg">
                    Cari Lapangan
                </button>
            </div>
        </div>
    </section>

    {{-- ========== REKOMENDASI VENUE ========== --}}
    <section class="max-w-7xl mx-auto px-6 py-16">
        <h2 class="text-2xl font-bold text-courtee-700 text-center mb-10">Rekomendasi Venue</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $venues = [
                    ['name' => 'Longfield Sport Center', 'type' => 'Lapangan Sepak Bola', 'location' => 'Jakarta Pusat', 'price' => '25.000', 'img' => 'https://images.unsplash.com/photo-1529900748604-07564a03e7a6?w=600&q=80', 'slots' => ['07:00-08:00','08:00-09:00','10:00-11:00','13:00-14:00','14:00-15:00']],
                    ['name' => 'Culture Padel', 'type' => 'Lapangan Padel', 'location' => 'Bandung', 'price' => '40.000', 'img' => 'https://images.unsplash.com/photo-1554068865-24cecd4e34b8?w=600&q=80', 'slots' => ['05:00-06:00','09:00-10:00','13:00-14:00']],
                    ['name' => 'Balistic Badminton', 'type' => 'Lapangan Badminton', 'location' => 'Bekasi', 'price' => '35.000', 'img' => 'https://images.unsplash.com/photo-1626224583764-f87db24ac4ea?w=600&q=80', 'slots' => ['07:00-08:00','08:00-09:00','10:00-11:00','14:00-15:00']],
                    ['name' => 'Sumber Sari Jaya', 'type' => 'Lapangan Mini Soccer', 'location' => 'Jakarta Timur', 'price' => '25.000', 'img' => 'https://images.unsplash.com/photo-1575361204480-aadea25e6e68?w=600&q=80', 'slots' => ['07:00-08:00','08:00-09:00','10:00-11:00','13:00-14:00','14:00-15:00']],
                    ['name' => 'Singhasari Tennis Club', 'type' => 'Lapangan Tennis', 'location' => 'Malang', 'price' => '40.000', 'img' => 'https://images.unsplash.com/photo-1622279457486-62dcc4a431d6?w=600&q=80', 'slots' => ['05:00-06:00','09:00-10:00','13:00-14:00']],
                    ['name' => 'Sigmoid Badminton', 'type' => 'Lapangan Badminton', 'location' => 'Jakarta Pusat', 'price' => '35.000', 'img' => 'https://images.unsplash.com/photo-1626224583764-f87db24ac4ea?w=600&q=80', 'slots' => ['07:00-08:00','08:00-09:00','10:00-11:00','13:00-14:00','14:00-15:00']],
                ];
            @endphp

            @foreach($venues as $venue)
                <div class="venue-card bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm">
                    {{-- Image --}}
                    <div class="h-48 overflow-hidden">
                        <img src="{{ $venue['img'] }}" alt="{{ $venue['name'] }}"
                             class="w-full h-full object-cover hover:scale-105 transition duration-500">
                    </div>

                    {{-- Content --}}
                    <div class="p-5">
                        <h3 class="font-bold text-gray-800 text-lg">{{ $venue['name'] }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $venue['type'] }}</p>
                        <p class="text-sm text-gray-400">{{ $venue['location'] }}</p>

                        <p class="mt-3 text-courtee-700 font-semibold text-sm">Rp {{ $venue['price'] }}/jam</p>

                        {{-- Time Slots --}}
                        <div class="flex flex-wrap gap-2 mt-3">
                            @foreach($venue['slots'] as $slot)
                                <span class="time-slot text-xs px-2.5 py-1 rounded-full border border-courtee-200 text-courtee-600 cursor-pointer">
                                    {{ $slot }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-layout.layout>
