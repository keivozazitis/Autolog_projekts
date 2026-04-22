<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $listings = Listing::with('images', 'user')->latest()->paginate(25);
        $users = User::withCount('listings')->latest()->get();
        return view('admin.index', compact('listings', 'users'));
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
}
