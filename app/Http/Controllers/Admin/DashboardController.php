<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_orders'   => Order::count(),
            'total_users'    => User::where('role', 'customer')->count(),
            'total_revenue'  => Order::whereIn('status', ['delivered'])->sum('total_price'),
            'new_orders'     => Order::where('status', 'accepted')->count(),
            'new_messages'   => Contact::where('is_read', false)->count(),
        ];

        $recentOrders = Order::with('user')->latest()->take(10)->get();
        $topProducts  = Product::withCount('wishlists')->orderByDesc('wishlists_count')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'topProducts'));
    }
}
