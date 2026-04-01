<x-layout.layout title="Komunitas - Grup Olahraga">
    <div class="max-w-7xl mx-auto px-6 py-10">
        <h1 class="text-2xl font-bold text-gray-800">KOMUNITAS</h1>
        <p class="text-gray-600 mt-2">Terhubung dengan sesama pecinta olahraga, bergabunglah dengan tim dan jangan lewatkan event seru!</p>

        {{-- Tabs --}}
        <div class="flex gap-3 mt-6">
            <a href="#" class="px-6 py-3 rounded-full text-sm font-semibold border border-gray-200 text-courtee-600 hover:bg-courtee-50 transition">Forum Diskusi</a>
            <a href="#" class="px-6 py-3 rounded-full text-sm font-semibold bg-courtee-600 text-white shadow-md">Grup Olahraga</a>
            <a href="#" class="px-6 py-3 rounded-full text-sm font-semibold border border-gray-200 text-courtee-600 hover:bg-courtee-50 transition">Chat Internal Tim</a>
            <a href="#" class="px-6 py-3 rounded-full text-sm font-semibold border border-gray-200 text-courtee-600 hover:bg-courtee-50 transition">Pengumuman Event</a>
        </div>

        {{-- Search + Create --}}
        <div class="flex items-center justify-between mt-6 pb-6 border-b border-gray-200">
            <div class="flex-1 max-w-lg relative">
                <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" placeholder="Masukkan Teks" class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-lg text-sm outline-none focus:border-courtee-400">
            </div>
            <button class="bg-courtee-600 text-white px-8 py-3 rounded-lg text-sm font-semibold hover:bg-courtee-700 transition">Buat Grup Baru</button>
        </div>

        {{-- Grup Saya --}}
        <div class="mt-8">
            <h2 class="font-bold text-gray-800 text-lg">Grup Saya</h2>
            <div class="flex gap-4 mt-4">
                @foreach(['Street Football', 'Futsal Gacor', 'Badmin Jago'] as $group)
                    <div class="px-8 py-4 bg-courtee-50 border border-courtee-100 rounded-xl text-courtee-600 font-medium text-sm hover:bg-courtee-100 transition cursor-pointer">
                        {{ $group }}
                    </div>
                @endforeach
            </div>
            <a href="#" class="inline-flex items-center gap-1 mt-3 text-sm text-gray-500 hover:text-courtee-600">
                Lihat Semua Grup <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        {{-- Gabung Grup --}}
        <div class="mt-10">
            <h2 class="font-bold text-gray-800 text-lg">Gabung Grup</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                @php
                    $groups = [
                        ['name' => 'Futsal Night', 'members' => 13, 'location' => 'Malang', 'emoji' => '&#9917;'],
                        ['name' => 'Padel Ceria', 'members' => 27, 'location' => 'Jakarta', 'emoji' => '&#127934;'],
                    ];
                @endphp
                @foreach($groups as $g)
                    <div class="border border-gray-100 rounded-xl p-6 shadow-sm">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="font-bold text-xl text-gray-800">{{ $g['name'] }}</h3>
                                <div class="flex items-center gap-4 mt-2 text-sm text-gray-500">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        {{ $g['members'] }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                        {{ $g['location'] }}
                                    </span>
                                </div>
                            </div>
                            <span class="text-2xl">{!! $g['emoji'] !!}</span>
                        </div>
                        <button class="mt-4 flex items-center gap-1 text-sm font-medium text-courtee-600 border border-courtee-200 px-4 py-2 rounded-lg hover:bg-courtee-50 transition">
                            Gabung <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout.layout>
