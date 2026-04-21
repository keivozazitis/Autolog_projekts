<?php

namespace App\Http\Controllers;

use App\Models\User;

class HomeController extends Controller
{
    public function welcome()
    {
        // Vienkārši iegūst visus lietotājus vai kādu citu loģiku
        $topUsers = User::take(3)->get();

        return view('welcome', compact('topUsers'));
    }
}
