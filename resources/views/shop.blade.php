@extends('layout')
@section('title', 'Shop')
@section('content')
    <style>
        .card{
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

        .pagination-container {
            position: relative;
            min-height: 200px;
        }

        .pagination {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .pagination nav {
            width: 100%;
            display: flex;
            justify-content: center;
            box-shadow: none !important;
            background: none !important;
        }

        .pagination ul {
            display: flex;
            justify-content: center;
            padding: 0;
            margin: 0;
        }

        .container {
            padding: 20px 0;
            margin-top: 100px !important;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
        }

        .browse-and-filters {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .browse-text {
            font-family: 'Montserrat-Black', sans-serif;
            font-size: 32px;
            color: #109908;
            margin: 0;
        }

        .filter-container {
            display: flex;
            gap: 10px;
            margin: 0;
            align-items: center;
        }

        .filter-divider {
            width: 2px;
            height: 35px;
            background-color: #109908;
            margin: 0 5px;
        }

        .search-bar {
            display: flex;
            align-items: center;
            position: relative;
            margin-top: 40px;
        }

        .search-bar input {
            height: 70px;
            width: 666px;
            background-color: #109908;
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 24px;
            padding-left: 40px;
            font-family: 'Montserrat-Black', sans-serif;
        }

        .search-bar i {
            position: absolute;
            left: 15px;
            color: white;
            font-size: 24px;
        }

        .search-bar input::placeholder {
            font-family: 'Montserrat-Black', sans-serif;
            font-size: 24px;
            color: white;
        }

        .filter-btn {
            padding: 8px 20px;
            border-radius: 10px;
            font-family: 'Montserrat-Black', sans-serif;
            font-size: 20px;
            cursor: pointer;
            border: none;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 100px;
            background-color: #109908;
            color: white;
        }

        .filter-btn:hover{
            background-color: white;
            color: #109908;
            border: 3px solid black;
        }

        .fav-btn {
            padding: 8px 20px;
            border-radius: 10px;
            font-family: 'Montserrat-Black', sans-serif;
            font-size: 20px;
            cursor: pointer;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 100px;
            background-color: white;
            border: 1px solid #ddd;
            color: black;
        }

        .fav-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

    </style>

    <div class="container mt-5">
        <div class="header-container">
            <div class="browse-and-filters">
                <h2 class="browse-text">
                    @if(request('search'))
                        Search result for '{{ request('search') }}'
                    @elseif(request('category'))
                        {{ ucfirst(request('category')) }}s
                    @else
                        Browse products
                    @endif
                </h2>
                <div class="filter-container">
                    <button class="filter-btn">
                        Filters
                    </button>
                    <div class="filter-divider"></div>
                    <button class="fav-btn disabled" title="No highly rated products available yet">
                        Favorites
                    </button>
                </div>
            </div>
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <form action="{{ route('shop') }}" method="GET">
                    <input type="text" name="search" placeholder="Search for products" value="{{ request('search') }}">
                </form>
            </div>
        </div>

        <div class="row justify-content-center g-4">
            @if($products->isEmpty())
                <div class="text-center">
                    <h3>No products found</h3>
                </div>
            @else
                @foreach($products as $product)
                <div class="col-12 col-md-6 col-lg-3 d-flex justify-content-center">
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
            @endif
        </div>
        <div class="pagination-container">
            <div class="pagination">
                {{ $products->appends(request()->only(['category', 'search']))->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
@endsection
