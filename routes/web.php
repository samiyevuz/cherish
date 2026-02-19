<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderTrackingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeGuideController;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

// ─── Auth Routes ─────────────────────────────────────────────────────────────
require __DIR__ . '/auth.php';

// ─── Public Frontend Routes ───────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/erkaklar', [CategoryController::class, 'men'])->name('category.men');
Route::get('/ayollar', [CategoryController::class, 'women'])->name('category.women');
Route::get('/yangi', [CategoryController::class, 'newArrivals'])->name('category.new');
Route::get('/aksiya', [CategoryController::class, 'sale'])->name('category.sale');

Route::get('/mahsulot/{slug}', [ProductController::class, 'show'])->name('product.show');

Route::get('/kuzatish', [OrderTrackingController::class, 'index'])->name('order.track');
Route::post('/kuzatish', [OrderTrackingController::class, 'search'])->name('order.track.search');

Route::get('/biz-haqimizda', fn() => view('pages.about'))->name('about');
Route::get('/aloqa', [ContactController::class, 'index'])->name('contact');
Route::post('/aloqa', [ContactController::class, 'store'])->name('contact.store');
Route::get('/savol-javob', [FaqController::class, 'index'])->name('faq');
Route::get('/olcham-jadvali', [SizeGuideController::class, 'index'])->name('size-guide');

// ─── Authenticated User Routes ────────────────────────────────────────────────
Route::middleware(['auth'])->group(function () {
    // Cart
    Route::get('/savat', [CartController::class, 'index'])->name('cart.index');
    Route::post('/savat/qoshish', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/savat/yangilash/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/savat/ochirish/{item}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/savat/tozalash', [CartController::class, 'clear'])->name('cart.clear');

    // Checkout
    Route::get('/buyurtma', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/buyurtma', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/buyurtma/muvaffaqiyat', [CheckoutController::class, 'success'])->name('checkout.success');

    // Account
    Route::prefix('kabinet')->name('account.')->group(function () {
        Route::get('/', [AccountController::class, 'dashboard'])->name('dashboard');
        Route::get('/buyurtmalar', [AccountController::class, 'orders'])->name('orders');
        Route::get('/buyurtmalar/{id}', [AccountController::class, 'orderShow'])->name('order.show');
        Route::get('/istaklar', [AccountController::class, 'wishlist'])->name('wishlist');
        Route::post('/istaklar/toggle', [AccountController::class, 'toggleWishlist'])->name('wishlist.toggle');
        Route::get('/sozlamalar', [AccountController::class, 'settings'])->name('settings');
        Route::post('/sozlamalar', [AccountController::class, 'updateSettings'])->name('settings.update');
    });
});

// ─── Admin Routes ─────────────────────────────────────────────────────────────
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

        // Products
        Route::resource('products', Admin\ProductController::class);
        Route::post('products/{product}/images/{image}/primary', [Admin\ProductController::class, 'setPrimaryImage'])->name('products.images.primary');
        Route::delete('products/images/{image}', [Admin\ProductController::class, 'deleteImage'])->name('products.images.delete');

        // Categories
        Route::resource('categories', Admin\CategoryController::class);

        // Orders
        Route::get('orders', [Admin\OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [Admin\OrderController::class, 'show'])->name('orders.show');
        Route::patch('orders/{order}/status', [Admin\OrderController::class, 'updateStatus'])->name('orders.status');

        // Users
        Route::get('users', [Admin\UserController::class, 'index'])->name('users.index');
        Route::get('users/{user}', [Admin\UserController::class, 'show'])->name('users.show');
        Route::post('users/{user}/toggle-role', [Admin\UserController::class, 'toggleRole'])->name('users.toggle-role');

        // FAQs
        Route::get('faqs', [Admin\FaqController::class, 'index'])->name('faqs.index');
        Route::post('faqs', [Admin\FaqController::class, 'store'])->name('faqs.store');
        Route::put('faqs/{faq}', [Admin\FaqController::class, 'update'])->name('faqs.update');
        Route::delete('faqs/{faq}', [Admin\FaqController::class, 'destroy'])->name('faqs.destroy');

        // Contacts
        Route::get('contacts', [Admin\ContactController::class, 'index'])->name('contacts.index');
        Route::get('contacts/{contact}', [Admin\ContactController::class, 'show'])->name('contacts.show');
        Route::delete('contacts/{contact}', [Admin\ContactController::class, 'destroy'])->name('contacts.destroy');

        // Size Guides
        Route::get('size-guides', [Admin\SizeGuideController::class, 'index'])->name('size-guides.index');
        Route::post('size-guides', [Admin\SizeGuideController::class, 'store'])->name('size-guides.store');
        Route::delete('size-guides/{sizeGuide}', [Admin\SizeGuideController::class, 'destroy'])->name('size-guides.destroy');
    });
