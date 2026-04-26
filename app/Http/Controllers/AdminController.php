<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $listings = Listing::with('images', 'user')->latest()->paginate(25);
        $users = User::withCount('listings')->with('subscriptions')->latest()->get();

        $stats = [
            'total_users'       => User::count(),
            'new_users_today'   => User::whereDate('created_at', today())->count(),
            'total_listings'    => Listing::count(),
            'listings_today'    => Listing::whereDate('created_at', today())->count(),
            'total_messages'    => Message::count(),
            'subscribed_users'  => DB::table('subscriptions')->where('stripe_status', 'active')->count(),
            'monthly_revenue'   => DB::table('subscriptions')->where('stripe_status', 'active')->count() * 30,
        ];

        return view('admin.index', compact('listings', 'users', 'stats'));
    }

    public function destroyListing(Listing $listing)
    {
        foreach ($listing->images as $image) {
            Storage::delete(str_replace('storage/', 'public/', $image->image_path));
            $image->delete();
        }
        $listing->delete();
        return back()->with('success', 'Sludinājums izdzēsts.');
    }

    public function destroyUser(User $user)
    {
        foreach ($user->listings as $listing) {
            foreach ($listing->images as $image) {
                Storage::delete(str_replace('storage/', 'public/', $image->image_path));
                $image->delete();
            }
            $listing->delete();
        }
        $user->delete();
        return back()->with('success', 'Lietotājs izdzēsts.');
    }
}
