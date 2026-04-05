<x-layout.admin title="Jadwal Lapangan" activeMenu="admin.jadwal" breadcrumb="Dashboard > Jadwal Lapangan">

@php
$lapanganList = ['Lapangan 1','Lapangan 2','Lapangan 3','Lapangan 4','Lapangan 5','Lapangan 6','Lapangan 7','Lapangan 8'];

// Events: [lapangan_idx(0-based), start_hour(float), duration_hours(float), title, subtitle, color]
$events = [
    [0, 8.0, 2.5, 'Dipesan',     'Futsal FILKOM UB', 'pink'],
    [1, 7.5, 2.0, '',             'Terbooking',       'green'],
    [3, 9.0, 1.0, 'Dipesan',     'Terbooking',       'pink'],
    [3, 10.0, 1.0, 'Dipesan',    'Terbooking',       'pink'],
    [3, 11.0, 1.5, 'Berlangsung','POLINEMA FC',       'peach'],
];

$hourPx   = 60;  // px per hour
$totalHrs = 24;

// December 2025 — starts on Monday (index 0)
$decWeeks = [
    [1,  2,  3,  4,  5,  6,  7],
    [8,  9,  10, 11, 12, 13, 14],
    [15, 16, 17, 18, 19, 20, 21],
    [22, 23, 24, 25, 26, 27, 28],
    [29, 30, 31, null, null, null, null],
];

$eventColors = [
    'pink'  => ['bg' => 'bg-red-100',    'border' => 'border-red-200',    'text' => 'text-red-700',    'dot' => 'bg-red-500'],
    'green' => ['bg' => 'bg-green-100',  'border' => 'border-green-200',  'text' => 'text-green-700',  'dot' => 'bg-green-500'],
    'peach' => ['bg' => 'bg-orange-50',  'border' => 'border-orange-200', 'text' => 'text-orange-700', 'dot' => 'bg-orange-400'],
];
@endphp

<h2 class="text-2xl font-bold text-gray-800 mb-6">Jadwal Lapangan</h2>

{{-- ============================================================ --}}
{{-- Main Calendar Card                                           --}}
{{-- ============================================================ --}}
<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden mb-6 flex" style="height: 570px">

    {{-- ---- Left Panel: Mini Calendar + Upcoming Events ---- --}}
    <div class="w-52 flex-shrink-0 border-r border-gray-100 flex flex-col overflow-hidden">

        {{-- Mini Calendar --}}
        <div class="p-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-800 mb-3 text-sm">Desember</h3>

            {{-- Day headers --}}
            <div class="grid grid-cols-7 text-center mb-1">
                @foreach(['m','t','w','t','f','s','s'] as $d)
                    <span class="text-[10px] text-gray-400 font-medium py-0.5">{{ $d }}</span>
                @endforeach
            </div>

            {{-- Calendar days --}}
            @foreach($decWeeks as $week)
                <div class="grid grid-cols-7 text-center mb-0.5">
                    @foreach($week as $day)
                        @if($day === 1)
                            <span class="w-6 h-6 mx-auto flex items-center justify-center rounded-full bg-blue-500 text-white text-[10px] font-bold">01</span>
                        @elseif($day === null)
                            <span class="w-6 h-6 mx-auto flex items-center justify-center text-[10px] text-gray-300"></span>
                        @else
                            <span class="w-6 h-6 mx-auto flex items-center justify-center rounded-full text-[10px] text-gray-500 hover:bg-gray-100 cursor-pointer transition">{{ sprintf('%02d', $day) }}</span>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>

        {{-- Upcoming Events --}}
        <div class="p-4 flex-1">
            <h4 class="font-semibold text-gray-800 text-sm mb-3">Upcoming events</h4>
            <div class="flex flex-col items-center justify-center h-32">
                <span class="text-4xl mb-2">🎉</span>
                <p class="text-xs text-gray-400">No upcoming events</p>
            </div>
        </div>

    </div>

    {{-- ---- Right Panel: Day View ---- --}}
    <div class="flex-1 flex flex-col overflow-hidden min-w-0">

        {{-- Top Bar --}}
        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100 flex-shrink-0">
            <div class="flex items-center gap-2">
                {{-- Hamburger --}}
                <button class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <h3 class="text-base font-bold text-gray-800">1 Desember 2025</h3>
                {{-- Day toggle --}}
                <div class="relative">
                    <select class="appearance-none border border-blue-300 text-blue-600 text-xs rounded-md pl-2 pr-6 py-1 outline-none focus:ring-1 focus:ring-blue-300 bg-white font-medium">
                        <option>Day</option>
                        <option>Week</option>
                        <option>Month</option>
                    </select>
                    <svg class="absolute right-1.5 top-1/2 -translate-y-1/2 w-3 h-3 text-blue-500 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button class="p-1.5 rounded-lg hover:bg-gray-100 transition">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M21 21l-5.2-5.2M17 11A6 6 0 115 11a6 6 0 0112 0z"/>
                    </svg>
                </button>
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium px-3 py-1.5 rounded-lg flex items-center gap-1 transition active:scale-95">
                    Add event
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M12 5v14M5 12h14"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Scrollable schedule --}}
        <div class="flex-1 overflow-auto">
            <div class="flex" style="min-width: max-content">

                {{-- Time label column --}}
                <div class="flex-shrink-0 w-14">
                    {{-- Column header spacer --}}
                    <div class="h-8 border-b border-gray-100"></div>
                    {{-- Hour labels --}}
                    @for ($h = 0; $h < $totalHrs; $h++)
                        <div class="flex items-start justify-end pr-2" style="height: {{ $hourPx }}px">
                            <span class="text-[10px] text-gray-400 font-mono -mt-2">{{ sprintf('%02d:00', $h) }}</span>
                        </div>
                    @endfor
                </div>

                {{-- Lapangan columns --}}
                @foreach($lapanganList as $li => $lapangan)
                <div class="flex-shrink-0 border-l border-gray-100" style="width: 110px">
                    {{-- Column header --}}
                    <div class="h-8 flex items-center justify-center border-b border-gray-100 px-1">
                        <span class="text-[10px] text-gray-500 font-medium">{{ $lapangan }}</span>
                    </div>
                    {{-- Column body --}}
                    <div class="relative" style="height: {{ $totalHrs * $hourPx }}px">

                        {{-- Hour grid lines --}}
                        @for ($h = 0; $h < $totalHrs; $h++)
                            <div class="absolute w-full border-t border-gray-100" style="top: {{ $h * $hourPx }}px"></div>
                            {{-- 30-min sub-line --}}
                            <div class="absolute w-full border-t border-gray-50" style="top: {{ $h * $hourPx + $hourPx / 2 }}px"></div>
                        @endfor

                        {{-- Events for this column --}}
                        @foreach($events as $ev)
                            @if($ev[0] === $li)
                            @php
                                $top    = $ev[1] * $hourPx;
                                $height = $ev[2] * $hourPx;
                                $c      = $eventColors[$ev[5]] ?? $eventColors['pink'];
                            @endphp
                            <div class="absolute px-1 py-0.5" style="top: {{ $top }}px; height: {{ $height }}px; left: 2px; right: 2px;">
                                <div class="w-full h-full rounded-md border {{ $c['bg'] }} {{ $c['border'] }} px-1.5 py-1 overflow-hidden flex flex-col gap-0.5">
                                    {{-- User icon dot --}}
                                    <div class="flex items-center gap-1">
                                        <span class="w-3 h-3 rounded-full {{ $c['dot'] }} flex-shrink-0 opacity-70"></span>
                                        @if($ev[3])
                                            <span class="text-[10px] font-semibold {{ $c['text'] }} leading-tight truncate">{{ $ev[3] }}</span>
                                        @endif
                                    </div>
                                    @if($ev[4])
                                        <span class="text-[10px] {{ $c['text'] }} opacity-80 leading-tight truncate">{{ $ev[4] }}</span>
                                    @endif
                                </div>
                            </div>
                            @endif
                        @endforeach

                    </div>
                </div>
                @endforeach

            </div>
        </div>

    </div>
