<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with(['primaryImage', 'images', 'sizes'])
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();

        $newProducts = Product::with(['primaryImage', 'images', 'sizes'])
            ->where('is_new', true)
            ->latest()
            ->take(4)
            ->get();

        $categories = Category::withCount('products')->get();

        return view('home.index', compact('featuredProducts', 'newProducts', 'categories'));
    }
}
