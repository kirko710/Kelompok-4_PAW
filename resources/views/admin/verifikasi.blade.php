<x-layout.admin title="Verifikasi Pembayaran" activeMenu="admin.verifikasi" breadcrumb="Dashboard > Verifikasi Pembayaran">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Verifikasi Pembayaran</h2>

    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm">
        <div class="flex items-center gap-2 mb-6">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            <h3 class="font-bold text-gray-800">Notifikasi Pembayaran</h3>
        </div>

        <div class="space-y-6">
            @php
                $payments = [
                    [
                        'method' => 'QRIS', 'time' => '2 menit yang lalu', 'from' => 'Ahmad Brandon', 'amount' => 'Rp 55.100,00',
                        'court' => 'Lapangan Sejahtera', 'slots' => ['07.00-08.00 — 20 Desember 2025', '09.00-10.00 — 20 Desember 2025'],
                        'confirmed' => false
                    ],
                    [
                        'method' => 'Mobile Banking', 'time' => '2 menit yang lalu', 'from' => 'Adityawarman', 'amount' => 'Rp 48.000,00',
                        'court' => 'Lapangan Sejahtera', 'slots' => ['13.00-14.00 — 20 Desember 2025', '10.00-11.00 — 20 Desember 2025'],
                        'confirmed' => true
                    ],
                ];
            @endphp

            @foreach($payments as $p)
                <div class="border border-gray-100 rounded-xl p-6 shadow-sm">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Payment Info --}}
                        <div class="border border-gray-100 rounded-xl p-5">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800">Pembayaran Diterima</h4>
                                    <p class="text-xs text-gray-500">{{ $p['time'] }}</p>
                                </div>
                            </div>
                            <div class="space-y-3 text-sm">
                                <div>
                                    <span class="text-gray-500">Metode Pembayaran</span>
                                    <p class="font-bold text-xl text-gray-800">{{ $p['method'] }}</p>
                                </div>
                                <div>
                                    <span class="text-gray-500">Dari</span>
                                    <p class="font-bold text-lg text-gray-800">{{ $p['from'] }}</p>
                                </div>
                                <div>
                                    <span class="text-gray-500">Nominal</span>
                                    <p class="font-bold text-xl text-gray-800">{{ $p['amount'] }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Booking Details --}}
                        <div class="border border-gray-100 rounded-xl p-5">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-courtee-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-courtee-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                    </div>
                                    <h4 class="font-bold text-gray-800">Detail Pemesanan</h4>
                                </div>
                                @if($p['confirmed'])
                                    <span class="flex items-center gap-1 px-3 py-1 bg-green-50 border border-green-200 rounded-full text-xs font-medium text-green-600">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Telah Dikonfirmasi
                                    </span>
                                @endif
                            </div>
                            <div class="space-y-3 text-sm">
                                <div>
                                    <span class="text-gray-500">Nama Lapangan</span>
                                    <p class="font-bold text-lg text-gray-800">{{ $p['court'] }}</p>
                                </div>
                                <div>
                                    <span class="text-gray-500">Slot Waktu</span>
                                    @foreach($p['slots'] as $slot)
                                        <p class="font-medium text-gray-800">{{ $slot }}</p>
                                    @endforeach
                                </div>
                            </div>

                            @if(!$p['confirmed'])
                                <div class="mt-4 flex justify-end">
                                    <button class="bg-courtee-600 text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-courtee-700 transition">Konfirmasi</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout.admin>
