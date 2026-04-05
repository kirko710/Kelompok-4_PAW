<nav class="navbar">
    <div class="navbar__inner">
        <a href="{{ route('home') }}" class="navbar__logo">
            <img src="{{ asset('assets\logo.png') }}" alt="Courtee Logo">
            <span class="navbar__logo-text">ourtee</span>
        </a>
        <ul class="navbar__menu">
            @include('navbar.nav-link', [
                'label'  => 'Home',
                'route'  => 'home',
                'active' => request()->routeIs('home')
            ])
            @include('navbar.nav-link', [
                'label'  => 'Venue',
                'route'  => 'venue.index',
                'active' => request()->routeIs('venue.*')
            ])
            @include('navbar.nav-link', [
                'label'  => 'Community',
                'route'  => 'community.index',
                'active' => request()->routeIs('community.*')
            ])
        </ul>
        <div class="navbar__actions">
            <a href="{{ route('login') }}"    class="btn btn--primary">Login</a>
            <a href="{{ route('register') }}" class="btn btn--outline">Sign Up</a>
        </div>
    </div>
</nav>