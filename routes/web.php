<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;


// Autentifikācijas skats
Route::view('/auth', 'auth')->name('auth');

// Autentifikācijas darbības
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Pārējās lapas
Route::get('/', function () {
    return view('welcome');
});
Route::get('/profile', function () {
    return view('profile');
});
Route::get('/registration', function () {
    return view('registration');
});
Route::get('/addListing', function () {
    return view('addListing');
});
Route::get('/sludinajumi', function () {
    return view('sludinajumi');
});

// Sludinājumu pievienošanas maršruts - saglabā dati no formas
Route::post('/sludinajumi', [ListingController::class, 'store'])->name('listing.store');

// Logout maršruts
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Lietotāja konta dzēšana (ar middleware, lai tikai autentificēti var dzēst)
Route::delete('/account/delete', [UserController::class, 'destroy'])
    ->middleware('auth')
    ->name('account.delete');
Route::get('/sludinajumi', [ListingController::class, 'index']);
Route::delete('/addListing/{listing}', [ListingController::class, 'destroy'])->name('listing.destroy');
Route::get('/listing/{id}', [ListingController::class, 'show'])->name('listing.show');
