<x-layout.layout title="Komunitas - Pengumuman Event">
    <div class="max-w-7xl mx-auto px-6 py-10">
        <h1 class="text-2xl font-bold text-gray-800">KOMUNITAS</h1>
        <p class="text-gray-600 mt-2">Terhubung dengan sesama pecinta olahraga, bergabunglah dengan tim dan jangan lewatkan event seru!</p>

        <div class="flex gap-3 mt-6">
            <a href="#" class="px-6 py-3 rounded-full text-sm font-semibold border border-gray-200 text-courtee-600 hover:bg-courtee-50 transition">Forum Diskusi</a>
            <a href="#" class="px-6 py-3 rounded-full text-sm font-semibold border border-gray-200 text-courtee-600 hover:bg-courtee-50 transition">Grup Olahraga</a>
            <a href="#" class="px-6 py-3 rounded-full text-sm font-semibold border border-gray-200 text-courtee-600 hover:bg-courtee-50 transition">Chat Internal Tim</a>
            <a href="#" class="px-6 py-3 rounded-full text-sm font-semibold bg-courtee-600 text-white shadow-md">Pengumuman Event</a>
        </div>

        <div class="flex items-center justify-between mt-6 pb-6 border-b border-gray-200">
            <div class="flex-1 max-w-lg relative">
                <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" placeholder="Masukkan Teks" class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-lg text-sm outline-none focus:border-courtee-400">
            </div>
            <button class="bg-courtee-600 text-white px-8 py-3 rounded-lg text-sm font-semibold hover:bg-courtee-700 transition">Buat Event Baru</button>
        </div>

        {{-- Events --}}
        <div class="space-y-6 mt-8">
            @php
                $events = [
                    ['name' => 'Futsal HighSchool', 'sport' => 'Futsal', 'date' => '02/12/2025 - 09/12/2025', 'price' => 'Rp 75.000,00', 'venue' => 'Ceria Sport', 'teams' => '16 tim', 'desc' => 'Event ini diadakan untuk pelajar SMA yang ingin menguji seberapa hebat timnya bermain.'],
                    ['name' => 'Voli Garuda Jaya', 'sport' => 'Voli', 'date' => '19/12/2025 - 26/12/2025', 'price' => 'Rp 75.000,00', 'venue' => 'Hana Sport Center', 'teams' => '16 tim', 'desc' => 'Peserta boleh dari berbagai klub dari daerah yang berbeda, tidak ada pembatasan. Siapa cepat dia dapat.'],
                ];
            @endphp

            @foreach($events as $event)
                <div class="border border-gray-100 rounded-xl p-6 shadow-sm">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h3 class="font-bold text-xl text-gray-800">{{ $event['name'] }}</h3>
                            <div class="mt-3 space-y-2 text-sm text-gray-600">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ $event['date'] }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                    {{ $event['venue'] }}
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="space-y-2 text-sm text-gray-600">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"/></svg>
                                    {{ $event['sport'] }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $event['price'] }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    {{ $event['teams'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 bg-courtee-50 rounded-lg p-4 text-sm text-gray-600">{{ $event['desc'] }}</div>
                    <div class="flex items-center justify-between mt-4">
                        <a href="#" class="bg-courtee-600 text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-courtee-700 transition flex items-center gap-1">
                            Daftar Sekarang <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="#" class="text-sm text-gray-500 hover:text-courtee-600 flex items-center gap-1">
                            Lihat Detail <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout.layout>
