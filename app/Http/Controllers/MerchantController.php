<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Merchant;
use App\Models\Products;

class MerchantController extends Controller
{
    public function showProfile($id)
    {
        $merchant = Merchant::find($id);
        $products = Products::where('merchant_id', $id)->get();

        return view('merchant_profile', compact('merchant', 'products'));
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

}
