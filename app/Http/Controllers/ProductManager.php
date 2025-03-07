<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Products;
use App\Models\Favorite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductManager extends Controller
{

    public function details($slug) {
        $product = Products::with(['merchant', 'reviews.user'])->where('slug', $slug)->first();
        return view('details', compact('product'));
    }

    public function showCart(){
        $cartItems = DB::table("cart")
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->select(
                "cart.product_id",
                DB::raw("SUM(cart.quantity) as quantity"),
                "products.name",
                "products.price",
                "products.image",
                "products.slug"
            )
            ->where("cart.user_id", Auth::user()->id)
            ->groupBy("cart.product_id", "products.name", "products.price", "products.image", "products.slug")
            ->get();

        return view('cart', compact('cartItems'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Products::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Not enough stock available.');
        }

        $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $id)->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
        } else {
            $cartItem = new Cart();
            $cartItem->user_id = Auth::id();
            $cartItem->product_id = $id;
            $cartItem->quantity = $request->quantity;
        }

        $cartItem->save();

        // Decrease the stock
        $product->stock -= $request->quantity;
        $product->save();

        return redirect()->back()->with('success', 'Product added to cart.');
    }

    public function toggleFavorite(Request $request, $id)
    {
        $product = Products::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found.'], 404);
        }

        $favorite = Favorite::where('user_id', Auth::id())->where('product_id', $id)->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Favorite::create([
                'user_id' => Auth::id(),
                'product_id' => $id
            ]);
            return response()->json(['status' => 'added']);
        }
    }

    public function showFavorites()
    {
        $favorites = Favorite::where('user_id', Auth::id())->with('product')->get();
        return view('favorites', compact('favorites'));
    }

    public function index()
    {
        $products = Products::all();
        $favorites = Favorite::where('user_id', Auth::id())->pluck('product_id')->toArray();
        return view('welcome', compact('products', 'favorites'));
    }
}