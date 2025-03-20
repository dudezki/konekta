@extends('layout')
@section('title', 'Cart')
@section('content')
    <style>
        @font-face {
            font-family: 'Montserrat-Black';
            src: url('{{ asset('fonts/Montserrat-Black.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Montserrat';
            src: url('{{ asset('fonts/Montserrat-Regular.ttf') }}') format('truetype');
        }
        
        h2{
            font-family: 'Montserrat-Black';
        }

        h4{
            font-family: 'Montserrat-Black';
            margin-top: 20px !important;
        }

        h5{
            font-family: 'Montserrat-Black';
        }

        .table-responsive{
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(16, 153, 8, 0.3);
            margin-bottom: 100px;
        }

        table{
            border: none;
        }

        table td, table th {
            border: none;
        }

        thead{
            font-family: 'Montserrat-Black';
        }
        
        .card {
            border: none;
        }
        
        .card-body {
            border: none;
            box-shadow: none;
        }

        .price, .tprice{
            font-family: 'Montserrat-Black';
        }

        .btn{
            width: 230px;
            height: 75px;
            font-family: 'Montserrat-Black';
            font-size: 30px;
            border-radius: 10px;
            background-color: #109908;
            color: white;
            padding: 15px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <div class="container" style="margin-top: 120px;">
        <main class="container">
            <h2>Cart</h2>
            @if(!$cartItems->isEmpty())
                <h4>{{ $cartItems->count() }} {{ Str::plural('Item', $cartItems->count()) }} in your cart.</h4>
            @endif

            <section class="mt-4">
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
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Products</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cartItems as $cart)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="images/{{$cart->image}}" alt="{{$cart->name}}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                                                        <div class="ms-3">
                                                            <h5><a href="{{route('products.details', $cart->slug)}}" class="text-decoration-none text-dark">{{$cart->name}}</a></h5>
                                                            <p class="mb-0">1kg</p>
                                                            <small class="text-success">• In Stock ({{$cart->stock}} pcs)</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="price">₱{{number_format($cart->price, 2)}}</td>
                                                <td>{{$cart->quantity}}</td>
                                                <td class="tprice">₱{{number_format($cart->price * $cart->quantity, 2)}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            <div class="row justify-content-end mt-4">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5>Sub Total: ₱{{number_format($cartItems->sum(function($item) { 
                                                return $item->price * $item->quantity;
                                            }), 2)}}</h5>
                                            <p class="text-muted small">Excl. Tax and Delivery charge</p>
                                            <a href="{{route('checkout.show')}}" class="btn">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        </main> 
    </div>
@endsection