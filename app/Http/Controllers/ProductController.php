<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Products::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('name', 'LIKE', "%{$searchTerm}%");
        }

        // Favorites filter is disabled for now since there are no reviews
        // When you have reviews, you can uncomment this:
        /*
        if ($request->has('favorites')) {
            $query->whereHas('reviews', function($q) {
                $q->selectRaw('AVG(rating) as avg_rating')
                  ->havingRaw('avg_rating >= ?', [4.0]); // Show products with 4+ stars
            });
        }
        */

        $products = $query->paginate(12);

        return view('shop', compact('products'));
    }
} 