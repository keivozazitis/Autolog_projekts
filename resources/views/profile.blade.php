<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autolog | profils</title>
    @vite(['resources/css/app.css'])
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
    @if(Auth::check())
    <div class="user-info">
        <h3>Laipni lūdzam, {{ Auth::user()->name }}!</h3>
        <p><strong>E-pasts:</strong> {{ Auth::user()->email }}</p>
        <style>
            form.delete-account-form {
                margin-top: 20px;
                text-align: center;
            }
            .delete-btn {
                background-color: #ff4d4f;
                margin-top: 20px;
                color: white;
                border: none;
                padding: 12px 24px;
                border-radius: 6px;
                font-size: 1rem;
                font-weight: 600;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }
            .delete-btn:hover {
                background-color: #d93638;
            }
        </style>
        @if(Auth::check())
        <form method="POST" action="{{ route('account.delete') }}" onsubmit="return confirm('Vai tiešām vēlies dzēst savu kontu? Šī darbība ir neatgriezeniska!');">
            @csrf
            @method('DELETE')
            <button type="submit" class="header-nav-btn delete-btn">Dzēst kontu</button>
        </form>
    @endif
    </div>
    @else
    <div class="user-info not-logged-in">
        <h3>Tu neesi ielogojies</h3>
        <p>Lūdzu, pieslēdzies, lai piekļūtu vairāk funkcijām.</p>
    </div>
    @endif

</body>
</html>