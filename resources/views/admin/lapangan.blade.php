<x-layout.admin title="Manajemen Lapangan" activeMenu="admin.lapangan" breadcrumb="Dashboard > Manajemen Lapangan">

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Lapangan</h2>
        @if($hasVenue && count($lapangan) > 0)
            <a
                href="{{ route('admin.lapangan.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-600 text-white rounded-lg text-sm font-semibold hover:bg-purple-700 active:scale-95 transition"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Lapangan
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl border border-gray-100 p-8 shadow-sm">

        {{-- Header --}}
        <div class="flex items-center gap-2 mb-6">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M9 21V10m6 11V10M3 10l9-7 9 7"/>
            </svg>
            <h3 class="font-bold text-gray-800">Lapangan Anda</h3>
        </div>

        @if(!$hasVenue)
            {{-- No venue yet --}}
            <div class="flex items-center justify-center py-28">
                <p class="text-gray-400 text-base text-center">
                    Anda belum memiliki venue.&nbsp;
                    <a
                        href="{{ route('admin.venue.create') }}"
                        class="text-purple-600 font-semibold hover:underline transition-colors"
                    >
                        Buat venue terlebih dahulu
                    </a>
                </p>
            </div>
        @elseif(count($lapangan) === 0)
            {{-- Has venue but no lapangan --}}
            <div class="flex items-center justify-center py-28">
                <p class="text-gray-400 text-base">
                    Anda belum memiliki lapangan,&nbsp;
                    <a
                        href="{{ route('admin.lapangan.create') }}"
                        class="text-purple-600 font-semibold hover:underline transition-colors"
                    >
                        buat lapangan sekarang
                    </a>
                </p>
            </div>
        @else
            {{-- Build venue lookup map --}}
            @php
                $venueMap = [];
                foreach($venues as $v) {
                    $venueMap[$v['id']] = $v['nama'];
                }
            @endphp

            {{-- Lapangan Cards Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($lapangan as $lap)
                    <div class="flex flex-col md:flex-row gap-4 border border-gray-100 rounded-xl p-4 bg-gray-50/50 hover:shadow-md transition">
                        <div class="md:w-2/5 flex-shrink-0">
                            <div class="h-40 rounded-xl overflow-hidden bg-gray-200">
                                <img
                                    src="{{ $lap['foto'] }}"
                                    alt="{{ $lap['nama'] }}"
                                    class="w-full h-full object-cover"
                                >
                            </div>
                        </div>
                        <div class="md:w-3/5 flex flex-col justify-between py-1">
                            <div>
                                <h4 class="font-bold text-gray-800 text-base mb-1">{{ $lap['nama'] }}</h4>
                                <p class="text-xs text-purple-600 font-medium mb-1">{{ $lap['jenis_olahraga'] }}</p>
                                <p class="text-xs text-gray-500 mb-1">
                                    {{ $venueMap[$lap['venue_id']] ?? 'Venue tidak ditemukan' }}
                                </p>
                                <p class="text-xs font-semibold text-gray-700">{{ $lap['harga'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

</x-layout.admin>
