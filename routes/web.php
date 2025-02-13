<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\OrderManager;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductManager;
use Laravel\Jetstream\Rules\Role;

Route::get('/', [ProductManager::class, 'index'])->name('home');

Auth::routes(['verify' => true]);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registration.post');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');
Route::group(['middleware' => 'auth'], function(){
    Route::get('/profile', function(){
        return "Hi";
    });

    Route::get("/cart/{id}", [ProductManager::class, 'addToCart'])->name('cart.add');
    Route::get("/cart", [ProductManager::class, 'showCart'])->name('cart.show');
    Route::get("/checkout", [OrderManager::class, 'showCheckout'])->name('checkout.show');
    Route::post("/checkout", [OrderManager::class, 'checkoutPost'])->name('checkout.post');

});
Route::get("product/{slug}", [ProductManager::class, 'details'])->name('products.details');



Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

