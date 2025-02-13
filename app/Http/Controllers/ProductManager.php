<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductManager extends Controller
{
    function index() {
        $products = Products::paginate(8);
        return view('welcome', compact('products'));
    }

    function details($slug) {
        $product = Products::where('slug', $slug)->first();
        return view('details', compact('product'));
    }

    function addToCart($id){
        $cart = new Cart();
        $cart->user_id = Auth::user()->id;
        $cart->product_id = $id;
        if($cart->save()){
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        return redirect()->back()->with('error', 'Something went wrong!');  
    }

    function showCart(){
        $cartItems = DB::table("cart")->select("product_id", DB::raw("count(*) as quantity"))
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->select("cart.product_id", DB::raw("count(*) as quantity"), "products.name", "products.price", "products.image", "products.slug")
            ->where("cart.user_id", Auth::user()->id)
            ->groupBy("cart.product_id", "products.name", "products.price", "products.image", "products.slug")
            ->paginate(5);
            return view('cart', compact('cartItems'));
        
    }
}
