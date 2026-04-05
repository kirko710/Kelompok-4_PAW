<x-layout.admin title="Jadwal Lapangan" activeMenu="admin.jadwal" breadcrumb="Dashboard > Jadwal Lapangan">
    <div class="flex gap-6">
        {{-- Left: Calendar + Upcoming --}}
        <div class="w-72 flex-shrink-0 space-y-6">
            {{-- Mini Calendar --}}
            <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-sm">
                <h3 class="font-bold text-gray-800 mb-4">Desember</h3>
                <div class="grid grid-cols-7 gap-1 text-center text-xs">
                    @foreach(['m','t','w','t','f','s','s'] as $day)
                        <span class="text-gray-400 font-medium py-1">{{ $day }}</span>
                    @endforeach
                    @for($i = 1; $i <= 31; $i++)
                        <button class="py-1.5 rounded-full text-sm hover:bg-courtee-100 transition
                            {{ $i === 1 ? 'bg-courtee-600 text-white hover:bg-courtee-700' : 'text-gray-600' }}">
                            {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
                        </button>
                    @endfor
                </div>
            </div>

            {{-- Upcoming Events --}}
            <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-sm">
                <h3 class="font-bold text-gray-800 mb-3">Upcoming events</h3>
                <div class="text-center py-6">
                    <p class="text-4xl mb-2">&#127881;</p>
                    <p class="text-sm text-gray-500">No upcoming events</p>
                </div>
            </div>
        </div>

        {{-- Right: Schedule Grid --}}
        <div class="flex-1 bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800">1 Desember 2025</h2>
                <div class="flex items-center gap-3">
                    <select class="border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none">
                        <option>Day</option>
                        <option>Week</option>
                        <option>Month</option>
                    </select>
                    <button class="p-2 hover:bg-gray-100 rounded-lg"><svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></button>
                    <button class="bg-courtee-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-courtee-700 transition flex items-center gap-1">
                        Add event <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"/></svg>
                    </button>
                </div>
            </div>

            {{-- Grid --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="w-16 px-3 py-3 text-gray-400 font-normal text-xs"></th>
                            @for($i = 1; $i <= 8; $i++)
                                <th class="px-3 py-3 text-gray-600 font-medium text-xs min-w-[100px]">Lapangan {{ $i }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $schedules = [
                                '08:00' => [1 => ['type' => 'booked', 'label' => 'Dipesan', 'sub' => 'Futsal FILKOM UB', 'span' => 2], 2 => ['type' => 'pending', 'label' => 'Pending', 'span' => 2], 4 => ['type' => 'pending', 'label' => 'Pending', 'span' => 1]],
                                '09:00' => [4 => ['type' => 'pending', 'label' => 'Pending', 'span' => 1]],
                                '10:00' => [1 => ['type' => 'booked', 'label' => 'Dipesan', 'sub' => 'Futsal FILKOM UB', 'span' => 1], 4 => ['type' => 'pending', 'label' => 'Pending', 'span' => 1]],
                                '11:00' => [3 => ['type' => 'active', 'label' => 'Berlangsung', 'sub' => 'POLINEMA FC', 'span' => 1]],
                            ];
                        @endphp
                        @for($h = 0; $h <= 14; $h++)
                            @php $time = sprintf('%02d:00', $h); @endphp
                            <tr class="border-b border-gray-50">
                                <td class="px-3 py-4 text-xs text-gray-400 font-mono">{{ $time }}</td>
                                @for($c = 1; $c <= 8; $c++)
                                    @if(isset($schedules[$time][$c]))
                                        @php $s = $schedules[$time][$c]; @endphp
                                        <td class="px-1 py-1" rowspan="{{ $s['span'] ?? 1 }}">
                                            <div class="h-full rounded-lg px-3 py-2 text-xs font-medium
                                                {{ $s['type'] === 'booked' ? 'bg-green-100 text-green-700 border border-green-200' : '' }}
                                                {{ $s['type'] === 'pending' ? 'bg-red-100 text-red-700 border border-red-200' : '' }}
                                                {{ $s['type'] === 'active' ? 'bg-yellow-50 text-yellow-700 border border-yellow-200' : '' }}">
                                                <p>{{ $s['label'] }}</p>
                                                @if(isset($s['sub']))<p class="font-normal text-xs mt-0.5">{{ $s['sub'] }}</p>@endif
                                            </div>
                                        </td>
                                    @else
                                        <td class="px-1 py-1"></td>
                                    @endif
                                @endfor
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Bottom Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm">
            <h3 class="font-bold text-gray-800 text-lg mb-4">Detail Pemesanan</h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between"><span class="text-gray-500">Nama Pesanan</span><span class="font-medium">Ahmad Rizki</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Lapangan</span><span class="font-medium">Lapangan 1</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Waktu</span><span class="font-medium">08:00 - 10:00</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Status</span><span class="font-medium text-green-600">Dikonfirmasi</span></div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm">
            <h3 class="font-bold text-gray-800 text-lg mb-4">Peringatan Sistem</h3>
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 flex items-center gap-3">
                <span class="text-2xl">&#9888;</span>
                <div>
                    <p class="font-bold text-gray-800 text-sm">Bentrok Jadwal Terdeteksi</p>
                    <p class="text-xs text-gray-500 mt-1">Lapangan 4 memiliki jadwal bertabrakan pada pukul 09:00-10:00</p>
                </div>
            </div>
        </div>
    </div>
</x-layout.admin>
