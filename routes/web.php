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
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ShopController;

Route::get('/', [ProductManager::class, 'index'])->name('home');

Auth::routes(['login' => false]); // Completely disables default /login route

Route::get('/login', function () {
    return redirect('/user_login');
})->name('login');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


// Merchant Authentication Routes
Route::middleware(['web'])->group(function () {
    Route::get('/merchant_login', [AuthManager::class, 'merchant_login'])->name('merchant_login');
    Route::post('/merchant_login', [AuthManager::class, 'merchant_loginPost'])->name('merchant_login.post');
    Route::get('/merchant_registration', [AuthManager::class, 'merchant_registration'])->name('merchant_registration');
    Route::post('/merchant_registration', [AuthManager::class, 'merchant_registrationPost'])->name('merchant_registration.post');
    Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');
});

Route::get('/user_login', [UserController::class, 'user_login'])->name('user_login');
Route::post('/user_login', [UserController::class, 'user_loginPost'])->name('user_login.post');
Route::get('/user_registration', [UserController::class, 'user_registration'])->name('user_registration');
Route::post('/user_registration', [UserController::class, 'user_registrationPost'])->name('user_registration.post');

// Protected Routes for Authenticated Users
Route::middleware(['auth'])->group(function () {
    config(['auth.login_path' => 'user_login']);

    Route::get('/profile', function () {
        return view('profile.show');
    })->name('profile.show');

    Route::get("/cart/{id}", [ProductManager::class, 'addToCart'])->name('cart.add.get');
    Route::post('/cart/{id}', [ProductManager::class, 'addToCart'])->name('cart.add.post');
    Route::get("/cart", [ProductManager::class, 'showCart'])->name('cart.show');

    Route::get("/checkout", [OrderManager::class, 'showCheckout'])->name('checkout.show');
    Route::post("/checkout", [OrderManager::class, 'checkoutPost'])->name('checkout.post');
    Route::get("/checkout/product/{id}", [OrderManager::class, 'showProductCheckout'])->name('checkout.product');
    Route::post("/checkout/product/{id}", [OrderManager::class, 'checkoutProductPost'])->name('checkout.product.post');

    Route::post('/favorites/toggle/{id}', [ProductManager::class, 'toggleFavorite'])->name('favorites.toggle');
    Route::get('/favorites', [ProductManager::class, 'showFavorites'])->name('favorites.show');

    // Review Routes
    Route::post('/products/{id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

// User Profile Routes
Route::get('/user/profile', [UserController::class, 'show'])->name('user.profile');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
Route::get('/user/change-email', [UserController::class, 'changeEmail'])->name('user.changeEmail');
Route::post('/user/change-email', [UserController::class, 'updateEmail'])->name('user.updateEmail');
Route::get('/user/change-phone', [UserController::class, 'changePhone'])->name('user.changePhone');
Route::post('/user/change-phone', [UserController::class, 'updatePhone'])->name('user.updatePhone');

// Merchant Profile Routes
Route::get('/seller/{id}', [MerchantController::class, 'showProfile'])->name('seller.profile');

Route::middleware(['auth:merchant'])->group(function () {
    Route::put('/merchant/update-profile', [MerchantController::class, 'updateProfile'])
        ->name('merchant.update-profile');
});

// Shop Route
Route::get('/shop', [ShopController::class, 'index'])->name('shop');

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

Route::get('/products', [ProductManager::class, 'index'])->name('products');
