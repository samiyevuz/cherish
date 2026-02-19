<?php

namespace App\Providers;

use App\Models\Product;
use App\Policies\ProductPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Gate::policy(Product::class, ProductPolicy::class);

        // Share cart count with all views
        View::composer('*', function ($view) {
            if (auth()->check()) {
                $cartCount = 0;
                $cart = auth()->user()->cart;
                if ($cart) {
                    $cartCount = $cart->items()->sum('quantity');
                }
                $view->with('cartCount', $cartCount);
            } else {
                $view->with('cartCount', 0);
            }
        });
    }
}
