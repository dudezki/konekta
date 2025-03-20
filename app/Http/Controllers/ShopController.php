<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Products::query();

        // Handle search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        // Handle category filter
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // Get all products with pagination
        $products = $query->simplePaginate(16);
        
        // Get categories for the filter
        $categories = Products::getCategories();

        return view('shop', compact('products', 'categories'));
    }

    public function shop(Request $request)
    {
        $query = Products::query();
        
        // Handle category filter
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        $products = $query->paginate(10);
        $categories = Products::getCategories();

        return view('shop', compact('products', 'categories'));
    }
} 