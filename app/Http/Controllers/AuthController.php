<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validē ievadītos datus
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Mēģina autentificēt lietotāju ar sniegtajiem datiem
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Pēc veiksmīgas ielogošanās - drošības nolūkos regenerē sesiju
            $request->session()->regenerate();

            // Novirza uz iecerēto lapu vai uz mājas lapu
            return redirect()->intended('/');
        }

        // Ja neizdevās autentificēties, atgriež atpakaļ ar kļūdas ziņu
        return back()->withErrors([
            'email' => 'Nepareiza e-pasta adrese vai parole.',
        ])->withInput($request->only('email'));
    }

    public function register(Request $request)
    {
        // Validē reģistrācijas datus
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        // Izveido jaunu lietotāju ar droši hashētu paroli
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Automātiski ielogojas jaunais lietotājs
        Auth::login($user);

        // Novirza uz mājas lapu vai citu lapu pēc reģistrācijas
        return redirect('/');
    }
}
