@extends('layout')
@section('title', 'Checkout')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <main class="container" style="max-width: 900px;">
        <section>
            <h2>Checkout</h2>
            @if(session()->has('error'))
                <div class="alert alert-danger">{{session('error')}}</div>   
            @endif
            @if(session()->has('success'))
                <div class="alert alert-success">{{session('success')}}</div>   
            @endif
            <form action="{{route('checkout.post')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" id="address" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Phone number</label>
                    <input type="text" class="form-control" name="phone" id="phone" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Pin Code</label>
                    <input type="text" class="form-control" name="pincode" id="pincode" required>
                </div>
                <button type="submit" class="btn btn-primary">Proceed to Payment</button>
            </form>
        </section>
    </main>
@endsection