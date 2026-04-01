<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard' }} - Courtee Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { poppins: ['Poppins', 'sans-serif'] },
                    colors: {
                        courtee: {
                            50: '#faf5ff', 100: '#f3e8ff', 200: '#e9d5ff', 300: '#d8b4fe',
                            400: '#c084fc', 500: '#a855f7', 600: '#9333ea', 700: '#7e22ce',
                            800: '#6b21a8', 900: '#581c87',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        * { font-family: 'Poppins', sans-serif; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100 text-gray-800 font-poppins">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-[280px] bg-gradient-to-b from-courtee-600 to-courtee-800 text-white flex flex-col fixed h-full z-40">
            <div class="p-6 flex-1">
                {{-- Sidebar Menu --}}
                <nav class="space-y-1">
                    @php
                        $menuItems = [
                            ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                            ['route' => 'admin.venue', 'label' => 'Manajemen Venue', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                            ['route' => 'admin.lapangan', 'label' => 'Manajemen Lapangan', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                            ['route' => 'admin.jadwal', 'label' => 'Jadwal Lapangan', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                            ['route' => 'admin.pemesanan', 'label' => 'Daftar Pemesanan', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01'],
                            ['route' => 'admin.verifikasi', 'label' => 'Verifikasi Pembayaran', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                            ['route' => 'admin.pembatalan', 'label' => 'Pembatalan & Refund', 'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'],
                            ['route' => 'admin.laporan', 'label' => 'Laporan & Analitik', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                            ['route' => 'admin.komunikasi', 'label' => 'Komunikasi & Feedback', 'icon' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'],
                        ];
                    @endphp

                    @foreach($menuItems as $item)
                        <a href="#"
                           class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition
                           {{ ($activeMenu ?? '') === $item['route'] ? 'bg-white/20 text-white shadow-lg' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
                            </svg>
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>
            </div>

            {{-- Bottom Actions --}}
            <div class="p-6 space-y-2">
                <a href="#" class="block w-full text-center px-4 py-2.5 rounded-xl text-sm font-medium bg-courtee-400/30 hover:bg-courtee-400/50 transition">
                    Profile
                </a>
                <a href="#" class="block w-full text-center px-4 py-2.5 rounded-xl text-sm font-medium bg-red-500/80 hover:bg-red-500 transition">
                    Logout
                </a>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 ml-[280px]">
            {{-- Top Bar --}}
            <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between sticky top-0 z-30">
                <div class="text-sm text-gray-500">
                    {{ $breadcrumb ?? 'Dashboard' }}
                </div>
                <div class="flex items-center gap-4">
                    <button class="relative p-2 text-gray-500 hover:text-courtee-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </button>
                    <div class="flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name=Saipul+Alexander&background=7e22ce&color=fff" alt="Avatar" class="w-9 h-9 rounded-full">
                        <span class="text-sm font-medium text-gray-700">Saipul Alexander</span>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <div class="p-8">
                {{ $slot }}
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
