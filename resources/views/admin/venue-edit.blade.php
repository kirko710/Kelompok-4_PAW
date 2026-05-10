<x-layout.admin title="Edit Venue" activeMenu="admin.venue" breadcrumb="Dashboard > Manajemen Venue > Edit">

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Venue</h2>
        <a href="{{ route('admin.venue') }}" class="text-sm text-gray-500 hover:text-purple-600 transition flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
    </div>

    @if($errors->any())
        <div class="mb-4 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-xl border border-gray-100 p-8 shadow-sm">

        <div class="flex items-center gap-2 mb-6">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            <h3 class="font-bold text-gray-800">Edit Detail Venue</h3>
        </div>

        <form method="POST" action="{{ route('admin.venue.update', $venue->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-col md:flex-row gap-8 border border-gray-100 rounded-xl p-6 bg-gray-50/50">

                {{-- Foto Venue --}}
                <div class="md:w-2/5 flex-shrink-0">
                    <div class="h-64 rounded-xl overflow-hidden bg-gray-200 relative">
                        @if($venue->foto)
                            <img
                                id="foto-preview"
                                src="{{ Storage::url($venue->foto) }}"
                                alt="{{ $venue->nama }}"
                                class="w-full h-full object-cover"
                            >
                        @else
                            <img
                                id="foto-preview"
                                src="https://images.unsplash.com/photo-1575361204480-aadea25e6e68?w=800&q=80"
                                alt="Foto Venue"
                                class="w-full h-full object-cover"
                            >
                        @endif
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 hover:opacity-100 transition cursor-pointer" onclick="document.getElementById('foto-input').click()">
                            <span class="text-white text-sm font-medium">Klik untuk ganti foto</span>
                        </div>
                    </div>
                    <input
                        type="file"
                        id="foto-input"
                        name="foto"
                        accept="image/*"
                        class="hidden"
                        onchange="previewFoto(this)"
                    >
                    <button
                        type="button"
                        onclick="document.getElementById('foto-input').click()"
                        class="w-full mt-3 bg-white border border-gray-200 text-gray-600 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-100 transition flex items-center justify-center gap-2 shadow-sm"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Ganti Foto
                    </button>
                    <p class="text-xs text-gray-400 text-center mt-1">Kosongkan jika tidak ingin mengganti foto</p>
                </div>

                {{-- Form Fields --}}
                <div class="md:w-3/5 space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-700">Nama Venue <span class="text-red-500">*</span></label>
                        <input
                            type="text"
                            name="nama"
                            value="{{ old('nama', $venue->nama) }}"
                            placeholder="Contoh: Longfield Sport Centre"
                            class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition @error('nama') border-red-400 @enderror"
                        >
                        @error('nama')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Lokasi <span class="text-red-500">*</span></label>
                        <input
                            type="text"
                            name="lokasi"
                            value="{{ old('lokasi', $venue->lokasi) }}"
                            placeholder="Contoh: Jl. Ahmad Yani, No 77, Senayan, Jakarta Pusat"
                            class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition @error('lokasi') border-red-400 @enderror"
                        >
                        @error('lokasi')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Deskripsi Venue</label>
                        <textarea
                            name="deskripsi"
                            rows="4"
                            placeholder="Tulis deskripsi singkat tentang venue Anda"
                            class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition resize-none"
                        >{{ old('deskripsi', $venue->deskripsi) }}</textarea>
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
                            Simpan Perubahan
                        </button>
                    </div>
                </div>

            </div>
        </form>

    </div>

@push('scripts')
<script>
function previewFoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('foto-preview').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush

</x-layout.admin>
