<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'primaryImage'])->latest();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products   = $query->paginate(15)->withQueryString();
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $data['is_new'] = $request->boolean('is_new');
        $data['is_featured'] = $request->boolean('is_featured');

        $product = Product::create($data);

        // Handle images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_primary' => $index === 0,
                ]);
            }
        }

        // Handle sizes
        if ($request->has('sizes')) {
            foreach ($request->sizes as $sizeData) {
                if (!empty($sizeData['size'])) {
                    ProductSize::create([
                        'product_id' => $product->id,
                        'size'       => $sizeData['size'],
                        'stock'      => $sizeData['stock'] ?? 0,
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Mahsulot qo\'shildi.');
    }

    public function edit(Product $product)
    {
        $product->load(['images', 'sizes', 'category']);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['is_new'] = $request->boolean('is_new');
        $data['is_featured'] = $request->boolean('is_featured');

        $product->update($data);

        // Handle new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_primary' => false,
                ]);
            }
        }

        // Update sizes
        if ($request->has('sizes')) {
            $product->sizes()->delete();
            foreach ($request->sizes as $sizeData) {
                if (!empty($sizeData['size'])) {
                    ProductSize::create([
                        'product_id' => $product->id,
                        'size'       => $sizeData['size'],
                        'stock'      => $sizeData['stock'] ?? 0,
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Mahsulot yangilandi.');
    }

    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Mahsulot o\'chirildi.');
    }

    public function setPrimaryImage(Request $request, ProductImage $image)
    {
        ProductImage::where('product_id', $image->product_id)->update(['is_primary' => false]);
        $image->update(['is_primary' => true]);
        return back()->with('success', 'Asosiy rasm o\'zgartirildi.');
    }

    public function deleteImage(ProductImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();
        return back()->with('success', 'Rasm o\'chirildi.');
    }
}
