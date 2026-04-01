<x-layout.admin title="Dashboard" activeMenu="admin.dashboard" breadcrumb="Dashboard">
    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        @php
            $stats = [
                ['label' => 'Total Pendapatan', 'value' => 'Rp 12.5M', 'change' => '+12% dari bulan lalu', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'courtee'],
                ['label' => 'Penyewaan Hari Ini', 'value' => '24', 'change' => '8 sedang berlangsung', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'color' => 'blue'],
                ['label' => 'Lapangan Aktif', 'value' => '6', 'change' => 'dari 8 lapangan', 'icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6', 'color' => 'green'],
                ['label' => 'Tingkat Okupansi', 'value' => '78%', 'change' => '+5% dari minggu lalu', 'icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6', 'color' => 'orange'],
            ];
        @endphp

        @foreach($stats as $stat)
            <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm font-medium text-gray-500">{{ $stat['label'] }}</span>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="{{ $stat['icon'] }}"/></svg>
                </div>
                <p class="text-3xl font-bold text-gray-800">{{ $stat['value'] }}</p>
                <p class="text-sm text-gray-500 mt-1">{{ $stat['change'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Chart --}}
        <div class="lg:col-span-2 bg-white rounded-xl border border-gray-100 p-6 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-bold text-gray-800">Grafik Penyewaan Mingguan</h3>
                <div class="flex gap-2">
                    <button class="px-3 py-1 text-xs rounded-lg bg-gray-100 text-gray-600 hover:bg-courtee-100 hover:text-courtee-600">Day</button>
                    <button class="px-3 py-1 text-xs rounded-lg bg-courtee-100 text-courtee-600 font-medium">Week</button>
                    <button class="px-3 py-1 text-xs rounded-lg bg-gray-100 text-gray-600 hover:bg-courtee-100 hover:text-courtee-600">Month</button>
                </div>
            </div>
            <p class="text-sm text-gray-500 mb-4">Pendapatan</p>
            {{-- Chart Placeholder --}}
            <div class="flex items-end gap-4 h-48">
                @php $heights = [60, 75, 55, 40, 30, 80, 65]; $days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat']; @endphp
                @foreach($heights as $i => $h)
                    <div class="flex-1 flex flex-col items-center gap-2">
                        <div class="w-full bg-courtee-400 rounded-t-lg transition hover:bg-courtee-600" style="height: {{ $h }}%"></div>
                        <span class="text-xs text-gray-400">{{ $days[$i] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Notifications --}}
        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm">
            <h3 class="font-bold text-gray-800 mb-4">Notifikasi Terbaru</h3>
            <div class="space-y-3">
                @php
                    $notifs = [
                        ['text' => 'Pembayaran diterima', 'time' => '2 menit yang lalu', 'color' => 'courtee'],
                        ['text' => 'Pembayaran diterima', 'time' => '35 menit yang lalu', 'color' => 'courtee'],
                        ['text' => 'Pembayaran diterima', 'time' => '57 menit yang lalu', 'color' => 'courtee'],
                        ['text' => 'Pembayaran diterima', 'time' => '1 jam yang lalu', 'color' => 'red'],
                        ['text' => 'Pembayaran diterima', 'time' => '2 jam yang lalu', 'color' => 'red'],
                    ];
                @endphp
                @foreach($notifs as $n)
                    <div class="bg-courtee-50 rounded-lg p-4 border-l-4 {{ $n['color'] === 'red' ? 'border-red-400' : 'border-courtee-400' }}">
                        <p class="text-sm font-medium text-gray-800">{{ $n['text'] }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $n['time'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout.admin>
