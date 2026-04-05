<x-layout.admin title="Manajemen Lapangan" activeMenu="admin.lapangan" breadcrumb="Dashboard > Manajemen Lapangan dan Venue">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Manajemen Lapangan</h2>

    <div class="bg-white rounded-xl border border-gray-100 p-8 shadow-sm">
        <div class="flex items-center gap-2 mb-6">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            <h3 class="font-bold text-gray-800">Lapangan Anda</h3>
        </div>

        <div class="flex flex-col md:flex-row gap-8 border border-blue-100 rounded-xl p-6 bg-blue-50/30">
            {{-- Image --}}
            <div class="md:w-2/5">
                <div class="h-64 rounded-xl overflow-hidden bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1575361204480-aadea25e6e68?w=600&q=80" alt="Lapangan" class="w-full h-full object-cover">
                </div>
                <button class="w-full mt-3 bg-gray-100 text-gray-600 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-200 transition flex items-center justify-center gap-2">
                    Ganti Foto <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>

            {{-- Form --}}
            <div class="md:w-3/5 space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-700">Nama Lapangan</label>
                    <input type="text" value="Lapangan Sejahtera" class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-courtee-400">
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700">Lokasi</label>
                    <input type="text" value="Jl. Ahmad Yani, No 77, Senayan, Jakarta Pusat" class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-courtee-400">
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700">Harga per Jam</label>
                    <input type="text" value="Rp 27.000,00" class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-courtee-400">
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700">Atur Slot Waktu</label>
                    <select class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-courtee-400">
                        <option>Tambah Timeslot</option>
                    </select>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700">Jenis Olahraga</label>
                    <select class="w-full mt-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-courtee-400">
                        <option>Jenis Olahraga</option>
                        <option>Futsal</option>
                        <option>Badminton</option>
                        <option>Tennis</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Time Slots --}}
        <div class="mt-6">
            <h4 class="text-sm font-medium text-gray-700 mb-3">Slot Waktu Saat Ini</h4>
            <div class="flex flex-wrap gap-2">
                @php
                    $slots = [];
                    for ($h = 0; $h < 24; $h++) {
                        $slots[] = sprintf('%02d.00-%02d.00', $h, $h + 1);
                    }
                @endphp
                @foreach($slots as $slot)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-courtee-50 border border-courtee-200 rounded-lg text-xs text-courtee-600 font-medium">
                        {{ $slot }}
                        <button class="text-courtee-400 hover:text-red-500">&times;</button>
                    </span>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end gap-3 mt-8">
            <button class="px-6 py-2.5 bg-red-500 text-white rounded-lg text-sm font-medium hover:bg-red-600 transition">Hapus</button>
            <button class="px-6 py-2.5 bg-courtee-600 text-white rounded-lg text-sm font-medium hover:bg-courtee-700 transition">Update</button>
        </div>
    </div>
</x-layout.admin>
