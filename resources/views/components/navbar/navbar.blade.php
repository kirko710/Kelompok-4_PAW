{{-- Navbar Component --}}
<nav class="sticky top-0 z-50 bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
        {{-- Logo --}}
        <a href="/" class="flex items-center gap-1.5">
            <div class="w-9 h-9 bg-courtee-700 rounded-full flex items-center justify-center">
                <span class="text-white text-sm font-bold">C</span>
            </div>
            <span class="text-xl font-bold text-courtee-700 tracking-tight">ourtee</span>
        </a>

        {{-- Nav Links --}}
        <div class="hidden md:flex items-center gap-8">
            <a href="/"
               class="text-sm font-medium {{ request()->is('/') ? 'text-courtee-600' : 'text-gray-600 hover:text-courtee-600' }} transition">
                Home
            </a>
            <a href="/venue"
               class="text-sm font-medium {{ request()->is('venue*') ? 'text-courtee-600' : 'text-gray-600 hover:text-courtee-600' }} transition">
                Venue
            </a>
            <a href="/community"
               class="text-sm font-medium {{ request()->is('community*') ? 'text-courtee-600' : 'text-gray-600 hover:text-courtee-600' }} transition">
                Community
            </a>
        </div>

        {{-- Auth Buttons --}}
        <div class="flex items-center gap-3">
            @auth
                {{-- Notification Bell --}}
                <button class="relative p-2 text-gray-500 hover:text-courtee-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                {{-- User Avatar --}}
                <div class="flex items-center gap-2">
                    <img src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=7e22ce&color=fff' }}"
                         alt="Avatar" class="w-8 h-8 rounded-full object-cover border-2 border-courtee-200">
                    <span class="text-sm font-medium text-gray-700 hidden lg:block">{{ auth()->user()->name }}</span>
                </div>
            @else
                <a href="#"
                   class="px-5 py-2 text-sm font-medium text-white bg-courtee-700 rounded-lg hover:bg-courtee-800 transition">
                    Login
                </a>
                <a href="#"
                   class="px-5 py-2 text-sm font-medium text-courtee-700 border border-courtee-300 rounded-lg hover:bg-courtee-50 transition">
                    Sign Up
                </a>
            @endauth
        </div>

        {{-- Mobile Menu Toggle --}}
        <button class="md:hidden p-2 text-gray-600" onclick="document.getElementById('mobile-nav').classList.toggle('hidden')">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    {{-- Mobile Nav --}}
    <div id="mobile-nav" class="hidden md:hidden border-t border-gray-100 bg-white px-6 py-4 space-y-3">
        <a href="/" class="block text-sm font-medium text-gray-600 hover:text-courtee-600">Home</a>
        <a href="#" class="block text-sm font-medium text-gray-600 hover:text-courtee-600">Venue</a>
        <a href="#" class="block text-sm font-medium text-gray-600 hover:text-courtee-600">Community</a>
    </div>
</nav>
