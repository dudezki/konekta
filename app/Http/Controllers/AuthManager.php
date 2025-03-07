<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

class AuthManager extends Controller
{
    function merchant_login() {
        // Add debugging information
        Log::info('Merchant login attempt', [
            'is_authenticated' => Auth::guard('merchant')->check(),
            'user' => Auth::guard('merchant')->user()
        ]);

        // Only redirect if the merchant is actually authenticated
        if (Auth::guard('merchant')->check() && Auth::guard('merchant')->user()) {
            return redirect(route('home'));
        }
        return view('merchant_login');
    }

    function merchant_registration() {
        if (Auth::guard('merchant')->check()) {
            return redirect(route('home'));
        }
        return view('merchant_registration');
    }


function merchant_loginPost(Request $request){
    $request->validate([
        'email' => 'required',
        'password' => 'required'
    ]);

    $credentials = $request->only('email', 'password');
    
    // Debug the credentials
    Log::info('Login attempt credentials:', ['email' => $credentials['email']]);
    
    // Check if merchant exists
    $merchant = Merchant::where('email', $credentials['email'])->first();
    if (!$merchant) {
        return redirect(route('merchant_login'))->with("error", "Email not found");
    }

    if (Auth::guard('merchant')->attempt($credentials)) {
        return redirect()->intended(route('home'));
    }
    
    return redirect(route('merchant_login'))->with("error", "Invalid password");
}

function merchant_registrationPost(Request $request){
    $request->validate([
        'name' => 'required',
        'business_name' => 'required',
        'phone' => 'required',
        'email' => 'required|email|unique:merchants',
        'password' => [
            'required',
            'string',
            'min:8', // must be at least 8 characters in length
            'regex:/[a-z]/', // must contain at least one lowercase letter
            'regex:/[A-Z]/', // must contain at least one uppercase letter
            'regex:/[0-9]/', // must contain at least one digit
            'regex:/[@$!%*#?&]/', // must contain a special character
            'regex:/^\S*$/u' // must not contain spaces
            ]
    ]);       

    $data['name'] = $request->name;
    $data['business_name'] = $request->business_name;
    $data['phone'] = $request->phone;
    $data['email'] = $request->email;
    $data['password'] = Hash::make($request->password);
    $merchant = Merchant::create($data);
    if(!$merchant){
        return redirect(route('merchant_registration'))->with("error", "Registration failed");
    }
    return redirect(route('merchant_login'))->with("success", "Registration successful, login to access the app");
}


    function logout(){
        if (Auth::guard('merchant')->check()) {
            Auth::guard('merchant')->logout();
            Session::flush();
            return redirect(route('merchant_login'))->with('success', 'Logged out successfully');
        } else if (Auth::check()) {
            Auth::logout();
            Session::flush();
            return redirect(route('user_login'))->with('success', 'Logged out successfully');
        }
        return redirect(route('home'));
    }
}