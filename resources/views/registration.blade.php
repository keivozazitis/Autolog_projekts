<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login & Registration</title>
    
    @vite(['resources/css/register.css', 'resources/js/register.js', 'resources/js/validation.js'])
</head>
<body>
    <div class="container">
        <div id="LoginAndRegistrationForm">
            <h1 id="formTitle">Ielogoties</h1>
            
            <div id="formSwitchBtn">
                <button onclick="ShowLoginForm()" id="ShowLoginBtn" class="active">Ielogoties</button>
                <button onclick="ShowRegistrationForm()" id="ShowRegistrationBtn">Reģistrēties</button>
            </div>

            {{-- LOGINS --}}
            <div id="LoginFrom">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="center">
                        <input id="LoginEmail" name="email" class="input-text" type="email" placeholder="E-pasta adrese" required> 
                        <input id="LoginPassword" name="password" class="mt-10 input-text" type="password" placeholder="Parole" required>
                    </div>

                    <div class="forgot-pass-remember-me mt-10">
                        <div class="remember-me">
                            <input id="rememberMe" name="remember" type="checkbox">
                            <label for="rememberMe">Atcerēties mani</label>
                        </div>
                    </div>

                    <div class="center mt-20">
                        <button type="submit" class="Submit-Btn">Ielogoties</button>
                    </div>
                </form>
            </div>

            {{-- REGISTRAAACIJA --}}
            <div id="RegistrationFrom">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="center">
                        <input id="RegiName" name="name" class="input-text" type="text" placeholder="Vārds" required>
                        <input id="RegiEmailAddres" name="email" class="input-text mt-10" type="email" placeholder="E-pasta adrese" required>
                        <input id="RegiPassword" name="password" class="mt-10 input-text" type="password" placeholder="Parole" required>
                        <input id="RegiConfirmPassword" name="password_confirmation" class="mt-10 input-text" type="password" placeholder="Apstiprini Paroli" required>
                    </div>

                    <div class="center mt-20">
                        <button type="submit" class="Submit-Btn">Reģistrēties</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
