<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function destroy(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/')->with('status', 'Lietotājs nav atrasts.');
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Tavs konts veiksmīgi dzēsts.');
    }
}
