<x-layout.admin title="Manajemen Venue" activeMenu="admin.venue" breadcrumb="Dashboard > Manajemen Lapangan dan Venue">

    <h2 class="text-2xl font-bold text-gray-800 mb-6">Manajemen Venue</h2>

    <div class="bg-white rounded-xl border border-gray-100 p-8 shadow-sm">

        {{-- Header --}}
        <div class="flex items-center gap-2 mb-6">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            <h3 class="font-bold text-gray-800">Venue Anda</h3>
        </div>

        {{-- Venue Card --}}
        <div
            x-data="{
                venue: null,
                init() {
                    try {
                        const saved = localStorage.getItem('venue_data');
                        this.venue = saved ? JSON.parse(saved) : null;
                    } catch(e) { this.venue = null; }
                }
            }"
            x-init="init()"
        >
            <div class="flex flex-col md:flex-row gap-8 border border-gray-100 rounded-xl p-6 bg-gray-50/50">

                {{-- Foto Venue --}}
                <div class="md:w-2/5 flex-shrink-0">
                    <div class="h-64 rounded-xl overflow-hidden bg-gray-200">
                        <img
                            :src="venue?.foto || 'https://images.unsplash.com/photo-1575361204480-aadea25e6e68?w=800&q=80'"
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
                            :value="venue?.nama || 'Longfield Sport Centre'"
                            class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition"
                        >
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Deskripsi Venue</label>
                        <textarea
                            rows="3"
                            x-text="venue?.deskripsi || 'Pusat olahraga premium yang menyediakan layanan penyewaan lapangan sepak bola dengan kualitas terbaik.'"
                            class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition resize-none"
                        ></textarea>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Lokasi</label>
                        <input
                            type="text"
                            :value="venue?.lokasi || 'Jl.Ahmad Yani, No 77, Senayan, Jakarta Pusat'"
                            class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition"
                        >
                    </div>

                    <div class="flex justify-end pt-4">
                        <button
                            type="button"
                            class="px-8 py-2.5 bg-purple-600 text-white rounded-lg text-sm font-semibold hover:bg-purple-700 active:scale-95 transition"
                        >
                            Update
                        </button>
                    </div>
                </div>

            </div>

            {{-- Link ke Lapangan --}}
            <p class="mt-6 text-sm text-gray-500 text-center">
                Sepertinya anda belum membuat lapangan,&nbsp;
                <a href="{{ route('admin.lapangan') }}" class="text-purple-600 font-semibold hover:underline transition">
                    tekan di sini untuk membuat lapangan
                </a>
            </p>
        </div>

    </div>

</x-layout.admin>
