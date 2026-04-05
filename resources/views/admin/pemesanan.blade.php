<x-layout.admin title="Daftar Pemesanan" activeMenu="admin.pemesanan" breadcrumb="Dashboard > Daftar Pemesanan">

    <h2 class="text-2xl font-bold text-purple-600 mb-6">Daftar Pemesanan</h2>

    {{-- ============================================================ --}}
    {{-- Filter Bar                                                   --}}
    {{-- ============================================================ --}}
    <div class="flex flex-wrap items-center gap-3 mb-3">

        {{-- Status --}}
        <div class="relative">
            <select class="appearance-none border border-gray-200 rounded-lg pl-4 pr-8 py-2.5 text-sm text-gray-500 outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition bg-white min-w-[130px]">
                <option value="">Status</option>
                <option>Dikonfirmasi</option>
                <option>Menunggu</option>
                <option>Selesai</option>
                <option>Dibatalkan</option>
            </select>
            <svg class="absolute right-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>

        {{-- Pembayaran --}}
        <div class="relative">
            <select class="appearance-none border border-gray-200 rounded-lg pl-4 pr-8 py-2.5 text-sm text-gray-500 outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition bg-white min-w-[140px]">
                <option value="">Pembayaran</option>
                <option>Lunas</option>
                <option>Belum Lunas</option>
            </select>
            <svg class="absolute right-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>

        {{-- Rentang Tanggal --}}
        <div class="relative">
            <select class="appearance-none border border-gray-200 rounded-lg pl-4 pr-8 py-2.5 text-sm text-gray-500 outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition bg-white min-w-[160px]">
                <option value="">Rentang Tanggal</option>
                <option>7 Hari Terakhir</option>
                <option>30 Hari Terakhir</option>
                <option>3 Bulan Terakhir</option>
                <option>Tahun Ini</option>
            </select>
            <svg class="absolute right-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>

        {{-- Cari nama pelanggan --}}
        <input
            type="text"
            placeholder="Cari nama pelanggan"
            class="border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-600 outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition min-w-[200px] flex-1 max-w-xs"
        >

    </div>

    {{-- Search Button --}}
    <button class="mb-6 px-6 py-2.5 bg-purple-600 text-white text-sm font-semibold rounded-lg hover:bg-purple-700 active:scale-95 transition">
        Search
    </button>

    {{-- ============================================================ --}}
    {{-- Table                                                        --}}
    {{-- ============================================================ --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left px-5 py-4 text-gray-700 font-semibold whitespace-nowrap">Nama Pelanggan</th>
                        <th class="text-left px-5 py-4 text-gray-700 font-semibold whitespace-nowrap">Lapangan</th>
                        <th class="text-left px-5 py-4 text-gray-700 font-semibold whitespace-nowrap">Tanggal &amp; Waktu</th>
                        <th class="text-left px-5 py-4 text-gray-700 font-semibold whitespace-nowrap">Durasi</th>
                        <th class="text-left px-5 py-4 text-gray-700 font-semibold whitespace-nowrap">Pembayaran</th>
                        <th class="text-left px-5 py-4 text-gray-700 font-semibold whitespace-nowrap">Status</th>
                        <th class="text-left px-5 py-4 text-gray-700 font-semibold whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>

                @php
                $orders = [
                    [
                        'name'       => 'Rizky Ramadhan',
                        'lapangan'   => 'Sumber Sari Jaya 1',
                        'tanggal'    => '28 Mei 2024',
                        'waktu'      => '18.00-20.00',
                        'durasi'     => '2 Jam',
                        'pembayaran' => 'Lunas',
                        'status'     => 'Dikonfirmasi',
                        'aksi'       => true,
                    ],
                    [
                        'name'       => 'Andi Pratama',
                        'lapangan'   => 'Sumber Sari Jaya 2',
                        'tanggal'    => '17 Oktober 2024',
                        'waktu'      => '16.00 - 19.00',
                        'durasi'     => '3 Jam',
                        'pembayaran' => 'Belum Lunas',
                        'status'     => 'Menunggu',
                        'aksi'       => true,
                    ],
                    [
                        'name'       => 'Samuel Alexander',
                        'lapangan'   => 'Sumber Sari Jaya 1',
                        'tanggal'    => '18 April 2024',
                        'waktu'      => '18.30 - 20.30',
                        'durasi'     => '2 Jam',
                        'pembayaran' => 'Lunas',
                        'status'     => 'Selesai',
                        'aksi'       => false,
                    ],
                    [
                        'name'       => 'Dina Wijaya',
                        'lapangan'   => 'Sumber Sari Jaya 1',
                        'tanggal'    => '30 April 2024',
                        'waktu'      => '15.00 - 20.00',
                        'durasi'     => '5 Jam',
                        'pembayaran' => 'Belum Lunas',
                        'status'     => 'Dibatalkan',
                        'aksi'       => false,
                    ],
                    [
                        'name'       => 'Asep Saepuloh',
                        'lapangan'   => 'Sumber Sari Jaya 2',
                        'tanggal'    => '24 Maret 2025',
                        'waktu'      => '12.25 - 14.25',
                        'durasi'     => '2 Jam',
                        'pembayaran' => 'Lunas',
                        'status'     => 'Selesai',
                        'aksi'       => false,
                    ],
                    [
                        'name'       => 'Daffa Ramadian',
                        'lapangan'   => 'Sumber Sari jaya 2',
                        'tanggal'    => '31 Januari 2025',
                        'waktu'      => '19.00 - 20.00',
                        'durasi'     => '1 Jam',
                        'pembayaran' => 'Lunas',
                        'status'     => 'Selesai',
                        'aksi'       => false,
                    ],
                    [
                        'name'       => 'Abimanyu Aryasatya',
                        'lapangan'   => 'Sumber Sari jaya 1',
                        'tanggal'    => '28 Februari 2025',
                        'waktu'      => '17.30 - 20.30',
                        'durasi'     => '3 Jam',
                        'pembayaran' => 'Belum Lunas',
                        'status'     => 'Dikonfirmasi',
                        'aksi'       => true,
                    ],
                    [
                        'name'       => 'Daniel Craig',
                        'lapangan'   => 'Sumber Sari jaya 2',
                        'tanggal'    => '12 Maret 2025',
                        'waktu'      => '10.00 - 14.00',
                        'durasi'     => '4 Jam',
                        'pembayaran' => 'Belum Lunas',
                        'status'     => 'Dikonfirmasi',
                        'aksi'       => true,
                    ],
                    [
                        'name'       => 'Budi Pikiran',
                        'lapangan'   => 'Sumber Sari jaya 2',
                        'tanggal'    => '19 Maret 2025',
                        'waktu'      => '12.00 - 13.00',
                        'durasi'     => '1 Jam',
                        'pembayaran' => 'Lunas',
                        'status'     => 'Selesai',
                        'aksi'       => false,
                    ],
                ];
                @endphp

                <tbody>
                    @foreach($orders as $o)
                        @php
                            $isLunas = $o['pembayaran'] === 'Lunas';
                        @endphp
                        <tr class="border-b border-gray-100 hover:bg-gray-50/60 transition-colors">

                            {{-- Nama --}}
                            <td class="px-5 py-4 text-gray-800 font-medium whitespace-nowrap">{{ $o['name'] }}</td>

                            {{-- Lapangan --}}
                            <td class="px-5 py-4 text-gray-600 whitespace-nowrap">{{ $o['lapangan'] }}</td>

                            {{-- Tanggal & Waktu --}}
                            <td class="px-5 py-4 text-gray-600">
                                <p class="whitespace-nowrap">{{ $o['tanggal'] }}</p>
                                <p class="text-xs text-gray-400 whitespace-nowrap">{{ $o['waktu'] }}</p>
                            </td>

                            {{-- Durasi --}}
                            <td class="px-5 py-4 text-gray-600 whitespace-nowrap">{{ $o['durasi'] }}</td>

                            {{-- Pembayaran badge --}}
                            <td class="px-5 py-4">
                                @if($isLunas)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-600 border border-green-200">
                                        Lunas
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-500 border border-orange-200">
                                        Belum Lunas
                                    </span>
                                @endif
                            </td>

                            {{-- Status --}}
                            <td class="px-5 py-4 text-gray-600 whitespace-nowrap">{{ $o['status'] }}</td>

                            {{-- Aksi --}}
                            <td class="px-5 py-4">
                                @if($o['aksi'])
                                    <button class="px-4 py-1.5 bg-red-500 text-white text-xs font-semibold rounded-lg hover:bg-red-600 active:scale-95 transition whitespace-nowrap">
                                        Batalkan
                                    </button>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</x-layout.admin>
