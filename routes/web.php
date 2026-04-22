<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\PrivataisKatalogsController;
use App\Http\Controllers\AdminController;

Route::view('/auth', 'auth')->name('auth');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome']);

Route::get('/profile', function () {
    $myListings = \App\Models\Listing::with('images')
        ->where('user_id', Auth::id())
        ->latest()
        ->get();
    return view('profile', compact('myListings'));
})->middleware('auth');

Route::get('/registration', function () { return view('registration'); });
Route::get('/addListing', function () { return view('addListing'); })->middleware('auth');
Route::get('/katalogs', function () { return view('katalogs'); })->middleware('auth');

Route::get('/sludinajumi', [ListingController::class, 'index'])->name('listing.index');
Route::post('/sludinajumi', [ListingController::class, 'store'])->middleware('auth')->name('listing.store');
Route::get('/listing/{id}', [ListingController::class, 'show'])->name('listing.show');
Route::get('/listing/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth')->name('listing.edit');
Route::put('/listing/{listing}', [ListingController::class, 'update'])->middleware('auth')->name('listing.update');
Route::delete('/listing/{listing}', [ListingController::class, 'destroy'])->middleware('auth')->name('listing.destroy');

Route::get('/user/{id}', [UserController::class, 'publicProfile'])->name('user.profile');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::delete('/account/delete', [UserController::class, 'destroy'])
    ->middleware('auth')
    ->name('account.delete');

Route::middleware(['auth'])->group(function () {
    Route::get('/privatais', [PrivataisKatalogsController::class, 'index'])->name('privatais.index');
    Route::get('/privatais/create', [PrivataisKatalogsController::class, 'create'])->name('privatais.create');
    Route::post('/privatais', [PrivataisKatalogsController::class, 'store'])->name('privatais.store');
    Route::get('/privatais/{id}', [PrivataisKatalogsController::class, 'show'])->name('privatais.show');
    Route::delete('/privatais/{id}', [PrivataisKatalogsController::class, 'destroy'])->name('privatais.destroy');
    Route::post('/privatais/{id}/publish', [PrivataisKatalogsController::class, 'publish'])->name('privatais.publish');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::delete('/listings/{listing}', [AdminController::class, 'destroyListing'])->name('listings.destroy');
});
