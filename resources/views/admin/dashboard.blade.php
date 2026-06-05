<x-layout.admin title="Dashboard" activeMenu="admin.dashboard" breadcrumb="Dashboard">

    {{-- ===================== STAT CARDS ===================== --}}
    @php
        // Format total pendapatan → tampilkan sebagai "Rp X.XJt" atau "Rp X.XRb"
        if ($totalPendapatan >= 1_000_000) {
            $pendapatanFormatted = 'Rp ' . number_format($totalPendapatan / 1_000_000, 1) . 'Jt';
        } elseif ($totalPendapatan >= 1_000) {
            $pendapatanFormatted = 'Rp ' . number_format($totalPendapatan / 1_000, 0) . 'Rb';
        } else {
            $pendapatanFormatted = 'Rp ' . number_format($totalPendapatan, 0, ',', '.');
        }

        $stats = [
            [
                'label'  => 'Total Pendapatan',
                'value'  => $pendapatanFormatted,
                'sub'    => 'dari semua pembayaran lunas',
                'icon'   => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                'color'  => 'courtee',
            ],
            [
                'label'  => 'Penyewaan Hari Ini',
                'value'  => (string) $pemesananHariIni,
                'sub'    => $sedangBerlangsung . ' sedang berlangsung',
                'icon'   => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                'color'  => 'blue',
            ],
            [
                'label'  => 'Total Lapangan',
                'value'  => (string) $totalLapangan,
                'sub'    => 'lapangan terdaftar',
                'icon'   => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6',
                'color'  => 'green',
            ],
            [
                'label'  => 'Menunggu Konfirmasi',
                'value'  => (string) $pemesananPending,
                'sub'    => 'pesanan perlu diproses',
                'icon'   => 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                'color'  => 'orange',
            ],
        ];

        $statColorMap = [
            'courtee' => ['icon' => 'text-courtee-500', 'ring' => 'bg-courtee-50'],
            'blue'    => ['icon' => 'text-blue-500',    'ring' => 'bg-blue-50'],
            'green'   => ['icon' => 'text-green-500',   'ring' => 'bg-green-50'],
            'orange'  => ['icon' => 'text-orange-500',  'ring' => 'bg-orange-50'],
        ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-7">
        @foreach($stats as $stat)
            @php $sc = $statColorMap[$stat['color']]; @endphp
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-600">{{ $stat['label'] }}</span>
                    <div class="w-9 h-9 rounded-lg {{ $sc['ring'] }} flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 {{ $sc['icon'] }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}" />
                        </svg>
                    </div>
                </div>
                <p class="text-4xl font-bold text-gray-800 leading-none">{{ $stat['value'] }}</p>
                <p class="text-sm text-gray-500">{{ $stat['sub'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- ===================== CHART + NOTIF ROW ===================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-7">

        {{-- Bar Chart Card --}}
        <div class="lg:col-span-2 bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h3 class="font-bold text-gray-800 text-base">Grafik Pendapatan 7 Hari Terakhir</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Berdasarkan pembayaran yang telah lunas</p>
                </div>
                <span class="px-3 py-1 text-xs rounded-md bg-courtee-100 text-courtee-700 font-semibold">7 Hari</span>
            </div>

            <div class="flex gap-4 mt-4">
                {{-- Y-Axis Labels --}}
                <div class="flex flex-col justify-between items-end pb-6 text-xs text-gray-400 select-none" style="min-width: 52px;">
                    @foreach($yLabels as $y)
                        <span>{{ $y }}</span>
                    @endforeach
                </div>

                {{-- Bars + X Axis --}}
                <div class="flex-1 flex flex-col gap-1">
                    <div class="flex items-end gap-2 h-48">
                        @foreach($chartData as $bar)
                            <div class="flex-1 flex flex-col items-center gap-2 h-full justify-end group relative">
                                {{-- Tooltip --}}
                                <div class="absolute bottom-full mb-1 left-1/2 -translate-x-1/2 bg-gray-800 text-white text-xs rounded px-2 py-1 opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-10">
                                    Rp {{ number_format($bar['total'], 0, ',', '.') }}
                                </div>
                                <div
                                    class="w-full rounded-t-md bg-courtee-400 hover:bg-courtee-600 transition-colors duration-150 cursor-pointer"
                                    style="height: {{ $bar['pct'] }}%">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- X-Axis Day Labels --}}
                    <div class="flex gap-2 pt-1">
                        @foreach($chartData as $bar)
                            <div class="flex-1 text-center text-xs text-gray-400">{{ $bar['day'] }}</div>
                        @endforeach
                    </div>
                    <p class="text-center text-xs font-medium text-gray-500 mt-1">Hari</p>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-2 text-center">Jumlah Pendapatan (Rp)</p>
        </div>

        {{-- Notifications Card --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 flex flex-col">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-800 text-base">Menunggu Verifikasi</h3>
                @if($notifPembayaran->count() > 0)
                    <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-0.5 rounded-full">
                        {{ $notifPembayaran->count() }}
                    </span>
                @endif
            </div>

            <div class="space-y-2 flex-1">
                @forelse($notifPembayaran as $notif)
                    @php
                        $namaUser    = optional(optional($notif->pemesanan)->user)->name ?? 'Penyewa';
                        $namaLapangan= optional(optional($notif->pemesanan)->lapangan)->nama ?? 'Lapangan';
                        $waktuDiff   = $notif->created_at->diffForHumans();
                    @endphp
                    <a href="{{ route('admin.verifikasi') }}"
                       class="flex items-center gap-3 bg-courtee-600 hover:bg-courtee-700 transition-colors rounded-lg px-4 py-3 cursor-pointer group">
                        <div class="w-2 h-2 rounded-full bg-white flex-shrink-0"></div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-white truncate">{{ $namaUser }}</p>
                            <p class="text-xs text-white/70 mt-0.5 truncate">{{ $namaLapangan }} · {{ $waktuDiff }}</p>
                        </div>
                        <svg class="w-4 h-4 text-white/50 group-hover:text-white flex-shrink-0 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @empty
                    <div class="flex-1 flex flex-col items-center justify-center py-8 text-center">
                        <svg class="w-10 h-10 text-gray-200 mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-gray-400 font-medium">Semua pembayaran terverifikasi</p>
                        <p class="text-xs text-gray-300 mt-1">Tidak ada yang pending</p>
                    </div>
                @endforelse
            </div>

            @if($notifPembayaran->count() > 0)
                <a href="{{ route('admin.verifikasi') }}"
                   class="mt-4 text-center text-xs text-courtee-600 hover:text-courtee-800 font-medium transition">
                    Lihat semua →
                </a>
            @endif
        </div>
    </div>

    {{-- ===================== QUICK ACTIONS ===================== --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
        <h3 class="font-bold text-gray-800 text-base mb-5">Quick Actions</h3>

        @php
            $actions = [
                [
                    'label'  => 'Tambah Lapangan',
                    'desc'   => 'Daftarkan lapangan baru',
                    'icon'   => 'M12 4v16m8-8H4',
                    'color'  => 'courtee',
                    'route'  => 'admin.lapangan.create',
                ],
                [
                    'label'  => 'Verifikasi Pembayaran',
                    'desc'   => 'Cek pembayaran masuk',
                    'icon'   => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                    'color'  => 'green',
                    'route'  => 'admin.verifikasi',
                ],
                [
                    'label'  => 'Lihat Pemesanan',
                    'desc'   => 'Pantau semua pemesanan',
                    'icon'   => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
                    'color'  => 'blue',
                    'route'  => 'admin.pemesanan',
                ],
                [
                    'label'  => 'Laporan & Analitik',
                    'desc'   => 'Lihat ringkasan data',
                    'icon'   => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                    'color'  => 'orange',
                    'route'  => 'admin.laporan',
                ],
            ];

            $colorMap = [
                'courtee' => ['bg' => 'bg-courtee-100', 'icon' => 'text-courtee-600', 'hover' => 'hover:bg-courtee-50 hover:border-courtee-200'],
                'green'   => ['bg' => 'bg-green-100',   'icon' => 'text-green-600',   'hover' => 'hover:bg-green-50 hover:border-green-200'],
                'blue'    => ['bg' => 'bg-blue-100',    'icon' => 'text-blue-600',    'hover' => 'hover:bg-blue-50 hover:border-blue-200'],
                'orange'  => ['bg' => 'bg-orange-100',  'icon' => 'text-orange-600',  'hover' => 'hover:bg-orange-50 hover:border-orange-200'],
            ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
            @foreach($actions as $action)
                @php $c = $colorMap[$action['color']]; @endphp
                <a href="{{ route($action['route']) }}"
                   class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 {{ $c['hover'] }} transition-all duration-150 text-left group w-full">
                    <div class="w-11 h-11 rounded-xl {{ $c['bg'] }} flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 {{ $c['icon'] }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $action['icon'] }}" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800 group-hover:text-gray-900">{{ $action['label'] }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $action['desc'] }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

</x-layout.admin>
