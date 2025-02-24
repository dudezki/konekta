<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    function user_login() {
        if (Auth::check()) {
            return redirect(route('home'));
        }
        return view('user_login');
    }

    function user_registration() {
        if (Auth::check()) {
            return redirect(route('home'));
        }
        return view('user_registration');
    }


function loginPost(Request $request){
    $request->validate([
        'email' => 'required',
        'password' => 'required'
    ]);

    $credentials = $request->only('email', 'password');
    if (Auth::guard('web')->attempt($credentials)) {
        return redirect()->intended(route('home'));
    }
    return redirect(route('user_login'))->with("error", "Login details are not valid");
}

function registrationPost(Request $request){
    $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'email' => 'required|email|unique:users',
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
    $data['phone'] = $request->phone;
    $data['email'] = $request->email;
    $data['password'] = Hash::make($request->password);
    $user = User::create($data);
    if(!$user){
        return redirect(route('user_registration'))->with("error", "Registration failed");
    }
    return redirect(route('user_login'))->with("success", "Registration successful, login to access the app");
}


    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
