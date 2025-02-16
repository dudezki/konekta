@extends('layout')
@section('title', 'Home')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <main class="container" style="max-width: 1200px; margin-top: 5%;">
            <section> 
            <div class="card mb-3" style="max-width: 1200px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset('images/' . $product->image) }}" class="img-fluid rounded-start" alt="...">
                </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{$product->name}}</h5>
                    <p class="card-text"><p>₱{{$product->price}} per kilogram</p> </p>
                    <p class="card-text"><small class="text-body-secondary">{{$product->description}}</small></p>
                    <a href="{{route("cart.add", $product->id)}}" class="btn mb-3" style="background-color:rgba(4, 170, 109, 0.2); border-radius: 20px;">Add to Cart</a>
                    <a href="" class="btn mb-3" style="background-color: #04AA6D; border-radius: 20px;">Buy Now</a>
                </div>
            </div>
            </div>
            </div>
            @if(session()->has('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif
            </section>
        </main> 
@endsection