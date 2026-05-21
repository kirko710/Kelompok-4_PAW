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
                <div class="relative ">
                    <button type="button" id="userDropdownButton" class="flex items-center gap-3 px-4 py-2.5 rounded-2xl bg-gray-50 hover:bg-gray-100 transition-all cursor-pointer ring-1 ring-transparent hover:ring-gray-200">
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
                    </button>

                    <div id="userDropdownMenu"
     class="hidden absolute right-0 mt-2 origin-top-right z-[999]"
     style="width: 240px;">

    <div style="height: 8px;"></div>

    <div style="background: white; border: 1px solid #f3f4f6; border-radius: 16px; box-shadow: 0 12px 30px rgba(0,0,0,0.12); overflow: hidden; padding: 8px 0;">

        <a href="{{ route('user.profile') }}"
           style="display: flex; align-items: center; gap: 12px; padding: 12px 18px; font-size: 14px; color: #374151; text-decoration: none; white-space: nowrap;">
            <svg style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            Profile Saya
        </a>

        <a href="{{ route('user.riwayat') }}"
           style="display: flex; align-items: center; gap: 12px; padding: 12px 18px; font-size: 14px; color: #374151; text-decoration: none; white-space: nowrap;">
            <svg style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Riwayat Pesanan
        </a>

        <div style="border-top: 1px solid #f3f4f6; margin: 8px 0;"></div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                    style="display: flex; align-items: center; gap: 12px; width: 100%; padding: 12px 18px; font-size: 14px; color: #dc2626; background: white; border: none; cursor: pointer; text-align: left; white-space: nowrap;">
                <svg style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
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
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const button = document.getElementById('userDropdownButton');
    const menu = document.getElementById('userDropdownMenu');

    if (!button || !menu) return;

    button.addEventListener('click', function (event) {
        event.stopPropagation();
        menu.classList.toggle('hidden');
    });

    document.addEventListener('click', function () {
        menu.classList.add('hidden');
    });
});
</script>
</nav>