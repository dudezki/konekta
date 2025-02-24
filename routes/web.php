<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\OrderManager;
use App\Http\Controllers\ProductManager;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\UserController;
use App\Models\Merchant;
use Laravel\Jetstream\Rules\Role;

Route::get('/', [ProductManager::class, 'index'])->name('home');

Auth::routes(['verify' => true]);

// Dashboard Routes (Protected by Auth Middleware)
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

// Merchant Authentication Routes
Route::get('/merchant_login', [AuthManager::class, 'login'])->name('merchant_login');
Route::post('/merchant_login', [AuthManager::class, 'loginPost'])->name('merchant_login.post');
Route::get('/merchant_registration', [AuthManager::class, 'registration'])->name('merchant_registration');
Route::post('/merchant_registration', [AuthManager::class, 'registrationPost'])->name('merchant_registration.post');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

Route::get('/user', [UserController::class, 'user_login'])->name('user_login');
Route::post('/user', [UserController::class, 'loginPost'])->name('user_login.post');
Route::get('/user_registration', [UserController::class, 'user_registration'])->name('user_registration');
Route::post('/user_registration', [UserController::class, 'registrationPost'])->name('user_registration.post');

// Protected Routes for Authenticated Users
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return "Hi";
    });

    Route::get("/cart/{id}", [ProductManager::class, 'addToCart'])->name('cart.add.get');
    Route::post('/cart/{id}', [ProductManager::class, 'addToCart'])->name('cart.add.post');
    Route::get("/cart", [ProductManager::class, 'showCart'])->name('cart.show');

    Route::get("/checkout", [OrderManager::class, 'showCheckout'])->name('checkout.show');
    Route::post("/checkout", [OrderManager::class, 'checkoutPost'])->name('checkout.post');

    Route::post('/favorites/toggle/{id}', [ProductManager::class, 'toggleFavorite'])->name('favorites.toggle');
    Route::get('/favorites', [ProductManager::class, 'showFavorites'])->name('favorites.show');
});

// Merchant-Specific Routes (Uses 'merchant' Guard)
// Route::middleware(['auth:merchant'])->group(function () {
//     Route::get('/merchant/{id}', [MerchantController::class, 'show'])->name('merchant.profile');
// });

Route::get('/merchant/{id}', [MerchantController::class, 'showProfile']);

// Product Detail Route
Route::get("product/{slug}", [ProductManager::class, 'details'])->name('products.details');

// Email Verification Routes
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
