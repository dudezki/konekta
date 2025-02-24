@extends('layout')
@section('title', 'Home')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <<div class="d-flex align-items-center justify-content-start" style="position: absolute; top: 50%; left: 10%; transform: translateY(-50%); width: auto;">
    <div class="content text-left">
        <h1 style="font-size: 90px;">Lorem Ipsum</h1>
        <p style="font-size: 20px;">Lorem ipsum dolor sit amet, consectetur <br>
        adipiscing elit, sed do eiusmod tempor incididunt <br>
        ut labore et dolore magna aliqua. Ut enim ad <br>   
        minim veniam, quis nostrud exercitation ullamco <br>
        laboris nisi ut aliquip ex ea commodo consequat. </p>
        <div>
            <a class="btn btn-primary" href="{{route('merchant_registration')}}">List Your Products</a>
            <a class="btn btn-primary" href="{{route('user_registration')}}">Buy Products</a>
        </div>
    </div>
    <div class="text-center" style="float: right; flex: 0;">
        <img src="{{ asset('images/cart.svg') }}" style="margin-left: 150px; width: 650px; height: 650px;">
    </div>
    </div>
    <div class="container" style="margin-top: 50%;">
        <main class="container">
         <section>
            <div class="row">
                <h2 style="text-align: center;">Products</h2>
                @foreach($products as $product)
                <div class="mt-5 col-12 col-md-6 col-lg-3">
                    <div class="card p-2 shadow-sm mb-5">
                        <a href="{{route("products.details", $product->slug)}}" style="text-decoration: none; color: inherit;">
                            <img src="{{ asset('images/' . $product->image) }}" width="290px" height="300px">
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <span style="font-size: 20px;">{{$product->name}}</span>
                            </div>
                            <div>₱{{$product->price}} per kilogram</div>
                        </a>
                        <button class="btn btn-light" style="background: transparent; width: 40px;" onclick="toggleFavorite({{ $product->id }}, this)">
                            <i class="{{ in_array($product->id, $favorites) ? 'fas' : 'far' }} fa-heart" style="color: {{ in_array($product->id, $favorites) ? 'red' : 'black' }};"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
         </section>
    </main> 
    </div>

    <script>
        function toggleFavorite(productId, button) {
            fetch(`/favorites/toggle/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                const icon = button.querySelector('i');
                if (data.status === 'added') {
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    icon.style.color = 'red';
                } else {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    icon.style.color = 'black';
                }
            });
        }
    </script>
@endsection