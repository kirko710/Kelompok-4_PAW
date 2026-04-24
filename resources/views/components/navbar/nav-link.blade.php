{{--
    Komponen: nav-link.blade.php
    Props:
        $label  → teks yang ditampilkan, contoh: 'Home'
        $route  → nama route, contoh: 'home'
        $active → boolean, apakah link ini sedang aktif
--}}

<li>
    <a href="{{ route($route) }}" class="nav-link {{ $active ? 'active' : '' }}">
        {{ $label }}
    </a>
</li>