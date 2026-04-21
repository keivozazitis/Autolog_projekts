@extends('layouts.app')

@section('title', 'Profils — AutoLog')

@section('content')
<div class="profile-page">
    @if(Auth::check())
        <div class="profile-card">
            <div class="profile-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <h2 class="profile-name">{{ Auth::user()->name }}</h2>
            <p class="profile-email">{{ Auth::user()->email }}</p>

            @if(Auth::user()->is_admin)
            <div style="margin-top: 20px;">
                <a href="{{ route('admin.index') }}" class="button" style="width:100%; display:block; text-align:center;">
                    Admin panelis
                </a>
            </div>
            @endif

            <div class="profile-divider"></div>

            <div class="danger-zone">
                <p class="danger-zone-title">Bīstamā zona</p>
                <p class="danger-zone-desc">
                    Konta dzēšana ir neatgriezeniska. Visi tavi sludinājumi un dati tiks neatgriezeniski izdzēsti.
                </p>
                <form method="POST" action="{{ route('account.delete') }}"
                      onsubmit="return confirm('Vai tiešām vēlies dzēst savu kontu? Šī darbība ir neatgriezeniska!');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button btn-danger">Dzēst kontu</button>
                </form>
            </div>
        </div>
    @else
        <div class="not-logged-in-card">
            <h3>Tu neesi ielogojies</h3>
            <p>Lūdzu, pieslēdzies, lai piekļūtu profilam un vairāk funkcijām.</p>
            <br>
            <a href="/registration" class="button" style="margin-top:8px;">Ielogoties</a>
        </div>
    @endif
</div>
@endsection
