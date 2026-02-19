<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
    public function index()
    {
        return view('orders.track');
    }

    public function search(Request $request)
    {
        $request->validate([
            'order_number' => ['required', 'string'],
        ]);

        $order = Order::with('items.product.images')
            ->where('order_number', strtoupper($request->order_number))
            ->first();

        if (!$order) {
            return back()->with('error', 'Buyurtma topilmadi. Raqamni tekshiring.');
        }

        $statuses = ['accepted', 'packing', 'shipping', 'delivered'];
        $currentIndex = array_search($order->status, $statuses);

        return view('orders.track', compact('order', 'statuses', 'currentIndex'));
    }
}
