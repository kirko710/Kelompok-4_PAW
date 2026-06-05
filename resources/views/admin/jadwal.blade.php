<x-layout.admin title="Jadwal Lapangan" activeMenu="admin.jadwal" breadcrumb="Dashboard > Jadwal Lapangan">

@php
$hourPx   = 60;
$totalHrs = 24;

$eventColors = [
    'pink'  => ['bg' => 'bg-red-100',    'border' => 'border-red-200',    'text' => 'text-red-700',    'dot' => 'bg-red-500'],
    'green' => ['bg' => 'bg-green-100',  'border' => 'border-green-200',  'text' => 'text-green-700',  'dot' => 'bg-green-500'],
    'peach' => ['bg' => 'bg-orange-50',  'border' => 'border-orange-200', 'text' => 'text-orange-700', 'dot' => 'bg-orange-400'],
];

$statusLabelMap = [
    'Pending'   => 'Menunggu',
    'Confirmed' => 'Dikonfirmasi',
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
            <h3 class="font-semibold text-gray-800 mb-3 text-sm">
                {{ $now->translatedFormat('F Y') }}
            </h3>

            {{-- Day headers --}}
            <div class="grid grid-cols-7 text-center mb-1">
                @foreach(['S','S','R','K','J','S','M'] as $d)
                    <span class="text-[10px] text-gray-400 font-medium py-0.5">{{ $d }}</span>
                @endforeach
            </div>

            {{-- Calendar days --}}
            @foreach($calendarWeeks as $week)
                <div class="grid grid-cols-7 text-center mb-0.5">
                    @foreach($week as $day)
                        @if($day === $now->day)
                            <span class="w-6 h-6 mx-auto flex items-center justify-center rounded-full bg-courtee-600 text-white text-[10px] font-bold">
                                {{ $day }}
                            </span>
                        @elseif($day === null)
                            <span class="w-6 h-6 mx-auto flex items-center justify-center text-[10px] text-gray-300"></span>
                        @else
                            <span class="w-6 h-6 mx-auto flex items-center justify-center rounded-full text-[10px] text-gray-500 hover:bg-gray-100 cursor-pointer transition">
                                {{ $day }}
                            </span>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>

        {{-- Upcoming Events --}}
        <div class="p-4 flex-1 overflow-y-auto">
            <h4 class="font-semibold text-gray-800 text-sm mb-3">Hari ini</h4>
            @if(count($events) > 0)
                <div class="space-y-2">
                    @foreach($events as $ev)
                        @php
                            $c = $eventColors[$ev[5]] ?? $eventColors['pink'];
                            $startStr = sprintf('%02d:%02d', floor($ev[1]), ($ev[1] - floor($ev[1])) * 60);
                            $endH = $ev[1] + $ev[2];
                            $endStr = sprintf('%02d:%02d', floor($endH), ($endH - floor($endH)) * 60);
                        @endphp
                        <div class="text-xs rounded-lg px-2.5 py-2 {{ $c['bg'] }} {{ $c['border'] }} border {{ $c['text'] }}">
                            <p class="font-semibold">{{ $ev[4] }}</p>
                            <p class="opacity-70">{{ $startStr }} – {{ $endStr }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center h-24">
                    <span class="text-3xl mb-2">📅</span>
                    <p class="text-xs text-gray-400">Tidak ada jadwal hari ini</p>
                </div>
            @endif
        </div>

    </div>

    {{-- ---- Right Panel: Day View ---- --}}
    <div class="flex-1 flex flex-col overflow-hidden min-w-0">

        {{-- Top Bar --}}
        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100 flex-shrink-0">
            <div class="flex items-center gap-2">
                <h3 class="text-base font-bold text-gray-800">
                    {{ $now->translatedFormat('j F Y') }}
                </h3>
                <span class="text-xs bg-courtee-100 text-courtee-700 font-semibold px-2 py-0.5 rounded-md">Hari ini</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs text-gray-400">
                    {{ count($events) }} pemesanan aktif
                </span>
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
                @if($lapangans->isEmpty())
                    <div class="flex-1 flex items-center justify-center text-gray-400 text-sm">
                        Belum ada lapangan terdaftar
                    </div>
                @else
                    @foreach($lapangans as $li => $lapangan)
                    <div class="flex-shrink-0 border-l border-gray-100" style="width: 120px">
                        {{-- Column header --}}
                        <div class="h-8 flex items-center justify-center border-b border-gray-100 px-1 bg-gray-50/60">
                            <span class="text-[10px] text-gray-500 font-medium text-center leading-tight">{{ $lapangan->nama }}</span>
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
                @endif

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
        <h3 class="font-bold text-gray-800 text-base mb-5">Detail Pemesanan Aktif</h3>
        @if($detailPemesanan)
            @php
                $statusLabel = $detailPemesanan->status_pesanan === 'confirmed' ? 'Dikonfirmasi' : 'Menunggu';
                $statusColor = $detailPemesanan->status_pesanan === 'confirmed' ? 'text-green-600' : 'text-yellow-600';
            @endphp
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-400">Nama Penyewa</span>
                    <span class="font-medium text-gray-800">{{ optional($detailPemesanan->user)->name ?? '-' }}</span>
                </div>
                <div class="border-t border-gray-50"></div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Lapangan</span>
                    <span class="font-medium text-gray-800">{{ optional($detailPemesanan->lapangan)->nama ?? '-' }}</span>
                </div>
                <div class="border-t border-gray-50"></div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Tanggal</span>
                    <span class="font-medium text-gray-800">
                        {{ \Carbon\Carbon::parse($detailPemesanan->tanggal_pesan)->translatedFormat('d F Y') }}
                    </span>
                </div>
                <div class="border-t border-gray-50"></div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Waktu</span>
                    <span class="font-medium text-gray-800">
                        {{ \Carbon\Carbon::parse($detailPemesanan->waktu_mulai)->format('H:i') }}
                        –
                        {{ \Carbon\Carbon::parse($detailPemesanan->waktu_selesai)->format('H:i') }}
                    </span>
                </div>
                <div class="border-t border-gray-50"></div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Status</span>
                    <span class="font-semibold {{ $statusColor }}">{{ $statusLabel }}</span>
                </div>
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-8 text-center">
                <svg class="w-10 h-10 text-gray-200 mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-sm text-gray-400">Tidak ada pemesanan aktif hari ini</p>
            </div>
        @endif
    </div>

    {{-- Peringatan Sistem --}}
    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm">
        <h3 class="font-bold text-gray-800 text-base mb-5">Peringatan Sistem</h3>

        @if($konflikList->isNotEmpty())
            @foreach($konflikList as $namaLap)
                <div class="flex items-start gap-3 bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-3">
                    <div class="flex-shrink-0 w-7 h-7 bg-yellow-100 border border-yellow-300 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800">Bentrok Jadwal Terdeteksi</p>
                        <p class="text-xs text-gray-500 mt-0.5">{{ $namaLap }} memiliki jadwal yang bertabrakan hari ini</p>
                    </div>
                </div>
            @endforeach
        @else
            <div class="flex items-start gap-3 bg-green-50 border border-green-200 rounded-xl p-4">
                <div class="flex-shrink-0 w-7 h-7 bg-green-100 border border-green-300 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-800">Jadwal Aman</p>
                    <p class="text-xs text-gray-500 mt-0.5">Tidak ada bentrok jadwal terdeteksi untuk hari ini</p>
                </div>
            </div>
        @endif
    </div>

</div>

</x-layout.admin>
