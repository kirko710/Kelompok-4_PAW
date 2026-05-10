<x-layout.admin title="Manajemen Lapangan" activeMenu="admin.lapangan" breadcrumb="Dashboard > Manajemen Lapangan">

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Lapangan</h2>
        @if($hasVenue)
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

    @if(session('error'))
        <div class="mb-4 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm font-medium">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-xl border border-gray-100 p-8 shadow-sm">

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
                    <a href="{{ route('admin.venue.create') }}" class="text-purple-600 font-semibold hover:underline transition-colors">
                        Buat venue terlebih dahulu
                    </a>
                </p>
            </div>
        @elseif($lapangans->isEmpty())
            {{-- Has venue but no lapangan --}}
            <div class="flex items-center justify-center py-28">
                <p class="text-gray-400 text-base">
                    Anda belum memiliki lapangan,&nbsp;
                    <a href="{{ route('admin.lapangan.create') }}" class="text-purple-600 font-semibold hover:underline transition-colors">
                        buat lapangan sekarang
                    </a>
                </p>
            </div>
        @else
            {{-- Lapangan Cards Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($lapangans as $lap)
                    <div class="flex flex-col md:flex-row gap-4 border border-gray-100 rounded-xl p-4 bg-gray-50/50 hover:shadow-md transition">
                        <div class="md:w-2/5 flex-shrink-0">
                            <div class="h-40 rounded-xl overflow-hidden bg-gray-200">
                                @if($lap->foto)
                                    <img
                                        src="{{ Storage::url($lap->foto) }}"
                                        alt="{{ $lap->nama }}"
                                        class="w-full h-full object-cover"
                                    >
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-purple-50">
                                        <svg class="w-12 h-12 text-purple-200" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M9 21V10m6 11V10M3 10l9-7 9 7"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="md:w-3/5 flex flex-col justify-between py-1">
                            <div>
                                <h4 class="font-bold text-gray-800 text-base mb-1">{{ $lap->nama }}</h4>
                                <span class="inline-block px-2 py-0.5 bg-purple-100 text-purple-700 rounded text-xs font-medium mb-2">{{ $lap->jenis_olahraga }}</span>
                                <p class="text-xs text-gray-500 mb-1 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    {{ $lap->venue->nama ?? '-' }}
                                </p>
                                <p class="text-sm font-semibold text-gray-700">Rp {{ number_format($lap->harga_sewa, 0, ',', '.') }}/jam</p>
                                @if($lap->jam_buka && $lap->jam_tutup)
                                    <p class="text-xs text-gray-400 mt-1">
                                        🕐 {{ substr($lap->jam_buka, 0, 5) }} – {{ substr($lap->jam_tutup, 0, 5) }}
                                    </p>
                                @else
                                    <p class="text-xs text-amber-500 mt-1">⚠️ Jam operasional belum diset</p>
                                @endif
                            </div>
                            {{-- Action Buttons --}}
                            <div class="flex items-center gap-2 mt-3">
                                <a
                                    href="{{ route('admin.lapangan.edit', $lap->id) }}"
                                    class="flex-1 text-center px-3 py-1.5 bg-amber-50 text-amber-700 rounded-lg text-xs font-medium hover:bg-amber-100 transition"
                                >
                                    Edit
                                </a>
                                <form action="{{ route('admin.lapangan.destroy', $lap->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus lapangan {{ $lap->nama }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="px-3 py-1.5 bg-red-50 text-red-600 rounded-lg text-xs font-medium hover:bg-red-100 transition"
                                    >
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

</x-layout.admin>
