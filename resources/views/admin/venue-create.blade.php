<x-layout.admin title="Buat Venue Baru" activeMenu="admin.venue" breadcrumb="Dashboard > Manajemen Lapangan dan Venue">

    <h2 class="text-2xl font-bold text-gray-800 mb-6">Manajemen Venue</h2>

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

        {{-- Form Card --}}
        <form method="POST" action="{{ route('admin.venue.store') }}">
            @csrf
            <div class="flex flex-col md:flex-row gap-8 border border-gray-100 rounded-xl p-6 bg-gray-50/50">

                {{-- Foto Venue --}}
                <div class="md:w-2/5 flex-shrink-0">
                    <div class="h-64 rounded-xl overflow-hidden bg-gray-200">
                        <img
                            src="https://images.unsplash.com/photo-1575361204480-aadea25e6e68?w=800&q=80"
                            alt="Foto Venue"
                            class="w-full h-full object-cover"
                        >
                    </div>
                    <button
                        type="button"
                        class="w-full mt-3 bg-white border border-gray-200 text-gray-600 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-100 transition flex items-center justify-center gap-2 shadow-sm"
                    >
                        Ganti Foto
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>

                {{-- Form Fields --}}
                <div class="md:w-3/5 space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-700">Nama Venue</label>
                        <input
                            type="text"
                            name="nama"
                            value="{{ old('nama') }}"
                            placeholder="Contoh: Longfield Sport Centre"
                            class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition @error('nama') border-red-400 @enderror"
                        >
                        @error('nama')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Deskripsi Venue</label>
                        <textarea
                            name="deskripsi"
                            rows="3"
                            placeholder="Tulis deskripsi singkat tentang venue Anda"
                            class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition resize-none"
                        >{{ old('deskripsi') }}</textarea>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Lokasi</label>
                        <input
                            type="text"
                            name="lokasi"
                            value="{{ old('lokasi') }}"
                            placeholder="Contoh: Jl. Ahmad Yani, No 77, Senayan, Jakarta Pusat"
                            class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition @error('lokasi') border-red-400 @enderror"
                        >
                        @error('lokasi')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3 pt-4">
                        <a
                            href="{{ route('admin.venue') }}"
                            class="px-6 py-2.5 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100 transition"
                        >
                            Batal
                        </a>
                        <button
                            type="submit"
                            class="px-8 py-2.5 bg-purple-600 text-white rounded-lg text-sm font-semibold hover:bg-purple-700 active:scale-95 transition"
                        >
                            Buat
                        </button>
                    </div>
                </div>

            </div>
        </form>

    </div>

</x-layout.admin>
