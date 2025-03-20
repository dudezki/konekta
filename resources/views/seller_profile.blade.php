@extends('layout')
@section('title', 'Seller Profile')
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
    
    body {
        font-family: 'Montserrat', sans-serif;
        margin: 0;
        padding: 0;
        background-color: white;
    }
    h3 {
        background-image: url('{{ asset("images/farmer.jpg") }}');
        background-size: cover; /* Ensures the image covers the full area */
        background-position: center; /* Centers the image */
        background-repeat: no-repeat; /* Prevents image repetition */
        width: 450px;
        height: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white; /* Adjust text color for better readability */
        text-align: center;
        font-size: 3rem;
        padding: 20px;
        font-family: 'Montserrat-Black', sans-serif;
    }
    .profile-container {
        width: 100%;
        margin: 0;
        padding: 0;
        position: relative;
    }
    .banner-photo {
        width: 100%;
        height: 400px;
        object-fit: cover;
        position: relative;
    }
    .profile-content {
        width: 90%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        position: relative;
        z-index: 2;
        display: flex;
        gap: 2rem;
        justify-content: center;
    }
    .profile-left {
        flex: 0 0 300px;
        margin-top: -100px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .profile-right {
        flex: 1;
        padding-top: 2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .profile-picture-container {
        text-align: center;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .profile-picture {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        border: 5px solid white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        object-fit: cover;
        margin-bottom: 1.5rem;
    }
    .profile-info {
        text-align: center;
        width: 100%;
    }
    .farmer-name {
        font-size: 2.5rem;
        margin: 0;
        color: #333;
        font-family: 'Montserrat-Black', sans-serif;
    }
    .rating {
        display: flex;
        align-items: center;
        gap: 5px;
        margin: 0.5rem 0;
        justify-content: center;
    }
    .rating-value {
        font-weight: bold;
        color: #333;
        font-size: 24px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .rating-count {
        color: #666;
        font-size: 16px;
    }
    .rate-text {
        font-size: 14px;
        color: #666;
        margin-top: 0.5rem;
    }
    .section-title {
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 1.5rem;
        font-family: 'Montserrat-Black';
        text-align: left;
        width: 100%;
    }
    .product-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
        margin-top: 1rem;
        width: 100%;
        justify-items: center;
    }
    .card {
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(16, 153, 8, 0.3);
        width: 250px;
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
    .favorite-btn {
        background: none;
        border: none;
        color: #ff4757;
        cursor: pointer;
        padding: 0;
        font-size: 1.5rem;
    }
    .profile-divider {
        width: 100%;
        max-width: 1300px;
        margin: 3rem auto;
        border: none;
        border-top: 1px solid rgba(16, 153, 8, 0.65);
    }
    .more-products {
        width: 90%;
        max-width: 1200px;
        margin-left: 75px;
        padding: 15px;
    }
    .more-products-header {
        display: flex;
        align-items: center;
        gap: 2rem;
        margin-bottom: 2rem;
    }
    .shop-more-text {
        text-align: center;
        font-size: 3.5rem;
        color: #000;
        font-family: 'Montserrat-Black', sans-serif;
        line-height: 1.2;
        margin: 0;
    }
    .more-products-title {
        margin-left: 19rem;
        font-size: 1.5rem;
        color: #000;
        margin-bottom: 2rem;
        font-family: 'Montserrat-Black', sans-serif;
    }

    /* Profile rating styles */
    .profile-info .rating-value {
        font-weight: bold;
        color: #333;
        font-size: 24px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .profile-info .rating-count {
        color: #666;
        font-size: 16px;
    }

    /* Card rating styles */
    .card-content .rating {
        display: flex;
        align-items: center;
        gap: 5px;
        margin: 0;
        justify-content: flex-start;
    }
    .card-content .rating-value {
        font-weight: bold;
        color: #333;
        font-size: 16px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .card-content .rating-count {
        color: #666;
        font-size: 14px;
    }

    /* Keep profile rating centered */
    .profile-info .rating {
        justify-content: center;
    }
</style>

<div class="profile-container">
    <img src="{{ $merchant->banner_photo ?? asset('images/bg photo.jpg') }}" alt="Banner" class="banner-photo">
    
    <div class="profile-content">
        <div class="profile-left">
            <div class="profile-picture-container">
                <img src="{{ $merchant->profile_picture ?? asset('images/prof pic.jpg') }}" alt="Profile Picture" class="profile-picture">
                <div class="profile-info">
                    <h1 class="farmer-name">{{ $merchant->business_name }}</h1>
                    <div class="rating">
                        <span class="rating-value">
                            <i class="fa-solid fa-star" style="color:rgb(0, 0, 0), 0);"></i>
                            {{ $averageRating }}
                        </span>
                        <span class="rating-count">({{ $totalReviews }} reviews)</span>
                    </div>
                    <div class="rate-text">Based on product reviews</div>
                </div>
            </div>
        </div>

        <div class="profile-right">
            <h2 class="section-title">Top Products</h2>
            <div class="product-grid">
                @foreach($topProducts as $product)
                <div class="card">
                    <a href="{{route('products.details', $product->slug)}}" style="text-decoration: none; color: inherit;">
                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                        <div class="card-content">
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <span class="product-name">{{ $product->name }}</span>
                            </div>
                            <div class="price-container">
                                <p class="price">₱{{ $product->price }}</p>
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
                @endforeach
            </div>
        </div>
    </div>
    <hr class="profile-divider">
    <div class="more-products">
        <h2 class="more-products-title">More Products</h2>
        <div class="more-products-header">
            <h3 class="shop-more-text">Shop<br>more<br>from<br>this<br>farmer.</h3>
            <div class="product-grid">
                @foreach($moreProducts as $product)
                <div class="card">
                    <a href="{{route('products.details', $product->slug)}}" style="text-decoration: none; color: inherit;">
                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                        <div class="card-content">
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <span class="product-name">{{ $product->name }}</span>
                            </div>
                            <div class="price-container">
                                <p class="price">₱{{ $product->price }}</p>
                                <span class="unit">per kilogram</span>
                            </div>
                            <div class="rating-card">
                                @php
                                    $rating = $product->reviews->avg('rating') ?? 0;
                                    $rating = number_format($rating, 1);
                                @endphp
                                <span class="rating-value-card">
                                    <i class="fa-solid fa-star"></i>
                                    {{ $rating }}
                                </span>
                                <span class="rating-count-card">({{ $product->reviews->count() }} reviews)</span>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection