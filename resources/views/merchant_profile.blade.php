@extends('layout')
@section('title', 'Seller Profile')
@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        text-align: center;
    }
    .profile-container {
        width: 80%;
        margin: auto;
        padding: 20px;
    }
    .seller-info {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        position: relative;
    }
    .seller-info img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
    }
    .seller-details {
        flex-grow: 1;
        margin-left: 20px;
        text-align: left;
    }
    .seller-actions {
        margin-top: 10px;
    }
    .seller-actions button {
        padding: 10px 15px;
        margin: 5px;
        border: none;
        border-radius: 20px;
        cursor: pointer;
        transition: 0.3s;
    }
    .seller-actions .follow-btn {
        background: black;
        color: white;
    }
    .seller-actions .follow-btn:hover {
        background: gray;
    }
    .seller-actions .chat-btn {
        background: white;
        border: 1px solid black;
    }
    .seller-actions .chat-btn:hover {
        background: black;
        color: white;
    }
    .seller-stats {
        margin-top: 15px;
        text-align: center;
        width: 100%;
    }
    .shop-section, .products-section {
        margin-top: 20px;
    }
    .shop-section a {
        text-decoration: none;
        color: black;
        margin: 0 10px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }
    .shop-section a:hover {
        color: red;
    }
    .product-grid {
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
    }
    .product {
        background: white;
        padding: 10px;
        border-radius: 15px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 150px;
        cursor: pointer;
        transition: 0.3s;
    }
    .product:hover {
        transform: scale(1.05);
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }
    .product img {
        width: 100px;
    }
</style>
<script>
    function followSeller() {
        alert("You have followed the seller!");
    }
    function chatNow() {
        alert("Chat feature coming soon!");
    }
    function navigateTo(section) {
        alert("Navigating to " + section);
    }
    function viewProduct(productName) {
        alert("Viewing details for " + productName);
    }
</script>
<div class="profile-container mt-5">
    <div class="seller-info">
        <img src="{{ $merchant->avatar }}" alt="Seller Avatar">
        <div class="seller-details">
            <h1>{{ $merchant->business_name }}</h1>
            <div class="seller-actions">
                <button class="follow-btn" onclick="followSeller()">Follow</button>
                <button class="chat-btn" onclick="chatNow()">Chat Now</button>
            </div>
        </div>
        <div class="seller-stats">
            <p>Ratings: ⭐ ⭐ ⭐ ⭐ ☆ | Response Rate: <span style="color: red;">{{ $merchant->response_rate }}%</span></p>
            <p>Products: <span style="color: red;">{{ $products->count() }}</span> | Followers: <span style="color: red;">{{ $merchant->followers }}</span></p>
        </div>
    </div>
    
    <div class="shop-section">
        <a href="#" onclick="navigateTo('Home')">mHome</a> |
        <a href="#" onclick="navigateTo('Products')">Products</a> |
        <a href="#" onclick="navigateTo('Category')">Category</a>
    </div>
    
    <div class="products-section">
        <div class="product-grid">
            @foreach($products as $product)
                <div class="product" onclick="viewProduct('{{ $product->name }}')">
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                    <p>{{ $product->name }}</p>
                    <p><b>P {{ $product->price }} /kl</b></p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection