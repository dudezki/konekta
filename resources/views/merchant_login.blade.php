@extends('layout')
@section('title', 'Login')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="w-100" style="max-width: 500px;">
            <form action="{{route('merchant_login.post')}}" method="POST" class="mt-3">
                @csrf
                <h2 class="text-center">Log In</h2>
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Enter your Email address" style="border-radius: 20px; font-size: 13px; height: 40px">
                </div>
                <div class="mb-3 position-relative">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" style="border-radius: 20px; font-size: 13px; height: 40px" required>
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
                <div class="mb-3 position-relative text-end">
                    <span class="forgot-password">
                        <a href="no-javascript1.html" title="Forgot Password" id="link-reset" style="color: black; text-decoration: none;">Forgot Password?</a>
                    </span>
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-3" style="border-radius: 20px; height: 40px; font-size: 13px;">Sign In</button>
                <p class="mb-3 text-center">Don't have an account yet?</p>
                <a class="btn btn-registration w-100" style="border-radius: 20px; height: 40px; font-size: 13px; border: 1px solid #ccc;" href="{{route('merchant_registration')}}">Sign Up</a>
            </form>
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
@endsection