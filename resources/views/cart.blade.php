@extends('layout')
@section('title', 'Home')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <div class="container" style="margin-top: 5%;">
        <main class="container">
            <section>
                <div class="row">
                    @if(session()->has('error'))
                        <div class="alert alert-danger">{{session('error')}}</div>   
                    @endif
                    @if(session()->has('success'))
                        <div class="alert alert-success">{{session('success')}}</div>   
                    @endif

                    @if($cartItems->isEmpty())
                        <div class="d-flex justify-content-center align-items-center" style="height: 300px;">
                            <h3>Your cart is empty, add products now!</h3>
                        </div>
                    @else
                        @foreach($cartItems as $cart)
                            <div class="col-12">
                                <div class="card mb-3" style="max-width: 540px;">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="images/{{$cart->image}}" class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><a href="{{route("products.details", $cart->slug)}}">{{$cart->name}}</a></h5>
                                                <p class="card-text">Price: ₱{{$cart->price}} | Quantity: {{$cart->quantity}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </section>
            @if(!$cartItems->isEmpty())
                <div>
                    <a class="btn btn-success" href="{{route('checkout.show')}}">Checkout</a>
                </div>
            @endif
        </main> 
    </div>
@endsection