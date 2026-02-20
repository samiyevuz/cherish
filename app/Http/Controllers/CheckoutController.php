<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductSize;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart;

        if (!$cart || $cart->items()->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Savatcha bo\'sh.');
        }

        $cart->load('items.product.images');
        $deliveryPrice = 30000;

        return view('checkout.index', compact('cart', 'deliveryPrice'));
    }

    public function store(CheckoutRequest $request)
    {
        $user = auth()->user();
        $cart = $user->cart;

        if (!$cart || $cart->items()->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Savatcha bo\'sh.');
        }

        $cart->load('items.product');
        $deliveryPrice = 30000;
        $totalPrice = $cart->total + $deliveryPrice;

        DB::transaction(function () use ($request, $user, $cart, $totalPrice, $deliveryPrice) {
            $order = Order::create([
                'user_id'        => $user->id,
                'order_number'   => Order::generateOrderNumber(),
                'total_price'    => $totalPrice,
                'delivery_price' => $deliveryPrice,
                'full_name'      => $request->full_name,
                'phone'          => $request->phone,
                'city'           => $request->city,
                'address'        => $request->address,
                'payment_method'  => $request->payment_method,
                'delivery_method' => $request->delivery_method,
                'status'          => 'accepted',
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $item->product_id,
                    'product_name' => $item->product->name,
                    'size'         => $item->size,
                    'quantity'     => $item->quantity,
                    'price'        => $item->product->current_price,
                ]);

                // Reduce stock
                ProductSize::where('product_id', $item->product_id)
                    ->where('size', $item->size)
                    ->decrement('stock', $item->quantity);
            }

            // Clear cart
            $cart->items()->delete();

            session(['last_order_number' => $order->order_number]);
        });

        return redirect()->route('checkout.success');
    }

    public function success()
    {
        $orderNumber = session('last_order_number');
        if (!$orderNumber) {
            return redirect()->route('home');
        }
        return view('checkout.success', compact('orderNumber'));
    }
}
