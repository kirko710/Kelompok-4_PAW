<x-layout.admin title="Manajemen Venue" activeMenu="admin.venue" breadcrumb="Dashboard > Manajemen Venue">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Manajemen Venue</h2>

    <div class="bg-white rounded-xl border border-gray-100 p-8 shadow-sm">
        <div class="flex items-center gap-2 mb-6">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            <h3 class="font-bold text-gray-800">Venue Anda</h3>
        </div>

        {{-- Venue Form --}}
        <div class="flex flex-col md:flex-row gap-8 border border-blue-100 rounded-xl p-6 bg-blue-50/30">
            {{-- Image --}}
            <div class="md:w-2/5">
                <div class="h-64 rounded-xl overflow-hidden bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1529900748604-07564a03e7a6?w=600&q=80" alt="Venue" class="w-full h-full object-cover">
                </div>
                <button class="w-full mt-3 bg-gray-100 text-gray-600 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-200 transition flex items-center justify-center gap-2">
                    Ganti Foto <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>

            {{-- Form Fields --}}
            <div class="md:w-3/5 space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-700">Nama Venue</label>
                    <input type="text" value="Longfield Sport Centre" class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-courtee-400">
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700">Deskripsi Venue</label>
                    <textarea rows="3" class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-courtee-400 resize-none">Pusat olahraga premium yang menyediakan layanan penyewaan lapangan sepak bola dengan kualitas terbaik.</textarea>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700">Lokasi</label>
                    <input type="text" value="Jl. Ahmad Yani, No 77, Senayan, Jakarta Pusat" class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-courtee-400">
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <button class="px-6 py-2.5 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition">Batal</button>
                    <button class="px-6 py-2.5 bg-courtee-600 text-white rounded-lg text-sm font-medium hover:bg-courtee-700 transition">Update</button>
                </div>
            </div>
        </div>

        <p class="mt-6 text-sm text-gray-500">
            Sepertinya anda belum membuat lapangan, <a href="#" class="text-courtee-600 font-medium underline">tekan di sini untuk membuat lapangan</a>
        </p>
    </div>
</x-layout.admin>
