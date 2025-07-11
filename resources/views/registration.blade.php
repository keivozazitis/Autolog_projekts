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

            {{-- LOGIN --}}
            <div id="LoginFrom">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="center">
                        <input id="LoginEmail" name="email" class="input-text" type="email" placeholder="E-pasta adrese" required value="{{ old('email') }}"> 
                        <input id="LoginPassword" name="password" class="mt-10 input-text" type="password" placeholder="Parole" required>
                    </div>

                    <div class="forgot-pass-remember-me mt-10">
                        <div class="remember-me">
                            <input id="rememberMe" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                            <label for="rememberMe">Atcerēties mani</label>
                        </div>
                    </div>

                    {{-- Kļūdu paziņojums login formā --}}
                    @if($errors->has('email'))
                        <div class="error-message" style="color: red; margin-top: 10px;">
                            {{ $errors->first('email') }}
                        </div>
                    @endif

                    <div class="center mt-20">
                        <button type="submit" class="Submit-Btn">Ielogoties</button>
                    </div>
                </form>
            </div>

            {{-- REGISTRĀCIJA --}}
            <div id="RegistrationFrom" style="display:none;">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="center">
                        <input id="RegiName" name="name" class="input-text" type="text" placeholder="Vārds" required value="{{ old('name') }}">
                        <input id="RegiEmailAddres" name="email" class="input-text mt-10" type="email" placeholder="E-pasta adrese" required value="{{ old('email') }}">
                        <input id="RegiPassword" name="password" class="mt-10 input-text" type="password" placeholder="Parole" required>
                        <input id="RegiConfirmPassword" name="password_confirmation" class="mt-10 input-text" type="password" placeholder="Apstiprini Paroli" required>
                    </div>

                    {{-- Kļūdu paziņojumi reģistrācijas formā --}}
                    @if($errors->any())
                        <div class="error-message" style="color: red; margin-top: 10px;">
                            <ul style="margin: 0; padding-left: 20px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="center mt-20">
                        <button type="submit" class="Submit-Btn">Reģistrēties</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function ShowLoginForm() {
            document.getElementById('LoginFrom').style.display = 'block';
            document.getElementById('RegistrationFrom').style.display = 'none';
            document.getElementById('ShowLoginBtn').classList.add('active');
            document.getElementById('ShowRegistrationBtn').classList.remove('active');
            document.getElementById('formTitle').innerText = 'Ielogoties';
        }
        function ShowRegistrationForm() {
            document.getElementById('LoginFrom').style.display = 'none';
            document.getElementById('RegistrationFrom').style.display = 'block';
            document.getElementById('ShowLoginBtn').classList.remove('active');
            document.getElementById('ShowRegistrationBtn').classList.add('active');
            document.getElementById('formTitle').innerText = 'Reģistrēties';
        }

        // Automātiski parāda reģistrācijas formu, ja ir reģistrācijas kļūdas
        @if ($errors->any() && request()->routeIs('register'))
            ShowRegistrationForm();
        @endif
    </script>
</body>
<footer style="text-align: center; padding: 20px; background-color: #f1f1f1; color: #333; margin-top: 40px; position:absolute; bottom: 0; width: 100%; box-sizing:border-box;">
    &copy; {{ date('Y') }} AutoLog. Visas tiesības aizsargātas.
</footer>
</html>
