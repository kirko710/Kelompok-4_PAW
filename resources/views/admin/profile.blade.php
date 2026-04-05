<x-layout.admin title="Profil" activeMenu="admin.profile" breadcrumb="Profil">

    {{-- ---- PROFILE BANNER ---- --}}
    <div class="relative">
        {{-- Cover Photo --}}
        <div
            class="h-44 w-full bg-gradient-to-br from-amber-100 via-stone-200 to-amber-200"
            style="background-image: url('https://images.unsplash.com/photo-1579871494447-9811cf80d66c?w=1400&q=80'); background-size: cover; background-position: center;">
        </div>

        {{-- Profile Picture (overlapping) --}}
        <div class="absolute left-8 bottom-0 translate-y-1/2">
            <div class="w-28 h-28 rounded-full border-4 border-white shadow-lg overflow-hidden bg-gray-200">
                <img
                    src="https://ui-avatars.com/api/?name=Saipul+Alexander&background=7e22ce&color=fff&size=128"
                    alt="Foto Profil Saipul Alexander"
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
                <a href="#"
                    class="inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-red-500 hover:bg-red-600 text-white text-sm font-semibold transition-colors shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </a>
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
                            Saipul Alexander
                        </div>
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Tanggal Lahir</label>
                        <div class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm text-gray-800 bg-gray-50">
                            17 - Mei - 1994
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Alamat</label>
                        <div class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm text-gray-800 bg-gray-50">
                            Jalan. Soekarno Hatta No.12 , Bandung , Indonesia
                        </div>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Email</label>
                        <div class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm text-gray-800 bg-gray-50">
                            AhmadBran91@gmail.com
                        </div>
                    </div>

                    {{-- Nomor Telepon + Edit --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Nomor Telepon</label>
                        <div class="flex items-center gap-3">
                            <div class="flex-1 px-4 py-3 border border-gray-200 rounded-lg text-sm text-gray-800 bg-gray-50">
                                08124212312343
                            </div>
                            <button class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-courtee-600 hover:bg-courtee-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm flex-shrink-0">
                                Edit
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ======================== MIDDLE: Data Bisnis ======================== --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                <div class="space-y-4">

                    {{-- Nama Usaha --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Nama Usaha</label>
                        <div class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm text-gray-800 bg-gray-50">
                            Lapangan Sumber Sari Jaya
                        </div>
                    </div>

                    {{-- Jenis Usaha --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Jenis Usaha</label>
                        <div class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm text-gray-800 bg-gray-50">
                            Pelayanan Lapangan
                        </div>
                    </div>

                    {{-- Jumlah Lapangan Dikelola --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Jumlah Lapangan Dikelola</label>
                        <div class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm text-gray-800 bg-gray-50">
                            3 Lapangan Aktif
                        </div>
                    </div>

                    {{-- Status Lapangan + Edit --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Status Lapangan</label>
                        <div class="flex items-center gap-3">
                            <div class="flex-1 px-4 py-3 border border-gray-200 rounded-lg text-sm text-gray-800 bg-gray-50">
                                Terverifikasi
                            </div>
                            <button class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-courtee-600 hover:bg-courtee-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm flex-shrink-0">
                                Edit
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ======================== RIGHT: Statistik & Pembayaran ======================== --}}
            <div class="space-y-5">

                {{-- Statistik Singkat --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <h3 class="font-bold text-gray-800 text-base mb-4">Statistik Singkat</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-gray-500">Total Penyewaan Bulan ini</p>
                            <p class="text-2xl font-bold text-green-500 mt-0.5">127 Booking</p>
                        </div>
                        <div class="border-t border-gray-100 pt-3">
                            <p class="text-xs text-gray-500">Pendapatan Bulan ini</p>
                            <p class="text-lg font-bold text-gray-800 mt-0.5">Rp 18.600.000</p>
                        </div>
                    </div>
                </div>

                {{-- Metode Pembayaran Bisnis --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <h3 class="font-bold text-gray-800 text-base mb-4">Metode Pembayaran Bisnis</h3>
                    <div class="space-y-2 text-sm text-gray-700 mb-5">
                        <p>Bank Mandiri - Ahmad Brandon</p>
                        <p>
                            No Rekening.
                            <span class="underline font-medium text-gray-800">12913109123</span>
                        </p>
                        <p class="text-gray-500 text-xs">Metode Pembayaran Disetujui</p>
                    </div>
                    <button class="inline-flex items-center gap-2 w-full justify-center px-4 py-2.5 bg-courtee-600 hover:bg-courtee-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm">
                        Tambahkan Pembayaran
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
            {{-- Facebook --}}
            <a href="#" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-courtee-100 transition">
                <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
            </a>
            {{-- GitHub --}}
            <a href="#" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-courtee-100 transition">
                <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                </svg>
            </a>
            {{-- Instagram --}}
            <a href="#" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-courtee-100 transition">
                <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
            </a>
            {{-- Pinterest --}}
            <a href="#" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-courtee-100 transition">
                <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 0c-6.627 0-12 5.373-12 12 0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738a.36.36 0 0 1 .083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.632-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12 24c6.627 0 12-5.373 12-12 0-6.628-5.373-12-12-12z"/>
                </svg>
            </a>
        </div>

        {{-- Copyright --}}
        <p class="text-center text-xs text-gray-400">
            &copy; 2020 Your Company, Inc. All rights reserved.
        </p>
    </div>

</x-layout.admin>