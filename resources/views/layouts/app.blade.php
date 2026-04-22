<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AutoLog')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/modelis.js'])
    @stack('styles')
</head>
<body>

<header class="site-header">
    <div class="header-inner">
        <div class="header-brand">
            <a href="/" class="brand-link">
                <span class="brand-name">Auto<span class="accent">Log</span></span>
            </a>
        </div>

        <nav class="header-nav" id="headerNav">
            <a href="/sludinajumi" class="nav-link">Sludinājumi</a>
            @if(Auth::check())
                <a href="/addListing" class="nav-link">Ievietot</a>
                <a href="/katalogs" class="nav-link">Mans Katalogs</a>
            @endif
            @auth
                <a href="/profile" class="nav-link profile-link" style="display:none;">
                    <span class="profile-icon">👤</span>
                    {{ Auth::user()->name }}
                </a>
                <form method="POST" action="{{ route('logout') }}" style="display:none;">
                    @csrf
                    <button type="submit" class="btn-logout">Iziet</button>
                </form>
            @endauth
        </nav>

        <div class="header-actions">
            @auth
                <a href="/profile" class="profile-link">
                    <span class="profile-icon">👤</span>
                    {{ Auth::user()->name }}
                </a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Iziet</button>
                </form>
            @endauth
            @guest
                <a href="/registration" class="btn-outline">Ielogoties</a>
                <a href="/registration" class="btn-primary">Reģistrēties</a>
            @endguest
        </div>

        <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Izvēlne">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>

<main class="site-main">
    @yield('content')
</main>

<footer class="site-footer">
    <div class="footer-inner">
        <p>&copy; {{ date('Y') }} AutoLog. Visas tiesības aizsargātas.</p>
    </div>
</footer>

@stack('scripts')
<script>
    const toggle = document.getElementById('mobileMenuToggle');
    const nav = document.getElementById('headerNav');
    if (toggle && nav) {
        toggle.addEventListener('click', () => {
            nav.classList.toggle('open');
            toggle.classList.toggle('active');
        });
    }
</script>
</body>
</html>
