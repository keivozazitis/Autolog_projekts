<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;

class HomeController extends Controller
{
    public function welcome()
    {
        $topUsers = User::take(3)->get();
        $listingCount = Listing::count();
        $brandCount = Listing::distinct('brand')->count('brand');
        $todayCount = Listing::whereDate('created_at', today())->count();

        return view('welcome', compact('topUsers', 'listingCount', 'brandCount', 'todayCount'));
    }
}
