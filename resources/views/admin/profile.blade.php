<x-layout.admin title="Profil" activeMenu="admin.profile" breadcrumb="Profil">

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="mb-4 flex items-center gap-3 px-5 py-3 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm font-medium">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- ---- PROFILE BANNER ---- --}}
    <div class="relative">
        {{-- Cover Photo --}}
        <div
            class="h-44 w-full bg-gradient-to-br from-courtee-600 via-courtee-700 to-courtee-800"
            style="background-image: url('https://images.unsplash.com/photo-1579871494447-9811cf80d66c?w=1400&q=80'); background-size: cover; background-position: center;">
        </div>

        {{-- Profile Picture (overlapping) --}}
        <div class="absolute left-8 bottom-0 translate-y-1/2">
            <div class="w-28 h-28 rounded-full border-4 border-white shadow-lg overflow-hidden bg-gray-200">
                <img
                    src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=7e22ce&color=fff&size=128"
                    alt="Foto Profil {{ $user->name }}"
                    class="w-full h-full object-cover"
                >
            </div>
        </div>
    </div>

    {{-- ---- ACTION BUTTONS (below banner, right of avatar) ---- --}}
    <div class="bg-white border-b border-gray-100 shadow-sm -mx-8">
        <div class="px-8">
            <div class="flex items-center justify-start gap-3 pl-44 py-4">
                <a href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-courtee-600 hover:bg-courtee-700 text-white text-sm font-semibold transition-colors shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Go to Dashboard
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-red-500 hover:bg-red-600 text-white text-sm font-semibold transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- ---- THREE COLUMN LAYOUT ---- --}}
    <div class="py-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ======================== LEFT: Data Pribadi ======================== --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                <div class="space-y-4">

                    {{-- Nama --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Nama</label>
                        <div class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm text-gray-800 bg-gray-50">
                            {{ $user->name }}
                        </div>
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Tanggal Lahir</label>
                        <div class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm text-gray-800 bg-gray-50">
                            @if(optional($profile)->tanggal_lahir)
                                {{ \Carbon\Carbon::parse($profile->tanggal_lahir)->translatedFormat('d F Y') }}
                            @else
                                <span class="text-gray-400 italic">Belum diisi</span>
                            @endif
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Alamat</label>
                        <div class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm text-gray-800 bg-gray-50">
                            {{ optional($profile)->alamat ?? '—' }}
                        </div>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Email</label>
                        <div class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm text-gray-800 bg-gray-50">
                            {{ $user->email }}
                        </div>
                    </div>

                    {{-- Nomor Telepon --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Nomor Telepon</label>
                        <div class="flex items-center gap-3">
                            <div class="flex-1 px-4 py-3 border border-gray-200 rounded-lg text-sm text-gray-800 bg-gray-50">
                                {{ optional($profile)->telepon ?? '—' }}
                            </div>
                            <a href="{{ route('admin.profile.edit') }}"
                               class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-courtee-600 hover:bg-courtee-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm flex-shrink-0">
                                Edit
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ======================== MIDDLE: Data Bisnis ======================== --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                <div class="space-y-4">

                    {{-- Nama Usaha --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Nama Venue / Usaha</label>
                        <div class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm text-gray-800 bg-gray-50">
                            {{ optional($venue)->nama ?? 'Belum ada venue' }}
                        </div>
                    </div>

                    {{-- Lokasi --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Lokasi</label>
                        <div class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm text-gray-800 bg-gray-50">
                            {{ optional($venue)->lokasi ?? '—' }}
                        </div>
                    </div>

                    {{-- Jumlah Lapangan Dikelola --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Jumlah Lapangan Dikelola</label>
                        <div class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm text-gray-800 bg-gray-50">
                            {{ $totalLapangan }} Lapangan
                        </div>
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Status Akun</label>
                        <div class="flex items-center gap-3">
                            <div class="flex-1 px-4 py-3 border border-gray-200 rounded-lg text-sm bg-gray-50">
                                <span class="inline-flex items-center gap-1.5 text-green-600 font-semibold">
                                    <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                    Owner Terverifikasi
                                </span>
                            </div>
                            <a href="{{ route('admin.venue') }}"
                               class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-courtee-600 hover:bg-courtee-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm flex-shrink-0">
                                Venue
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ======================== RIGHT: Statistik & Pembayaran ======================== --}}
            <div class="space-y-5">

                {{-- Statistik Singkat --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <h3 class="font-bold text-gray-800 text-base mb-4">
                        Statistik — {{ now()->translatedFormat('F Y') }}
                    </h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-gray-500">Total Penyewaan Bulan ini</p>
                            <p class="text-2xl font-bold text-green-500 mt-0.5">
                                {{ $bookingBulanIni }} Booking
                            </p>
                        </div>
                        <div class="border-t border-gray-100 pt-3">
                            <p class="text-xs text-gray-500">Pendapatan Bulan ini</p>
                            <p class="text-lg font-bold text-gray-800 mt-0.5">
                                Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Info Rekening --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <h3 class="font-bold text-gray-800 text-base mb-4">Info Rekening</h3>
                    @if(optional($profile)->bank || optional($profile)->rekening)
                        <div class="space-y-2 text-sm text-gray-700 mb-5">
                            <p>{{ optional($profile)->bank ?? '—' }}</p>
                            <p>
                                No Rekening.
                                <span class="underline font-medium text-gray-800">
                                    {{ optional($profile)->rekening ?? '—' }}
                                </span>
                            </p>
                            <p class="text-gray-500 text-xs">Rekening terdaftar</p>
                        </div>
                    @else
                        <p class="text-sm text-gray-400 mb-5">Belum ada rekening terdaftar</p>
                    @endif
                    <button class="inline-flex items-center gap-2 w-full justify-center px-4 py-2.5 bg-courtee-600 hover:bg-courtee-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm"
                            onclick="window.location='{{ route('admin.profile.edit') }}'">
                        {{ optional($profile)->bank ? 'Edit Rekening' : 'Tambahkan Rekening' }}
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </button>
                </div>

            </div>
        </div>
    </div>

    {{-- ===================== FOOTER ===================== --}}
    <div class="border-t border-gray-200 mt-4 -mx-8 px-8 py-8 bg-white">
        {{-- Footer Links --}}
        <div class="flex flex-wrap justify-center gap-6 text-sm text-gray-400 mb-6">
            <a href="#" class="hover:text-courtee-600 transition">About</a>
            <a href="#" class="hover:text-courtee-600 transition">Blog</a>
            <a href="#" class="hover:text-courtee-600 transition">Jobs</a>
            <a href="#" class="hover:text-courtee-600 transition">Press</a>
            <a href="#" class="hover:text-courtee-600 transition">Accessibility</a>
            <a href="#" class="hover:text-courtee-600 transition">Partners</a>
        </div>

        {{-- Social Icons --}}
        <div class="flex justify-center gap-4 mb-6">
            <a href="#" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-courtee-100 transition">
                <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
            </a>
            <a href="#" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-courtee-100 transition">
                <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
            </a>
        </div>

        {{-- Copyright --}}
        <p class="text-center text-xs text-gray-400">
            &copy; {{ date('Y') }} Courtee — Aplikasi Pemesanan Lapangan Olahraga
        </p>
    </div>

</x-layout.admin>