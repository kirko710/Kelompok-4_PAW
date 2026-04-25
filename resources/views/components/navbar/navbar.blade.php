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
                <div class="flex items-center gap-2 px-3 py-2 rounded-xl bg-gray-50 hover:bg-gray-100 transition-all">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6b7280&color=fff&size=32" 
                        alt="{{ Auth::user()->name }}" 
                        class="w-8 h-8 rounded-full ring-1 ring-gray-200">
                    <div class="hidden sm:block">
                        <div class="text-sm font-semibold text-gray-800">
                            {{ Str::limit(Auth::user()->name, 12) }}
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ ucfirst(Auth::user()->role) }}
                        </div>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn--primary px-5 py-2 rounded-xl text-sm" style="background: #ef4444; min-width: 80px;">
                        Logout
                    </button>
                </form>
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
