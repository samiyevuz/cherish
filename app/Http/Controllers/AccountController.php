<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $recentOrders = $user->orders()->latest()->take(5)->get();
        $totalOrders = $user->orders()->count();
        $wishlistCount = $user->wishlists()->count();

        return view('account.dashboard', compact('user', 'recentOrders', 'totalOrders', 'wishlistCount'));
    }

    public function orders()
    {
        $orders = auth()->user()->orders()->with('items')->latest()->paginate(10);
        return view('account.orders', compact('orders'));
    }

    public function orderShow($id)
    {
        $order = auth()->user()->orders()->with('items.product.images')->findOrFail($id);
        return view('account.order-show', compact('order'));
    }

    public function wishlist()
    {
        $wishlists = auth()->user()->wishlists()->with('product.images')->paginate(12);
        return view('account.wishlist', compact('wishlists'));
    }

    public function toggleWishlist(Request $request)
    {
        $request->validate(['product_id' => ['required', 'exists:products,id']]);

        $user = auth()->user();
        $existing = $user->wishlists()->where('product_id', $request->product_id)->first();

        if ($existing) {
            $existing->delete();
            $added = false;
        } else {
            $user->wishlists()->create(['product_id' => $request->product_id]);
            $added = true;
        }

        if ($request->wantsJson()) {
            return response()->json(['added' => $added]);
        }

        return back()->with('success', $added ? 'Istaklar ro\'yxatiga qo\'shildi.' : 'Istaklar ro\'yxatidan o\'chirildi.');
    }

    public function settings()
    {
        return view('account.settings', ['user' => auth()->user()]);
    }

    public function updateSettings(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'city'  => ['nullable', 'string', 'max:100'],
        ]);

        $user->update($request->only('name', 'phone', 'city'));

        return back()->with('success', 'Ma\'lumotlar yangilandi.');
    }
}