</div>

{{-- ============================================================ --}}
{{-- Bottom Section: Detail Pemesanan + Peringatan Sistem         --}}
{{-- ============================================================ --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Detail Pemesanan --}}
    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm">
        <h3 class="font-bold text-gray-800 text-base mb-5">Detail Pemesanan</h3>
        <div class="space-y-3 text-sm">
            <div class="flex justify-between">
                <span class="text-gray-400">Nama Pesanan</span>
                <span class="font-medium text-gray-800">Ahmad Rizki</span>
            </div>
            <div class="border-t border-gray-50"></div>
            <div class="flex justify-between">
                <span class="text-gray-400">Lapangan</span>
                <span class="font-medium text-gray-800">Lapangan 1</span>
            </div>
            <div class="border-t border-gray-50"></div>
            <div class="flex justify-between">
                <span class="text-gray-400">Tanggal</span>
                <span class="font-medium text-gray-800">1 Desember 2025</span>
            </div>
            <div class="border-t border-gray-50"></div>
            <div class="flex justify-between">
                <span class="text-gray-400">Waktu</span>
                <span class="font-medium text-gray-800">08:00 – 10:00</span>
            </div>
            <div class="border-t border-gray-50"></div>
            <div class="flex justify-between">
                <span class="text-gray-400">Jenis Olahraga</span>
                <span class="font-medium text-gray-800">Futsal</span>
            </div>
            <div class="border-t border-gray-50"></div>
            <div class="flex justify-between">
                <span class="text-gray-400">Status</span>
                <span class="font-semibold text-green-600">Dikonfirmasi</span>
            </div>
        </div>
    </div>

    {{-- Peringatan Sistem --}}
    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm">
        <h3 class="font-bold text-gray-800 text-base mb-5">Peringatan Sistem</h3>

        {{-- Active warning --}}
        <div class="flex items-start gap-3 bg-yellow-50 border border-yellow-200 rounded-xl p-4">
            <div class="flex-shrink-0 w-7 h-7 bg-yellow-100 border border-yellow-300 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-800">Bentrok Jadwal Terdeteksi</p>
                <p class="text-xs text-gray-500 mt-0.5">Lapangan 4 memiliki jadwal bertabrakan pada pukul 09:00 – 11:00</p>
            </div>
        </div>

    </div>

</div>

</x-layout.admin>
