<x-layout.admin title="Komunikasi & Feedback" activeMenu="admin.komunikasi" breadcrumb="Dashboard > Komunikasi & Feedback">

    <div x-data="{
        activeContact: 'Luky',
        contacts: [
            { name: 'Luky',  subtitle: 'Info kontak' },
            { name: 'Adnan', subtitle: 'Info kontak' },
            { name: 'Febri', subtitle: 'Info kontak' },
        ],
        messages: {
            Luky:  [
                { from: 'contact', text: 'Selamat Siang Pak',           time: '14:05' },
                { from: 'me',      text: 'Siang, Ada yang bisa saya Bantu', time: '14:15' },
            ],
            Adnan: [
                { from: 'contact', text: 'Halo, apa ada slot kosong hari ini?', time: '09:30' },
                { from: 'me',      text: 'Ada, jam berapa yang Anda inginkan?',  time: '09:32' },
            ],
            Febri: [
                { from: 'contact', text: 'Saya ingin konfirmasi pemesanan saya.', time: '11:00' },
                { from: 'me',      text: 'Baik, pemesanan Anda sudah dikonfirmasi.', time: '11:05' },
            ],
        }
    }">

        <h2 class="text-2xl font-bold text-gray-800 mb-1">Komunikasi & Feedback</h2>
        <hr class="border-gray-200 mb-6">

        {{-- ============================================================ --}}
        {{-- Chat Section                                                 --}}
        {{-- ============================================================ --}}
        <div class="rounded-2xl overflow-hidden border border-blue-100 shadow-sm mb-6" style="height: 320px; background: #C6D9F8;">
            <div class="flex h-full">

                {{-- Left: Contact List --}}
                <div class="w-56 flex-shrink-0 flex flex-col p-4 gap-3" style="background: #C6D9F8;">

                    <h3 class="text-base font-bold text-gray-800">Daftar Obrolan</h3>

                    {{-- Search --}}
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" d="M21 21l-5.2-5.2M17 11A6 6 0 115 11a6 6 0 0112 0z"/>
                        </svg>
                        <input
                            type="text"
                            placeholder="Masukkan Teks"
                            class="w-full bg-white rounded-full py-2 pl-8 pr-4 text-xs text-gray-500 outline-none border border-blue-200 focus:border-blue-400 transition"
                        >
                    </div>

                    {{-- Contacts --}}
                    <div class="flex flex-col gap-2">
                        <template x-for="contact in contacts" :key="contact.name">
                            <button
                                @click="activeContact = contact.name"
                                :class="activeContact === contact.name
                                    ? 'bg-blue-500 text-white border-blue-500'
                                    : 'bg-white text-blue-600 border-blue-200 hover:bg-blue-50'"
                                class="flex items-center gap-2.5 px-3 py-2.5 rounded-full border transition text-sm font-medium w-full text-left"
                            >
                                {{-- Avatar icon --}}
                                <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none"
                                     :class="activeContact === contact.name ? 'text-white' : 'text-blue-500'"
                                     stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span x-text="contact.name"></span>
                            </button>
                        </template>
                    </div>
                </div>

                {{-- Right: Chat View --}}
                <div class="flex-1 flex flex-col" style="background: #DAE8FC; border-left: 1px solid #b3ccf0;">

                    {{-- Chat Header --}}
                    <div class="flex items-center justify-between px-5 py-3 bg-white/60 border-b border-blue-100 flex-shrink-0">
                        <div class="flex items-center gap-3">
                            <svg class="w-8 h-8 text-blue-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-bold text-gray-800" x-text="activeContact"></p>
                                <p class="text-xs text-gray-400">Info kontak</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 text-gray-400">
                            <button class="hover:text-gray-600 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" d="M15 10l4.553-2.069A1 1 0 0121 8.845v6.31a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                            </button>
                            <button class="hover:text-gray-600 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </button>
                            <button class="hover:text-gray-600 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Messages --}}
                    <div class="flex-1 overflow-y-auto px-5 py-4 flex flex-col gap-3">
                        <template x-for="(msg, idx) in messages[activeContact]" :key="idx">
                            <div
                                :class="msg.from === 'me' ? 'justify-end' : 'justify-start'"
                                class="flex"
                            >
                                <div
                                    :class="msg.from === 'me'
                                        ? 'bg-gray-800 text-white'
                                        : 'bg-gray-600 text-white'"
                                    class="max-w-[70%] px-4 py-2 rounded-2xl text-xs flex items-end gap-2"
                                >
                                    <span x-text="msg.text"></span>
                                    <span class="text-[10px] opacity-60 flex-shrink-0" x-text="msg.time"></span>
                                </div>
                            </div>
                        </template>
                    </div>

                    {{-- Message Input --}}
                    <div class="flex items-center gap-3 px-4 py-3 bg-white/50 border-t border-blue-100 flex-shrink-0">
                        <button class="text-gray-400 hover:text-gray-600 transition flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </button>
                        <button class="text-gray-400 hover:text-gray-600 transition flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                            </svg>
                        </button>
                        <input
                            type="text"
                            placeholder="Ketik Pesan"
                            class="flex-1 bg-transparent text-sm text-gray-600 outline-none placeholder-gray-400"
                        >
                        <button class="text-gray-400 hover:text-gray-600 transition flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                            </svg>
                        </button>
                    </div>

                </div>
            </div>
        </div>

        {{-- ============================================================ --}}
        {{-- Kelola Template Pesan Otomatis                               --}}
        {{-- ============================================================ --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">

            <div class="flex items-center justify-between mb-5">
                <h3 class="text-base font-semibold text-gray-800">Kelola Template Pesan Otomatis</h3>
                <button class="px-5 py-2 bg-purple-600 text-white text-sm font-semibold rounded-lg hover:bg-purple-700 active:scale-95 transition">
                    Buat Template Baru
                </button>
            </div>

            {{-- Template Grid --}}
            <div class="border border-purple-200 rounded-xl p-4">
                <div class="grid grid-cols-2 gap-0 divide-x divide-purple-100">

                    {{-- Column 1 --}}
                    <div class="pr-6 space-y-3">
                        @php
                        $templates1 = [
                            '1. Konfirmasi Pemesanan Berhasil',
                            '2. Pengingat Pembayaran',
                            '3. Konfirmasi Pembayaran Diterima',
                        ];
                        @endphp
                        @foreach($templates1 as $t)
                        <button class="w-full text-left text-sm text-gray-700 hover:text-purple-600 py-1 border-b border-gray-100 last:border-0 transition">
                            {{ $t }}
                        </button>
                        @endforeach
                    </div>

                    {{-- Column 2 --}}
                    <div class="pl-6 space-y-3">
                        @php
                        $templates2 = [
                            '4. Pembatalan Pemesanan',
                            '5. Pengingat Jadwal Bermain',
                        ];
                        @endphp
                        @foreach($templates2 as $t)
                        <button class="w-full text-left text-sm text-gray-700 hover:text-purple-600 py-1 border-b border-gray-100 last:border-0 transition">
                            {{ $t }}
                        </button>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>

        {{-- ============================================================ --}}
        {{-- Feedback dan Ulasan Pelanggan                                --}}
        {{-- ============================================================ --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <h3 class="text-base font-semibold text-gray-800 mb-4">Feedback dan Ulasan Pelanggan</h3>

            {{-- Rating Overview --}}
            <div class="flex items-center gap-2 mb-5">
                <span class="text-sm text-gray-600">Rata-rata Rating:</span>
                <span class="text-sm font-bold text-gray-800">4.8</span>
                <span class="text-yellow-400 text-base">⭐</span>
            </div>

            {{-- Rating Bars --}}
            <div class="flex items-start gap-8 mb-6">
                <div class="space-y-2 flex-1 max-w-xs">
                    @foreach([5 => 80, 4 => 12, 3 => 5, 2 => 2, 1 => 1] as $star => $pct)
                    <div class="flex items-center gap-2 text-xs text-gray-500">
                        <span class="w-3 text-right">{{ $star }}</span>
                        <span class="text-yellow-400 text-[10px]">★</span>
                        <div class="flex-1 h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-2 bg-yellow-400 rounded-full" style="width: {{ $pct }}%"></div>
                        </div>
                        <span class="w-8 text-right">{{ $pct }}%</span>
                    </div>
                    @endforeach
                </div>

                {{-- Big Average --}}
                <div class="flex flex-col items-center justify-center w-28 h-28 rounded-2xl bg-yellow-50 border border-yellow-100 flex-shrink-0">
                    <span class="text-4xl font-bold text-gray-800">4.8</span>
                    <div class="flex text-yellow-400 text-sm mt-1">★★★★★</div>
                    <span class="text-xs text-gray-400 mt-1">dari 5.0</span>
                </div>
            </div>

            {{-- Review List --}}
            <div class="space-y-4">
                @php
                $reviews = [
                    ['name' => 'Ahmad Rizki',       'rating' => 5, 'time' => '2 hari lalu',  'text' => 'Lapangan sangat bersih dan terawat. Pelayanan staff ramah dan responsif. Akan kembali lagi!'],
                    ['name' => 'Siti Nurhaliza',    'rating' => 4, 'time' => '5 hari lalu',  'text' => 'Fasilitasnya bagus, harga cukup terjangkau. Cuma parkiran agak sempit.'],
                    ['name' => 'Budi Santoso',      'rating' => 5, 'time' => '1 minggu lalu','text' => 'Booking sangat mudah lewat aplikasi. Lapangan dalam kondisi prima.'],
                ];
                @endphp
                @foreach($reviews as $r)
                <div class="flex gap-4 pb-4 border-b border-gray-100 last:border-0">
                    {{-- Avatar --}}
                    <div class="w-9 h-9 rounded-full bg-purple-100 flex items-center justify-center flex-shrink-0">
                        <span class="text-purple-600 text-sm font-bold">{{ Str::upper(Str::substr($r['name'], 0, 1)) }}</span>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-1">
                            <p class="text-sm font-semibold text-gray-800">{{ $r['name'] }}</p>
                            <span class="text-xs text-gray-400">{{ $r['time'] }}</span>
                        </div>
                        <div class="flex text-yellow-400 text-xs mb-1">
                            @for ($s = 0; $s < $r['rating']; $s++) ★ @endfor
                            @for ($s = $r['rating']; $s < 5; $s++) <span class="text-gray-200">★</span> @endfor
                        </div>
                        <p class="text-sm text-gray-600">{{ $r['text'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

        </div>

    </div>

</x-layout.admin>
