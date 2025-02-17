@extends('layout')
@section('title', 'Favorites')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <div class="container" style="margin-top: 5%;">
        <main class="container">
            <section>
                <div class="row">
                    <h2 style="text-align: center;">Favorites</h2>
                    @if($favorites->isEmpty())
                        <div class="d-flex justify-content-center align-items-center" style="height: 300px;">
                            <h3>You have no favorite items.</h3>
                        </div>
                    @else
                        @foreach($favorites as $favorite)
                            <div class="mt-5 col-12 col-md-6 col-lg-3">
                                <a href="{{route("products.details", $favorite->product->slug)}}" style="text-decoration: none; color: inherit;">
                                    <div class="card p-2 shadow-sm mb-5">
                                        <img src="images/{{$favorite->product->image}}" width="290px" height="300px">
                                        <div style="display: flex; align-items: center; justify-content: space-between;">
                                            <span style="font-size: 20px;">{{$favorite->product->name}}</span>
                                            <button class="btn btn-light" style="background: transparent; width: 40px;" onclick="toggleFavorite({{ $favorite->product->id }}, this)">
                                                <i class="fas fa-heart" style="color: red;"></i>
                                            </button>
                                        </div>
                                        <div>₱{{$favorite->product->price}} per kilogram</div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </section>
        </main> 
    </div>
@endsection