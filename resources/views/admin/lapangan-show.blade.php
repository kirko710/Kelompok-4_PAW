<x-layout.admin title="Manajemen Lapangan" activeMenu="admin.lapangan" breadcrumb="Dashboard > Manajemen Lapangan dan Venue">

    <div
        x-data="{
            lapangan: null,
            init() {
                try {
                    const saved = localStorage.getItem('lapangan_data');
                    this.lapangan = saved ? JSON.parse(saved) : null;
                } catch(e) { this.lapangan = null; }
            }
        }"
        x-init="init()"
    >
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Manajemen Lapangan</h2>

        <div class="bg-white rounded-xl border border-gray-100 p-8 shadow-sm">

            {{-- Header --}}
            <div class="flex items-center gap-2 mb-6">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M9 21V10m6 11V10M3 10l9-7 9 7"/>
                </svg>
                <h3 class="font-bold text-gray-800">Lapangan Anda</h3>
            </div>

            {{-- Lapangan Card --}}
            <div class="flex flex-col md:flex-row gap-8 border border-gray-100 rounded-xl p-6 bg-gray-50/50">

                {{-- Foto Lapangan --}}
                <div class="md:w-2/5 flex-shrink-0">
                    <div class="h-64 rounded-xl overflow-hidden bg-gray-200">
                        <img
                            :src="lapangan?.foto || 'https://images.unsplash.com/photo-1575361204480-aadea25e6e68?w=800&q=80'"
                            alt="Foto Lapangan"
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
                        <label class="text-sm font-medium text-gray-700">Nama Lapangan</label>
                        <input
                            type="text"
                            :value="lapangan?.nama || 'Lapangan Sejahtera'"
                            class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition"
                        >
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Lokasi</label>
                        <input
                            type="text"
                            :value="lapangan?.lokasi || 'Jl.Ahmad Yani, No 77, Senayan, Jakarta Pusat'"
                            class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition"
                        >
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Harga per Jam</label>
                        <input
                            type="text"
                            :value="lapangan?.harga || 'Rp 27.000,00'"
                            class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition"
                        >
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Atur Slot Waktu</label>
                        <div class="relative mt-1">
                            <select class="w-full appearance-none border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-500 outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition bg-white">
                                <option>Tambah Timeslot</option>
                                @for ($h = 0; $h < 24; $h++)
                                    <option>{{ sprintf('%02d.00 - %02d.00', $h, $h + 1) }}</option>
                                @endfor
                            </select>
                            <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Jenis Olahraga</label>
                        <div class="relative mt-1">
                            <select class="w-full appearance-none border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-500 outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition bg-white">
                                <option>Jenis Olahraga</option>
                                <option>Futsal</option>
                                <option>Badminton</option>
                                <option>Basket</option>
                                <option>Tenis</option>
                                <option>Voli</option>
                            </select>
                            <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Slot Waktu Saat Ini --}}
            <div class="mt-6">
                <h4 class="text-sm font-medium text-gray-700 mb-3">Slot Waktu Saat Ini</h4>
                <div class="flex flex-wrap gap-2">
                    @for ($h = 0; $h < 24; $h++)
                        @php $slot = sprintf('%02d.00-%02d.00', $h, $h + 1); @endphp
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-purple-50 border border-purple-200 rounded-lg text-xs text-purple-700 font-medium">
                            {{ $slot }}
                            <button type="button" class="text-purple-400 hover:text-red-500 leading-none transition">&times;</button>
                        </span>
                    @endfor
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex justify-end gap-3 mt-8">
                <button
                    type="button"
                    class="px-6 py-2.5 bg-red-500 text-white rounded-lg text-sm font-semibold hover:bg-red-600 active:scale-95 transition"
                >
                    Hapus
                </button>
                <button
                    type="button"
                    class="px-8 py-2.5 bg-purple-600 text-white rounded-lg text-sm font-semibold hover:bg-purple-700 active:scale-95 transition"
                >
                    Update
                </button>
            </div>

        </div>
    </div>

</x-layout.admin>
