<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoLog</title>
    <link rel="stylesheet" href="app.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @vite(['resources/css/app.css','resources/js/toggle.js', 'public/autolog.png', 'resources/js/modelis.js'])
</head>
<body>
    <header>
        <!--headeris-->
        <img src="autolog.png" alt="logo" width="150" height="120">
        <div class="header-text">
            <a href="/" style="text-decoration: none; color: inherit;">
                <h1>Autolog</h1>
            </a>
            <a href="/sludinajumi" class="header-nav-btn">SLUDINĀJUMI</a>
            @if(Auth::check())
            <a href="/addListing" class="header-nav-btn">IEVIETOT SLUDINĀJUMU</a>
            @endif
            @if(Auth::check())
            <a href="/katalogs" class="header-nav-btn">PRIVĀTAIS KATALOGS</a>
            @endif
            @if(!Auth::check())
            <a href="/registration" class="header-nav-btn">LOGIN</a>
            <a href="/registration" class="header-nav-btn">REGISTRATION</a>
            @endif
        </div>
        <a href="/profile" class="header-nav-btn profile-btn">
            @if(Auth::check())
            {{ Auth::user()->name }}
            @else
            PROFILS
            @endif
        </a>
        @if(Auth::check())
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="header-nav-btn" style="color: red;">Logout</button>
        </form>
        @endif

    </header> 
    @foreach($ieraksti as $ieraksts)
        <div>
            <h3>{{ $ieraksts->brand }} {{ $ieraksts->model }}</h3>
            <p>Gads: {{ $ieraksts->year }}</p>
            <p>Cena: €{{ $ieraksts->price }}</p>
            <hr>
        </div>
    @endforeach
    
</body>
<footer style="text-align: center; padding: 20px; background-color: #f1f1f1; color: #333; margin-top: 40px;">
    &copy; {{ date('Y') }} AutoLog. Visas tiesības aizsargātas.
</footer>
</html>