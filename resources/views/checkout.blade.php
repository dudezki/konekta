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

            @if(isset($product))
                <div class="checkout-summary mb-4">
                    <h4>Order Summary</h4>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100px; height: 100px; object-fit: cover; margin-right: 20px;">
                                <div>
                                    <h5>{{ $product->name }}</h5>
                                    <p class="mb-1">Price: ₱{{ number_format($product->price, 2) }}</p>
                                    <p class="mb-0">Quantity: {{ $quantity }}</p>
                                    <p class="mb-0"><strong>Total: ₱{{ number_format($product->price * $quantity, 2) }}</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ isset($product) ? route('checkout.product.post', $product->id) : route('checkout.post') }}" method="POST">
                @csrf
                @if(isset($product))
                    <input type="hidden" name="quantity" value="{{ $quantity }}">
                @endif
                <div class="mb-3">
                    <label for="address" class="form-label">Delivery Address</label>
                    <input type="text" class="form-control" name="address" id="address" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone number</label>
                    <input type="text" class="form-control" name="phone" id="phone" required>
                </div>
                <div class="mb-3">
                    <label for="pincode" class="form-label">Pin Code</label>
                    <input type="text" class="form-control" name="pincode" id="pincode" required>
                </div>
                <button type="submit" class="btn btn-primary">Proceed to Payment</button>
            </form>
        </section>
    </main>
@endsection