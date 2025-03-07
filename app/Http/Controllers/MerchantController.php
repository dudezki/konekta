<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Merchant;
use App\Models\Products;
use Illuminate\Support\Facades\Storage;

class MerchantController extends Controller
{
    public function showProfile($id)
    {
        $merchant = Merchant::find($id);
        
        if (!$merchant) {
            return redirect()->route('home')->with('error', 'Merchant not found');
        }

        // Get top 4 products for the top products section
        $topProducts = Products::where('merchant_id', $id)
            ->take(4)
            ->get();

        // Get next 4 products for the "More Products" section
        $moreProducts = Products::where('merchant_id', $id)
            ->skip(4)
            ->take(4)
            ->get();

        // Calculate average rating for all merchant's products
        $allProducts = Products::where('merchant_id', $id)->get();
        $totalRating = 0;
        $totalReviews = 0;

        foreach ($allProducts as $product) {
            $productRating = $product->reviews->avg('rating') ?? 0;
            $totalRating += $productRating * $product->reviews->count();
            $totalReviews += $product->reviews->count();
        }

        $averageRating = $totalReviews > 0 ? number_format($totalRating / $totalReviews, 1) : 0;

        return view('seller_profile', [
            'merchant' => $merchant,
            'topProducts' => $topProducts,
            'moreProducts' => $moreProducts,
            'averageRating' => $averageRating,
            'totalReviews' => $totalReviews,
            'isOwner' => false // Ensure view-only access
        ]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $merchant = Auth::guard('merchant')->user();
        
        if (!$merchant) {
            return redirect()->route('merchant_login')->with('error', 'Please login first');
        }

        if ($request->hasFile('cover_photo')) {
            // Delete old cover photo if exists
            if ($merchant->cover_photo) {
                Storage::delete('public/' . str_replace('/storage/', '', $merchant->cover_photo));
            }

            // Store new cover photo
            $coverPath = $request->file('cover_photo')->store('covers', 'public');
            $merchant->cover_photo = '/storage/' . $coverPath;
        }

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($merchant->avatar) {
                Storage::delete('public/' . str_replace('/storage/', '', $merchant->avatar));
            }

            // Store new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $merchant->avatar = '/storage/' . $avatarPath;
        }

        $merchant->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    // public function uploadProfilePhoto(Request $request)
    // {
    //     $request->validate([
    //         'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     $merchant = Auth::guard('merchant')->user();
    //     $imageName = time().'.'.$request->profile_photo->extension();
    //     $request->profile_photo->move(public_path('images'), $imageName);

    //     // Save the profile photo path to the database
    //     $merchant->profile_photo_path = $imageName;
    //     $merchant->save();

    //     return redirect()->route('merchant.profile')->with('success', 'Profile photo uploaded successfully.');
    // }

    public function showLoginForm()
    {
        return view('merchant_login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('merchant')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/merchant/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('merchant')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
