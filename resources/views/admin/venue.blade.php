<x-layout.admin title="Manajemen Venue" activeMenu="admin.venue" breadcrumb="Dashboard > Manajemen Venue">

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Venue</h2>
        @if(count($venues) > 0)
            <a
                href="{{ route('admin.venue.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-600 text-white rounded-lg text-sm font-semibold hover:bg-purple-700 active:scale-95 transition"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Venue
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
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            <h3 class="font-bold text-gray-800">Venue Anda</h3>
        </div>

        @if(count($venues) === 0)
            {{-- Empty State --}}
            <div class="flex items-center justify-center py-28">
                <p class="text-gray-400 text-base">
                    Anda belum memiliki venue,&nbsp;
                    <a
                        href="{{ route('admin.venue.create') }}"
                        class="text-purple-600 font-semibold hover:underline transition-colors"
                    >
                        buat venue sekarang
                    </a>
                </p>
            </div>
        @else
            {{-- Venue Cards Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($venues as $venue)
                    <div class="flex flex-col md:flex-row gap-4 border border-gray-100 rounded-xl p-4 bg-gray-50/50 hover:shadow-md transition">
                        <div class="md:w-2/5 flex-shrink-0">
                            <div class="h-40 rounded-xl overflow-hidden bg-gray-200">
                                <img
                                    src="{{ $venue['foto'] }}"
                                    alt="{{ $venue['nama'] }}"
                                    class="w-full h-full object-cover"
                                >
                            </div>
                        </div>
                        <div class="md:w-3/5 flex flex-col justify-between py-1">
                            <div>
                                <h4 class="font-bold text-gray-800 text-base mb-1">{{ $venue['nama'] }}</h4>
                                <p class="text-xs text-gray-500 mb-2 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $venue['lokasi'] }}
                                </p>
                                @if($venue['deskripsi'])
                                    <p class="text-xs text-gray-400 leading-relaxed line-clamp-3">{{ $venue['deskripsi'] }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

</x-layout.admin>
