<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function publicProfile($id)
    {
        $user = User::findOrFail($id);
        $listings = \App\Models\Listing::with('images')
            ->where('user_id', $id)
            ->latest()
            ->get();
        return view('user.profile', compact('user', 'listings'));
    }

    public function updatePhone(Request $request)
    {
        $request->validate(['phone' => ['nullable', 'string', 'max:30']]);
        Auth::user()->update(['phone' => $request->input('phone') ?: null]);
        return back()->with('phone_saved', 'Tālrunis saglabāts.');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/')->with('status', 'Lietotājs nav atrasts.');
        }

        if (!\Illuminate\Support\Facades\Hash::check($request->input('password'), $user->password)) {
            return back()->withErrors(['password' => 'Nepareiza parole.']);
        }

        foreach ($user->listings()->with('images')->get() as $listing) {
            foreach ($listing->images as $image) {
                \Illuminate\Support\Facades\Storage::delete(str_replace('storage/', 'public/', $image->image_path));
                $image->delete();
            }
            $listing->delete();
        }

        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Tavs konts veiksmīgi dzēsts.');
    }
}
