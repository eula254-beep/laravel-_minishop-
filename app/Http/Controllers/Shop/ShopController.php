<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of available products (Public Shop).
     * 
     * Shows only available products in a grid layout for customers.
     */
    public function index()
    {
        // Get all available products, latest first
        $products = Product::available()->latest()->paginate(12);
        
        return view('shop.index', compact('products'));
    }

    /**
     * Display the specified product details.
     * 
     * Shows full product information for customers to view before purchase.
     */
    public function show(Product $product)
    {
        // Optional: You could check if product is available here
        // But we'll allow viewing even unavailable products (shows "Out of Stock")
        
        return view('shop.show', compact('product'));
    }
}
