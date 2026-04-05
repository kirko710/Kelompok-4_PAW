<x-layout.admin title="Manajemen Lapangan" activeMenu="admin.lapangan" breadcrumb="Dashboard > Manajemen Lapangan">

    <h2 class="text-2xl font-bold text-gray-800 mb-6">Manajemen Lapangan</h2>

    <div class="bg-white rounded-xl border border-gray-100 p-8 shadow-sm">

        {{-- Header --}}
        <div class="flex items-center gap-2 mb-6">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M9 21V10m6 11V10M3 10l9-7 9 7"/>
            </svg>
            <h3 class="font-bold text-gray-800">Lapangan Anda</h3>
        </div>

        {{-- Empty State --}}
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

    </div>

</x-layout.admin>
