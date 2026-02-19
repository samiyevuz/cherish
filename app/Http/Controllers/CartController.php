<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->getOrCreateCart();
        $cart->load('items.product.images');
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'size'       => ['required', 'string'],
            'quantity'   => ['required', 'integer', 'min:1'],
        ]);

        $productSize = ProductSize::where('product_id', $request->product_id)
            ->where('size', $request->size)
            ->first();

        if (!$productSize || $productSize->stock < $request->quantity) {
            return back()->with('error', 'Kechirasiz, bu o\'lcham uchun yetarli miqdor yo\'q.');
        }

        $cart = $this->getOrCreateCart();

        $item = $cart->items()
            ->where('product_id', $request->product_id)
            ->where('size', $request->size)
            ->first();

        if ($item) {
            $newQty = $item->quantity + $request->quantity;
            if ($productSize->stock < $newQty) {
                return back()->with('error', 'Yetarli miqdor yo\'q.');
            }
            $item->update(['quantity' => $newQty]);
        } else {
            $cart->items()->create([
                'product_id' => $request->product_id,
                'size'       => $request->size,
                'quantity'   => $request->quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Savatga qo\'shildi!');
    }

    public function update(Request $request, CartItem $item)
    {
        $this->authorizeCartItem($item);

        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $productSize = ProductSize::where('product_id', $item->product_id)
            ->where('size', $item->size)
            ->first();

        if ($productSize && $productSize->stock < $request->quantity) {
            return back()->with('error', 'Yetarli miqdor yo\'q.');
        }

        $item->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Yangilandi.');
    }

    public function remove(CartItem $item)
    {
        $this->authorizeCartItem($item);
        $item->delete();
        return back()->with('success', 'Mahsulot o\'chirildi.');
    }

    public function clear()
    {
        $cart = auth()->user()->cart;
        if ($cart) {
            $cart->items()->delete();
        }
        return back()->with('success', 'Savat tozalandi.');
    }

    private function getOrCreateCart(): Cart
    {
        return auth()->user()->cart ?? Cart::create(['user_id' => auth()->id()]);
    }

    private function authorizeCartItem(CartItem $item): void
    {
        $cart = auth()->user()->cart;
        if (!$cart || $item->cart_id !== $cart->id) {
            abort(403);
        }
    }
}
