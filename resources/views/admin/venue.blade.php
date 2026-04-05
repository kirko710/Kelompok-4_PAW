<x-layout.admin title="Manajemen Venue" activeMenu="admin.venue" breadcrumb="Dashboard > Manajemen Venue">

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

    </div>

</x-layout.admin>
