<x-layout.admin title="Verifikasi Pembayaran" activeMenu="admin.verifikasi" breadcrumb="Dashboard > Verifikasi Pembayaran">

    {{-- Page Title --}}
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Verifikasi Pembayaran</h2>

    {{-- Main Card --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">

        {{-- Section Header --}}
        <div class="flex items-center gap-2 mb-6">
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <h3 class="font-bold text-gray-800 text-base">Notifikasi Pembayaran</h3>
        </div>

        {{-- Payment Notification List --}}
        @php
            $payments = [
                [
                    'method'    => 'QRIS',
                    'time'      => '2 menit yang lalu',
                    'from'      => 'Ahmad Brandon',
                    'amount'    => 'Rp 55.100,00',
                    'court'     => 'Lapangan Sejahtera',
                    'slots'     => [
                        '07.00-08.00 — 20 Desember 2025',
                        '09.00-10.00 — 20 Desember 2025',
                    ],
                    'confirmed' => false,
                ],
                [
                    'method'    => 'Mobile Banking',
                    'time'      => '2 menit yang lalu',
                    'from'      => 'Adityawarman',
                    'amount'    => 'Rp 48.000,00',
                    'court'     => 'Lapangan Sejahtera',
                    'slots'     => [
                        '13.00-14.00 — 20 Desember 2025',
                        '10.00-11.00 — 20 Desember 2025',
                    ],
                    'confirmed' => true,
                ],
                [
                    'method'    => 'QRIS',
                    'time'      => '5 menit yang lalu',
                    'from'      => 'Ahmad Trisnawan',
                    'amount'    => 'Rp 55.100,00',
                    'court'     => 'Lapangan Sejahtera',
                    'slots'     => [
                        '07.00-08.00 — 20 Desember 2025',
                        '09.00-10.00 — 20 Desember 2025',
                    ],
                    'confirmed' => false,
                ],
                [
                    'method'    => 'QRIS',
                    'time'      => '10 menit yang lalu',
                    'from'      => 'Ahmad Trisnawan',
                    'amount'    => 'Rp 55.100,00',
                    'court'     => 'Lapangan Sejahtera',
                    'slots'     => [
                        '07.00-08.00 — 20 Desember 2025',
                        '09.00-10.00 — 20 Desember 2025',
                    ],
                    'confirmed' => true,
                ],
            ];
        @endphp

        <div class="space-y-4">
            @foreach($payments as $p)
                {{-- Payment Notification Card --}}
                <div class="border border-gray-100 rounded-xl shadow-sm overflow-hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 divide-y md:divide-y-0 md:divide-x divide-gray-100">

                        {{-- Left: Payment Info --}}
                        <div class="p-5">
                            {{-- Header: Status + Timestamp --}}
                            <div class="flex items-center gap-2 mb-5">
                                <div class="w-8 h-8 bg-green-50 rounded-full flex items-center justify-center flex-shrink-0">
                                    {{-- Dollar / coin icon --}}
                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800 leading-tight">Pembayaran Diterima</p>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ $p['time'] }}</p>
                                </div>
                            </div>

                            {{-- Payment Fields --}}
                            <div class="space-y-4 text-sm">
                                <div>
                                    <p class="text-gray-400 text-xs mb-0.5">Metode Pembayaran</p>
                                    <p class="font-bold text-gray-800 text-xl leading-snug">{{ $p['method'] }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs mb-0.5">Dari</p>
                                    <p class="font-bold text-gray-800 text-lg leading-snug">{{ $p['from'] }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs mb-0.5">Nominal</p>
                                    <p class="font-bold text-gray-800 text-xl leading-snug">{{ $p['amount'] }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Right: Booking Detail --}}
                        <div class="p-5 flex flex-col">
                            {{-- Header: Title + Confirmed Badge --}}
                            <div class="flex items-center justify-between mb-5">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-courtee-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        {{-- Calendar / clipboard icon --}}
                                        <svg class="w-4 h-4 text-courtee-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-bold text-gray-800">Detail Pemesanan</p>
                                </div>

                                @if($p['confirmed'])
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-green-50 border border-green-200 rounded-full text-xs font-medium text-green-600 whitespace-nowrap">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Telah Dikonfirmasi
                                    </span>
                                @endif
                            </div>

                            {{-- Booking Fields --}}
                            <div class="space-y-4 text-sm flex-1">
                                <div>
                                    <p class="text-gray-400 text-xs mb-0.5">Nama Lapangan</p>
                                    <p class="font-bold text-gray-800 text-lg leading-snug">{{ $p['court'] }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs mb-1">Slot Waktu</p>
                                    <div class="space-y-1">
                                        @foreach($p['slots'] as $slot)
                                            <p class="font-semibold text-gray-800 text-sm">{{ $slot }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- Action Button --}}
                            <div class="mt-5 flex justify-end">
                                @if(!$p['confirmed'])
                                    <button
                                        class="bg-courtee-600 hover:bg-courtee-700 active:bg-courtee-800 text-white text-sm font-semibold px-6 py-2.5 rounded-lg transition-colors duration-150 shadow-sm">
                                        Konfirmasi
                                    </button>
                                @else
                                    <button
                                        disabled
                                        class="bg-gray-100 text-gray-400 text-sm font-semibold px-6 py-2.5 rounded-lg cursor-not-allowed select-none">
                                        Konfirmasi
                                    </button>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

    </div>

</x-layout.admin>
