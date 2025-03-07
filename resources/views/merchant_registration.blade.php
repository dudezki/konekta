@extends('layout')
@section('title', 'Registration')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form action="{{route('merchant_registration.post')}}" method="POST" class="ms-auto me-auto mt-3" style="width: 500px;">
            @csrf
            <h2 style="text-align: center;">Merchant Sign Up</h2>
            <div class="mb-3">
                <input type="text" class="form-control" name="name" placeholder="Enter your Name" style="height: 40px; border-radius: 20px; font-size: 13px;">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="business_name" placeholder="Enter your Business Name" style="height: 40px; border-radius: 20px; font-size: 13px;">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="phone" placeholder="Enter your Phone Number" style="height: 40px; border-radius: 20px; font-size: 13px;">
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="Enter your Email Address" style="height: 40px; border-radius: 20px; font-size: 13px;">
            </div>
            <div class="mb-3 position-relative">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" style="border-radius: 20px; font-size: 13px; height: 40px" >
                    <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"></span>
            </div>
                <script>
                    document.querySelector('.toggle-password').addEventListener('click', function (e) {
                        const passwordField = document.querySelector('#password');
                        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                        passwordField.setAttribute('type', type);
                        this.classList.toggle('fa-eye-slash');
                    });
                </script>
            <button type="submit" class="btn btn-primary w-100 mb-3" style="border: 1px solid gray; background: transparent; color: gray; border-radius: 20px; height: 40px; font-size: 13px;">Sign Up</button>
            <a class="mb-3 text-center d-block" href="{{route('merchant_login.post')}}" style="text-decoration: none; color:black;">Already have an account?</a>
            <div class="d-flex align-items-center justify-content-center" style="width: 500px;">
                <hr style="flex-grow: 1; border: none; border-top: 1px solid #000;">
                <span class="mx-2">or</span>
                <hr style="flex-grow: 1; border: none; border-top: 1px solid #000;">
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-light" type="button" style="border-radius: 20px; height: 40px; font-size: 13px; ">
                    <img src="https://img.icons8.com/color/16/000000/google-logo.png" style="margin-right: 10px;">
                    Sign Up with Google
                </button>
            </div>
        </form>
        <div class="fixed-bottom mb-3 w-100 d-flex justify-content-center">
            <div class="w-50">
                @if($errors->any())
                    <div class="col-12">
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">{{$error}}</div>
                        @endforeach    
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>   
                @endif
                @if(session()->has('success'))
                    <div class="alert alert-success">{{session('success')}}</div>   
                @endif
            </div>
        </div>
    </div>
@endsection