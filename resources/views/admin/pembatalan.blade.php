<x-layout.admin title="Pembatalan & Refund" activeMenu="admin.pembatalan" breadcrumb="Dashboard > Pembatalan & Refund">

    <div x-data="{ tab: 'semua' }">

        <h2 class="text-2xl font-bold text-purple-600 mb-5">Pembatalan & Refund</h2>

        {{-- ============================================================ --}}
        {{-- Tab Navigation                                               --}}
        {{-- ============================================================ --}}
        <div class="flex items-center gap-1 mb-6">

            {{-- Semua Permintaan --}}
            <button
                @click="tab = 'semua'"
                :class="tab === 'semua'
                    ? 'bg-purple-600 text-white'
                    : 'bg-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-100'"
                class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
                Semua Permintaan
            </button>

            {{-- Konfirmasi Permintaan --}}
            <button
                @click="tab = 'konfirmasi'"
                :class="tab === 'konfirmasi'
                    ? 'bg-purple-600 text-white'
                    : 'bg-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-100'"
                class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Konfirmasi Permintaan
            </button>

            {{-- Disetujui --}}
            <button
                @click="tab = 'disetujui'"
                :class="tab === 'disetujui'
                    ? 'bg-purple-600 text-white'
                    : 'bg-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-100'"
                class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Disetujui
            </button>

            {{-- Ditolak --}}
            <button
                @click="tab = 'ditolak'"
                :class="tab === 'ditolak'
                    ? 'bg-purple-600 text-white'
                    : 'bg-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-100'"
                class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Ditolak
            </button>

        </div>

        {{-- ============================================================ --}}
        {{-- Content Card                                                 --}}
        {{-- ============================================================ --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">

            {{-- Filter Bar --}}
            <div class="flex flex-wrap items-center gap-3 mb-6">

                {{-- Status & Refund --}}
                <div class="relative">
                    <select class="appearance-none border border-gray-200 rounded-lg pl-4 pr-8 py-2.5 text-sm text-gray-500 outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition bg-white min-w-[170px]">
                        <option value="">Status &amp; Refund</option>
                        <option>Menunggu</option>
                        <option>Selesai</option>
                        <option>Ditolak</option>
                    </select>
                    <svg class="absolute right-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>

                {{-- Tanggal --}}
                <div class="relative">
                    <input
                        type="date"
                        placeholder="Tanggal"
                        class="border border-gray-200 rounded-lg pl-4 pr-10 py-2.5 text-sm text-gray-500 outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition min-w-[160px]"
                    >
                    <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>

                {{-- Cari nama pelanggan --}}
                <input
                    type="text"
                    placeholder="Cari nama pelanggan"
                    class="border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-500 outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition flex-1 min-w-[200px] max-w-sm"
                >

                {{-- Search --}}
                <button class="px-6 py-2.5 bg-purple-600 text-white text-sm font-semibold rounded-lg hover:bg-purple-700 active:scale-95 transition">
                    Search
                </button>

            </div>

            {{-- ============================================================ --}}
            {{-- Table                                                        --}}
            {{-- ============================================================ --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm">

                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left px-4 py-3.5 text-gray-700 font-semibold whitespace-nowrap">Kode Booking</th>
                            <th class="text-left px-4 py-3.5 text-gray-700 font-semibold whitespace-nowrap">Nama Penyewa</th>
                            <th class="text-left px-4 py-3.5 text-gray-700 font-semibold whitespace-nowrap">Lapangan</th>
                            <th class="text-left px-4 py-3.5 text-gray-700 font-semibold whitespace-nowrap">Jadwal Pesanan</th>
                            <th class="text-left px-4 py-3.5 text-gray-700 font-semibold whitespace-nowrap">Alasan Pembatalan</th>
                            <th class="text-left px-4 py-3.5 text-gray-700 font-semibold whitespace-nowrap">Status Refund</th>
                            <th class="text-left px-4 py-3.5 text-gray-700 font-semibold whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>

                    @php
                    $rows = [
                        [
                            'kode'    => 'BK-1078231',
                            'nama'    => 'Samuel Alexander',
                            'lap'     => 'Sumber Sari Jaya 1',
                            'tanggal' => '18 April 2024',
                            'waktu'   => '18.30 - 20.30',
                            'alasan'  => 'Terjadi Kesalahan dalam pemesanan',
                            'status'  => 'Menunggu',
                            'aksi'    => 'refund',
                        ],
                        [
                            'kode'    => 'BK-1078241',
                            'nama'    => 'Andi Pratama',
                            'lap'     => 'Sumber Sari Jaya 2',
                            'tanggal' => '17 Oktober 2024',
                            'waktu'   => '16.00 - 19.00',
                            'alasan'  => 'Perubahan Rencana',
                            'status'  => 'Selesai',
                            'aksi'    => 'refund',
                        ],
                        [
                            'kode'    => 'BK-1078251',
                            'nama'    => 'Dina Wijaya',
                            'lap'     => 'Sumber Sari Jaya 1',
                            'tanggal' => '30 April 2024',
                            'waktu'   => '15.00 - 20.00',
                            'alasan'  => 'Perubahan Rencana',
                            'status'  => 'Ditolak',
                            'aksi'    => 'detail',
                        ],
                        [
                            'kode'    => 'BK-1078262',
                            'nama'    => 'Asep Saepuloh',
                            'lap'     => 'Sumber Sari Jaya 2',
                            'tanggal' => '24 Maret 2025',
                            'waktu'   => '12.25 - 14.25',
                            'alasan'  => 'Terjadi Kesalahan',
                            'status'  => 'Menunggu',
                            'aksi'    => 'refund',
                        ],
                        [
                            'kode'    => 'BK-1078271',
                            'nama'    => 'Daffa Ramadian',
                            'lap'     => 'Sumber Sari Jaya 2',
                            'tanggal' => '28 Maret 2025',
                            'waktu'   => '12.25 - 14.25',
                            'alasan'  => 'Perubahan Rencana',
                            'status'  => 'Selesai',
                            'aksi'    => 'refund',
                        ],
                        [
                            'kode'    => 'BK-1078272',
                            'nama'    => 'Bagas Pradipta',
                            'lap'     => 'Sumber Sari Jaya 2',
                            'tanggal' => '12 April 2025',
                            'waktu'   => '13.00 - 15.00',
                            'alasan'  => 'Terjadi Kesalahan',
                            'status'  => 'Ditolak',
                            'aksi'    => 'detail',
                        ],
                        [
                            'kode'    => 'BK-1078273',
                            'nama'    => 'Bima Saputra',
                            'lap'     => 'Sumber Sari Jaya 1',
                            'tanggal' => '19 Mei 2025',
                            'waktu'   => '19.00 - 23.00',
                            'alasan'  => 'Salah Mengisi Jadwal',
                            'status'  => 'Menunggu',
                            'aksi'    => 'refund',
                        ],
                        [
                            'kode'    => 'BK-1078282',
                            'nama'    => 'Aldi Prasetyo',
                            'lap'     => 'Sumber Sari Jaya 1',
                            'tanggal' => '28 Juli 2025',
                            'waktu'   => '15.00 - 18.00',
                            'alasan'  => 'Terjadi Kesalahan',
                            'status'  => 'Ditolak',
                            'aksi'    => 'detail',
                        ],
                    ];
                    @endphp

                    <tbody>
                        @foreach($rows as $r)
                            @php
                                $badge = match($r['status']) {
                                    'Menunggu' => 'bg-orange-100 text-orange-500 border-orange-200',
                                    'Selesai'  => 'bg-green-100 text-green-600 border-green-200',
                                    'Ditolak'  => 'bg-red-100 text-red-500 border-red-200',
                                    default    => 'bg-gray-100 text-gray-500 border-gray-200',
                                };
                            @endphp
                            <tr class="border-b border-gray-100 hover:bg-gray-50/50 transition-colors">

                                {{-- Kode Booking --}}
                                <td class="px-4 py-4 text-gray-600 font-mono text-xs whitespace-nowrap">{{ $r['kode'] }}</td>

                                {{-- Nama Penyewa --}}
                                <td class="px-4 py-4 text-gray-800 font-medium whitespace-nowrap">{{ $r['nama'] }}</td>

                                {{-- Lapangan --}}
                                <td class="px-4 py-4 text-gray-600 whitespace-nowrap">{{ $r['lap'] }}</td>

                                {{-- Jadwal Pesanan --}}
                                <td class="px-4 py-4 text-gray-600">
                                    <p class="whitespace-nowrap">{{ $r['tanggal'] }}</p>
                                    <p class="text-xs text-gray-400 whitespace-nowrap">{{ $r['waktu'] }}</p>
                                </td>

                                {{-- Alasan Pembatalan --}}
                                <td class="px-4 py-4 text-gray-600 max-w-[160px]">{{ $r['alasan'] }}</td>

                                {{-- Status Refund --}}
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border {{ $badge }}">
                                        {{ $r['status'] }}
                                    </span>
                                </td>

                                {{-- Aksi --}}
                                <td class="px-4 py-4">
                                    @if($r['aksi'] === 'refund')
                                        <button class="px-4 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold rounded-lg active:scale-95 transition whitespace-nowrap">
                                            Refund
                                        </button>
                                    @else
                                        <button class="px-4 py-1.5 bg-slate-700 hover:bg-slate-800 text-white text-xs font-semibold rounded-lg active:scale-95 transition whitespace-nowrap">
                                            Lihat Detail
                                        </button>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>

    </div>

</x-layout.admin>
