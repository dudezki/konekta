@extends('layout')
@section('title', 'Home')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <div class="d-flex align-items-center" style="position: absolute; top: 10%; margin-left: 8%;">
        <div class="content" style="flex: 1;">
            <h1 style="font-size: 90px;">Lorem Ipsum</h1>
            <p style="font-size: 20px;">Lorem ipsum dolor sit amet, consectetur <br>
            adipiscing elit, sed do eiusmod tempor incididunt <br>
            ut labore et dolore magna aliqua. Ut enim ad <br>   
            minim veniam, quis nostrud exercitation ullamco <br>
            laboris nisi ut aliquip ex ea commodo consequat. </p>
            <div>
                <button class="btn btn-primary" style="color: black; border: 2px solid black; background: transparent; border-radius: 20px; width: 150px; height: 40px; font-size: 15px;">Shop Now</button>
            </div>
        </div>
        <div style="float: right; flex: 0;">
            <img src="images/cart.svg" style="margin-left: 150px; width: 650px; height: 650px;">
        </div>
    </div>
    <div class="container" style="margin-top: 50%;">
        <main class="container">
         <section>
            <div class="row">
                <h2 style="text-align: center;">Products</h2>
                @foreach($products as $product)
                <div class="mt-5 col-12 col-md-6 col-lg-3">
                    <a href="{{route("products.details", $product->slug)}}" style="text-decoration: none; color: inherit;">
                        <div class="card p-2 shadow-sm mb-5">
                            <img src="images/{{$product->image}}" width="300px">
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <span style="font-size: 20px;">{{$product->name}}</span>
                                <button class="btn btn-light" style="background: transparent; width: 40px;" onclick="toggleHeart(this)">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                            <div>₱{{$product->price}} per kilogram</div>
                            <script>
                                function toggleHeart(button) {
                                    const icon = button.querySelector('i');
                                    icon.classList.toggle('far');
                                    icon.classList.toggle('fas');
                                    icon.style.color = icon.classList.contains('fas') ? 'red' : 'black';
                                }
                            </script>
                        </div>
                    </a>
                </div>
                @endforeach
                <div>
                    {{$products->links()}}
                </div>
         </section>
    </main> 
    </div>
@endsection