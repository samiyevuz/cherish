<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show(string $slug)
    {
        $product = Product::with(['images', 'sizes', 'category'])
            ->where('slug', $slug)
            ->firstOrFail();

        $related = Product::with(['primaryImage', 'images', 'sizes'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        $inWishlist = false;
        if (auth()->check()) {
            $inWishlist = auth()->user()->wishlists()
                ->where('product_id', $product->id)
                ->exists();
        }

        return view('products.show', compact('product', 'related', 'inWishlist'));
    }
}
