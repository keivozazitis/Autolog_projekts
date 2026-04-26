@extends('layouts.app')

@section('title', 'Ielogoties — AutoLog')

@section('content')
<div class="form-page" style="max-width:420px;">

    <div class="form-card" style="padding:36px 32px;">

        {{-- Tab poga --}}
        <div style="display:flex; border:1px solid var(--border); border-radius:var(--radius-sm); margin-bottom:28px; overflow:hidden;">
            <button onclick="showTab('login')" id="tab-login"
                    style="flex:1; padding:10px; background:var(--accent); color:var(--bg-primary); font-weight:600; font-size:0.875rem; border:none; cursor:pointer; transition:all 0.15s;">
                Ielogoties
            </button>
            <button onclick="showTab('register')" id="tab-register"
                    style="flex:1; padding:10px; background:transparent; color:var(--text-muted); font-weight:600; font-size:0.875rem; border:none; cursor:pointer; transition:all 0.15s;">
                Reģistrēties
            </button>
        </div>

        {{-- LOGIN --}}
        <div id="panel-login">
            <h2 style="font-size:1.3rem; font-weight:700; margin-bottom:22px; color:var(--text-primary);">Laipni lūdzam atpakaļ</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="filter-group" style="margin-bottom:14px;">
                    <label for="login-email">E-pasta adrese</label>
                    <input type="email" id="login-email" name="email" placeholder="tavs@epasts.lv" required value="{{ old('email') }}">
                </div>
                <div class="filter-group" style="margin-bottom:18px;">
                    <label for="login-password">Parole</label>
                    <input type="password" id="login-password" name="password" placeholder="••••••••" required>
                </div>
                <div style="display:flex; align-items:center; gap:8px; margin-bottom:20px;">
                    <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} style="accent-color:var(--accent);">
                    <label for="remember" style="font-size:0.8rem; color:var(--text-muted); cursor:pointer;">Atcerēties mani</label>
                </div>
                @if($errors->has('email'))
                    <p style="color:#e07070; font-size:0.8rem; margin-bottom:12px;">{{ $errors->first('email') }}</p>
                @endif
                <button type="submit" class="button" style="width:100%;">Ielogoties</button>
            </form>
        </div>

        {{-- REĢISTRĀCIJA --}}
        <div id="panel-register" style="display:none;">
            <h2 style="font-size:1.3rem; font-weight:700; margin-bottom:22px; color:var(--text-primary);">Izveidot kontu</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="filter-group" style="margin-bottom:14px;">
                    <label for="reg-name">Vārds</label>
                    <input type="text" id="reg-name" name="name" placeholder="Tavs vārds" required value="{{ old('name') }}">
                </div>
                <div class="filter-group" style="margin-bottom:14px;">
                    <label for="reg-email">E-pasta adrese</label>
                    <input type="email" id="reg-email" name="email" placeholder="tavs@epasts.lv" required value="{{ old('email') }}">
                </div>
                <div class="filter-group" style="margin-bottom:14px;">
                    <label for="reg-password">Parole</label>
                    <input type="password" id="reg-password" name="password" placeholder="••••••••" required>
                </div>
                <div class="filter-group" style="margin-bottom:20px;">
                    <label for="reg-password-confirm">Apstiprini paroli</label>
                    <input type="password" id="reg-password-confirm" name="password_confirmation" placeholder="••••••••" required>
                </div>
                @if($errors->any())
                    <ul style="color:#e07070; font-size:0.8rem; margin-bottom:12px; padding-left:18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <button type="submit" class="button" style="width:100%;">Reģistrēties</button>
            </form>
        </div>

    </div>
</div>

<script>
function showTab(tab) {
    const isLogin = tab === 'login';
    document.getElementById('panel-login').style.display    = isLogin ? 'block' : 'none';
    document.getElementById('panel-register').style.display = isLogin ? 'none'  : 'block';
    document.getElementById('tab-login').style.background    = isLogin ? 'var(--accent)' : 'transparent';
    document.getElementById('tab-login').style.color         = isLogin ? 'var(--bg-primary)' : 'var(--text-muted)';
    document.getElementById('tab-register').style.background = isLogin ? 'transparent' : 'var(--accent)';
    document.getElementById('tab-register').style.color      = isLogin ? 'var(--text-muted)' : 'var(--bg-primary)';
}

@if($errors->any())
    showTab('register');
@else
    const urlTab = new URLSearchParams(window.location.search).get('tab');
    if (urlTab === 'register') showTab('register');
@endif
</script>
@endsection
