<x-layout.layout title="Venue">
    {{-- Search Section --}}
    <section class="bg-courtee-50 py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center gap-2 mb-6">
                <svg class="w-5 h-5 text-courtee-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                </svg>
                <h2 class="text-lg font-bold text-gray-800">BOOKING LAPANGAN YANG ANDA INGINKAN</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div class="bg-white border border-gray-200 rounded-lg px-4 py-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <select class="flex-1 text-sm text-gray-600 outline-none appearance-none bg-transparent">
                        <option>Jenis Lapangan</option>
                        <option>Futsal</option>
                        <option>Badminton</option>
                        <option>Tennis</option>
                    </select>
                </div>
                <div class="bg-white border border-gray-200 rounded-lg px-4 py-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" placeholder="Lapangan" class="flex-1 text-sm text-gray-600 outline-none bg-transparent">
                </div>
                <div class="bg-white border border-gray-200 rounded-lg px-4 py-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    <input type="text" placeholder="Lokasi" class="flex-1 text-sm text-gray-600 outline-none bg-transparent">
                </div>
                <div class="bg-white border border-gray-200 rounded-lg px-4 py-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <input type="date" class="flex-1 text-sm text-gray-600 outline-none bg-transparent">
                </div>
                <div class="bg-white border border-gray-200 rounded-lg px-4 py-3">
                    <select class="w-full text-sm text-gray-600 outline-none appearance-none bg-transparent">
                        <option>Harga</option>
                        <option>Termurah</option>
                        <option>Termahal</option>
                    </select>
                </div>
            </div>
            <button class="mt-4 bg-courtee-600 text-white px-8 py-3 rounded-lg text-sm font-semibold hover:bg-courtee-700 transition">Cari</button>
        </div>
    </section>

    {{-- Venue Results --}}
    <section class="max-w-7xl mx-auto px-6 py-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @php
                $venues = [
                    ['name' => 'Longfield Sport Centre', 'type' => 'Lapangan Mini Soccer', 'location' => 'Jakarta Selatan', 'date' => 'Sabtu, 25-9-2022', 'slots' => ['07.00-08.00','08.00-09.00','10.00-11.00','13.00-14.00','14.00-15.00']],
                    ['name' => 'Sigmoid Badminton', 'type' => 'Lapangan Badminton', 'location' => 'Tangerang Selatan', 'date' => 'Sabtu, 25-9-2022', 'slots' => ['07.00-08.00','08.00-09.00','10.00-11.00','13.00-14.00','14.00-15.00']],
                    ['name' => 'Culture Padel', 'type' => 'Lapangan Padel', 'location' => 'Tangerang Selatan', 'date' => 'Sabtu, 25-9-2022', 'slots' => ['07.00-08.00','08.00-09.00','10.00-11.00','13.00-14.00','14.00-15.00']],
                    ['name' => 'Bikasoga Swimming', 'type' => 'Kolam Renang', 'location' => 'Bandung', 'date' => 'Sabtu, 25-9-2022', 'slots' => ['07.00-08.00','08.00-09.00','10.00-11.00','13.00-14.00','14.00-15.00']],
                ];
            @endphp

            @foreach($venues as $v)
                <div class="bg-courtee-50/50 rounded-2xl p-6 border border-courtee-100">
                    <h3 class="font-bold text-lg text-gray-800">{{ $v['name'] }}</h3>
                    <p class="text-sm text-gray-600 mt-1">{{ $v['type'] }}</p>
                    <p class="text-sm text-gray-500">{{ $v['location'] }}</p>
                    <p class="text-sm text-gray-400 mt-1">{{ $v['date'] }}</p>

                    <div class="flex flex-wrap gap-2 mt-4">
                        @foreach($v['slots'] as $slot)
                            <span class="text-xs px-3 py-1.5 rounded-lg border border-courtee-200 text-courtee-600 bg-white cursor-pointer hover:bg-courtee-600 hover:text-white transition">
                                {{ $slot }}
                            </span>
                        @endforeach
                    </div>

                    <div class="mt-5 flex justify-end">
                        <a href="#" class="bg-courtee-600 text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-courtee-700 transition">
                            Check Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-layout.layout>
