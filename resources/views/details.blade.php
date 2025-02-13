@extends('layout')
@section('title', 'Home')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <main class="container" style="max-width: 900px;">
            <section> 
            <img src="{{ asset('images/' . $product->image) }}" width="100%">
            @if(session()->has('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif
                <h1>{{$product->name}}</h1>
                <p>{{$product->price}}</p> 
                <p>{{$product->description}}</p> 
                <a href="{{route("cart.add", $product->id)}}" class="btn mb-3">Add to Cart</a>  
            </section>
        </main> 
@endsection