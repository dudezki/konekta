@extends('layout')
@section('title', 'Home')
@section('content')
    <style>
        @font-face {
            font-family: 'Montserrat';
            src: url('{{ asset("fonts/Montserrat-Regular.otf") }}') format('opentype');
        }

        @font-face {
            font-family: 'Montserrat-Black';
            src: url('{{ asset("fonts/Montserrat-Black.otf") }}') format('opentype');
        }

        body{
            font-family: 'Montserrat', sans-serif;
        }

        h1{
            font-family: 'Montserrat-Black', sans-serif;
            text-align: center;
        }

        p{
            font-family: 'Montserrat', sans-serif;
            text-align: center;
        }

        h2{
            font-family: 'Montserrat-Black', sans-serif;
            text-align: center;
        }
        
        .btn1 {
            background-color: #109908;
            padding: 15px 30px;
            border-radius: 10px;
            color: #fff;
            text-decoration: none;
            font-family: 'Montserrat-Black', sans-serif;
            font-size: 24px;
            display: inline-block;
            margin: 0 10px;
            transition: background-color 0.3s ease;
        }

        .btn1:hover {
            background-color: #0c7206;
            color: #fff;
            text-decoration: none;
        }

        .btn2 {
            background-color: #3498db;
            padding: 15px 30px;
            border-radius: 10px;
            color: #fff;
            text-decoration: none;
            font-family: 'Montserrat-Black', sans-serif;
            font-size: 24px;
            display: inline-block;
            margin: 0 10px;
            transition: background-color 0.3s ease;
        }

        .btn2:hover {
            background-color: #2980b9;
            color: #fff;
            text-decoration: none;
        }

        .or-text {
            display: block;
            text-align: center;
            font-size: 24px;
            margin: 20px 0;
            font-family: 'Montserrat-Bold', sans-serif;
        }

        .button-container {
            text-align: center;
            margin-top: 30px;
        }

        .img-LP {
            width: 715px;
            height: 475px;
            border-radius: 10px;
            margin-left: 50px;
        }

        .hero-section {
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            max-width: 1400px;
            padding: 0 20px;
        }

        .content {
            flex: 1;
        }

        .image-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card{
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(16, 153, 8, 0.3);
            width: 290px;
            height: 320px;
            overflow: hidden;
            border-radius: 10px;
            background-color: white;
            padding: 20px 20px 0px 20px;
        }

        .card:hover {
            background-color: #65E55E;
        }


        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
            margin: 0 auto;
            border-radius: 10px;
        }

        .card-content {
            padding: 0px;
            height: 120px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .product-name {
            font-size: 18px;
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            color: #333;
            line-height: 1.4;
            height: 25px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
        }

        .price-container {
            display: flex;
            align-items: baseline;
            margin: 0;
        }

        .price {
            font-size: 24px;
            font-family: 'Montserrat-Black', sans-serif;
            margin: 0;
            color: #333;
        }

        .unit {
            font-size: 12px;
            color: #666;
        }

        .rating {
            display: flex;
            align-items: center;
            gap: 5px;
            margin: 0;
        }

        .rating-value {
            font-weight: bold;
            color: #333;
            font-size: 16px;
        }

        .rating-count {
            color: #666;
            font-size: 14px;
        }

        /* Custom 5-column layout */
        @media (min-width: 992px) {
            .col-lg-2-4 {
                flex: 0 0 20%;
                max-width: 20%;
            }
        }
    </style>
    <div class="hero-section">z
        <div class="content">
            <h1 style="font-size: 64px;">Lorem ipsum dolor</h1>
            <p style="font-size: 40px;">Lorem ipsum dolor</p>
            <p style="font-size: 40px;">Lorem ipsum dolor</p>
            <div class="button-container">
                <a class="btn1" href="{{route('merchant_registration')}}">List Your Products</a>
                <div class="or-text">or</div>
                <a class="btn2" href="{{route('user_registration')}}">Shop Now</a>
            </div>
        </div>
        <div class="image-container">
            <img src="{{ asset('images/LP.jpg') }}" class="img-LP">
        </div>
    </div>
    <div class="container" style="margin-top: 50%;">
        <main class="container">
         <section>
            <div class="row justify-content-center g-4" style="margin-bottom: 100px;">
                <h2>Featured Products</h2>
                @foreach($products->take(10) as $product)
                <div class="mt-5 col-12 col-md-6 col-lg-2-4 d-flex justify-content-center">
                    <div class="card">
                        <a href="{{route("products.details", $product->slug)}}" style="text-decoration: none; color: inherit;">
                            <img src="{{ asset('images/' . $product->image) }}">
                            <div class="card-content">
                                <div style="display: flex; align-items: center; justify-content: space-between;">
                                    <span class="product-name">{{$product->name}}</span>
                                </div>
                                <div class="price-container">
                                    <p class="price">₱{{$product->price}}</p>
                                    <span class="unit">per kilogram</span>
                                </div>
                                <div class="rating">
                                    @php
                                        $rating = $product->reviews->avg('rating') ?? 0;
                                        $rating = number_format($rating, 1);
                                    @endphp
                                    <span class="rating-value">
                                        <i class="fa-solid fa-star"></i>
                                        {{ $rating }}
                                    </span>
                                    <span class="rating-count">({{ $product->reviews->count() }} reviews)</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
         </section>
    </main> 
    </div>
@endsection