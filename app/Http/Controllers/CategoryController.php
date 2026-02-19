<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(string $type = 'all')
    {
        $query = Product::with(['primaryImage', 'images', 'sizes', 'category']);

        if ($type !== 'all') {
            $query->whereHas('category', fn($q) => $q->where('type', $type));
        }

        if ($type === 'new') {
            $query->where('is_new', true);
        }

        if ($type === 'sale') {
            $query->whereNotNull('sale_price');
        }

        $products = $query->latest()->paginate(12);

        $title = match($type) {
            'men'   => 'Erkaklar',
            'women' => 'Ayollar',
            'new'   => 'Yangi mahsulotlar',
            'sale'  => 'Aksiya',
            default => 'Barcha mahsulotlar',
        };

        return view('categories.index', compact('products', 'type', 'title'));
    }

    public function men()
    {
        return $this->index('men');
    }

    public function women()
    {
        return $this->index('women');
    }

    public function newArrivals()
    {
        return $this->index('new');
    }

    public function sale()
    {
        return $this->index('sale');
    }
}
