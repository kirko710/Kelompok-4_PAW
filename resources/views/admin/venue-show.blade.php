<x-layout.admin title="Detail Venue" activeMenu="admin.venue" breadcrumb="Dashboard > Manajemen Venue > Detail">

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">{{ $venue->nama }}</h2>
        <div class="flex items-center gap-3">
            <a
                href="{{ route('admin.lapangan.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-600 text-white rounded-lg text-sm font-semibold hover:bg-purple-700 active:scale-95 transition"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Lapangan
            </a>
            <a href="{{ route('admin.venue') }}" class="text-sm text-gray-500 hover:text-purple-600 transition flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    {{-- Venue Detail Card --}}
    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm mb-6">
        <div class="flex flex-col md:flex-row gap-6">
            <div class="md:w-1/3">
                <div class="h-48 rounded-xl overflow-hidden bg-gray-200">
                    @if($venue->foto)
                        <img src="{{ $venue->foto_url }}" alt="{{ $venue->nama }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-purple-50">
                            <svg class="w-16 h-16 text-purple-200" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>
            <div class="md:w-2/3 flex flex-col justify-between">
                <div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $venue->nama }}</h3>
                    <p class="text-sm text-gray-500 flex items-center gap-1 mb-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $venue->lokasi }}
                    </p>
                    @if($venue->deskripsi)
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $venue->deskripsi }}</p>
                    @else
                        <p class="text-sm text-gray-400 italic">Belum ada deskripsi.</p>
                    @endif
                </div>
                <div class="flex items-center gap-3 mt-4">
                    <a
                        href="{{ route('admin.venue.edit', $venue->id) }}"
                        class="px-5 py-2 bg-amber-50 text-amber-700 border border-amber-200 rounded-lg text-sm font-medium hover:bg-amber-100 transition"
                    >
                        Edit Venue
                    </a>
                    <form action="{{ route('admin.venue.destroy', $venue->id) }}" method="POST"
                        onsubmit="return confirm('Hapus venue ini? Semua lapangan di dalamnya juga akan dihapus.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-5 py-2 bg-red-50 text-red-600 border border-red-200 rounded-lg text-sm font-medium hover:bg-red-100 transition">
                            Hapus Venue
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Daftar Lapangan --}}
    <div class="bg-white rounded-xl border border-gray-100 p-8 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M9 21V10m6 11V10M3 10l9-7 9 7"/>
                </svg>
                <h3 class="font-bold text-gray-800">Lapangan di Venue Ini</h3>
                <span class="ml-2 px-2 py-0.5 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">{{ $venue->lapangans->count() }}</span>
            </div>
        </div>

        @if($venue->lapangans->isEmpty())
            <div class="flex items-center justify-center py-20">
                <p class="text-gray-400 text-base">
                    Belum ada lapangan di venue ini,&nbsp;
                    <a href="{{ route('admin.lapangan.create') }}" class="text-purple-600 font-semibold hover:underline">
                        tambah sekarang
                    </a>
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($venue->lapangans as $lapangan)
                    <div class="border border-gray-100 rounded-xl overflow-hidden bg-gray-50/50 hover:shadow-md transition">
                        <div class="h-36 bg-gray-200">
                            @if($lapangan->foto)
                                <img src="{{ Storage::url($lapangan->foto) }}" alt="{{ $lapangan->nama }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-purple-50">
                                    <svg class="w-10 h-10 text-purple-200" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M9 21V10m6 11V10M3 10l9-7 9 7"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-gray-800 text-sm mb-1">{{ $lapangan->nama }}</h4>
                            <span class="inline-block px-2 py-0.5 bg-purple-100 text-purple-700 rounded text-xs font-medium mb-2">{{ $lapangan->jenis_olahraga }}</span>
                            <p class="text-sm font-semibold text-gray-700">Rp {{ number_format($lapangan->harga_sewa, 0, ',', '.') }}/jam</p>
                            <div class="flex gap-2 mt-3">
                                <a href="{{ route('admin.lapangan.edit', $lapangan->id) }}"
                                   class="flex-1 text-center py-1.5 bg-amber-50 text-amber-700 rounded-lg text-xs font-medium hover:bg-amber-100 transition">
                                    Edit
                                </a>
                                <form action="{{ route('admin.lapangan.destroy', $lapangan->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus lapangan {{ $lapangan->nama }}?')" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full py-1.5 bg-red-50 text-red-600 rounded-lg text-xs font-medium hover:bg-red-100 transition">
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
