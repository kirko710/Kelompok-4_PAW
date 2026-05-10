<nav class="navbar">
    <div class="navbar__inner">
        <a href="{{ route('home') }}" class="navbar__logo">
            <img src="{{ asset('assets/logo.png') }}" alt="Courtee Logo">
            <span class="navbar__logo-text">ourtee</span>
        </a>
        <ul class="navbar__menu">
            @include('components.navbar.nav-link', [
                'label'  => 'Home',
                'route'  => 'home',
                'active' => request()->routeIs('home')
            ])
            @include('components.navbar.nav-link', [
                'label'  => 'Venue',
                'route'  => 'venue.index',
                'active' => request()->routeIs('venue.*')
            ])
        </ul>
        <div class="navbar__actions">
            @auth
            <div class="flex items-center gap-3">
                <div class="relative group">
                    <div class="flex items-center gap-3 px-4 py-2.5 rounded-2xl bg-gray-50 group-hover:bg-gray-100 transition-all cursor-pointer ring-1 ring-transparent group-hover:ring-gray-200">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6b7280&color=fff&size=40" 
                            alt="{{ Auth::user()->name }}" 
                            class="w-10 h-10 rounded-full ring-1 ring-gray-200">
                        
                        <div class="hidden sm:block">
                            <div class="text-base font-semibold text-gray-800 leading-tight">
                                {{ Str::limit(Auth::user()->name, 12) }}
                            </div>
                            <div class="text-sm text-gray-500 mt-0.5">
                                {{ ucfirst(Auth::user()->role) }}
                            </div>
                        </div>

                        <svg class="w-5 h-5 text-gray-400 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>

                    <div class="invisible opacity-0 group-hover:visible group-hover:opacity-100 absolute right-0 mt-2 w-64 origin-top-right transition-all duration-200 z-[999]">
                        <div class="h-2 bg-transparent"></div>
                        
                        <div class="bg-white border border-gray-100 rounded-2xl shadow-xl overflow-hidden py-2">
                            
                            <a href="{{ route('user.profile') }}" class="flex items-center px-6 py-4 text-base text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-colors">
                                <svg class="w-6 h-6 mr-4 opacity-60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Profile Saya
                            </a>
                            
                            <a href="{{ route('user.riwayat') }}" class="flex items-center px-6 py-4 text-base text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-colors">
                                <svg class="w-6 h-6 mr-4 opacity-60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Riwayat Pesanan
                            </a>

                            <div class="border-t border-gray-100 my-2"></div>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center w-full px-6 py-4 text-base text-red-600 hover:bg-red-50 transition-colors text-left">
                                    <svg class="w-6 h-6 mr-4 opacity-60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="flex gap-2">
                <a href="{{ route('login') }}" class="btn btn--primary px-5 py-2 rounded-xl text-sm">Login</a>
                <a href="{{ route('register') }}" class="btn btn--outline px-5 py-2 rounded-xl text-sm">Sign Up</a>
            </div>
            @endauth
        </div>
    </div>
</nav>