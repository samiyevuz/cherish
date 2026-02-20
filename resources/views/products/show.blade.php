@extends('layouts.app')

@section('title', $product->name . ' — CherishStyle')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" x-data="{
    selectedSize: null,
    quantity: 1,
    activeImage: '{{ $product->primary_image_url }}',
    canAddToCart: false,
    selectSize(size) {
        this.selectedSize = size;
        this.canAddToCart = true;
    }
}">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-8">
        <a href="{{ route('home') }}" class="hover:text-gray-900 transition-colors">{{ __('app.breadcrumb_home') }}</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        @if($product->category)
            <a href="{{ $product->category->type === 'men' ? route('category.men') : route('category.women') }}" class="hover:text-gray-900 transition-colors">{{ $product->category->name }}</a>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        @endif
        <span class="text-gray-900 font-medium line-clamp-1">{{ $product->name }}</span>
    </nav>

    <div class="grid lg:grid-cols-2 gap-10 xl:gap-16">

        {{-- Left: Images --}}
        <div class="space-y-4">
            <div class="aspect-square rounded-2xl overflow-hidden bg-gray-50 border border-gray-100">
                <img :src="activeImage" alt="{{ $product->name }}" class="w-full h-full object-cover">
            </div>
            @if($product->images->count() > 1)
                <div class="flex gap-3 overflow-x-auto pb-1">
                    @foreach($product->images as $image)
                        <button
                            @click="activeImage = '{{ $image->url }}'"
                            :class="activeImage === '{{ $image->url }}' ? 'border-gray-900 ring-2 ring-gray-900' : 'border-gray-200 hover:border-gray-400'"
                            class="shrink-0 w-20 h-20 rounded-xl overflow-hidden border-2 transition-all">
                            <img src="{{ $image->url }}" alt="" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Right: Product info --}}
        <div class="space-y-6">
            {{-- Badges --}}
            <div class="flex flex-wrap gap-2">
                @if($product->is_new)
                    <span class="inline-block bg-violet-100 text-violet-700 text-xs font-bold px-3 py-1 rounded-full">{{ __('app.badge_new') }}</span>
                @endif
                @if($product->sale_price)
                    <span class="inline-block bg-red-100 text-red-600 text-xs font-bold px-3 py-1 rounded-full">
                        -{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}% {{ __('app.badge_discount') }}
                    </span>
                @endif
                @if($product->category)
                    <span class="inline-block bg-gray-100 text-gray-600 text-xs font-medium px-3 py-1 rounded-full">{{ $product->category->name }}</span>
                @endif
            </div>

            <h1 class="text-2xl sm:text-3xl font-black text-gray-900 leading-tight">{{ $product->name }}</h1>

            {{-- Price --}}
            <div class="flex items-center gap-3">
                @if($product->sale_price)
                    <span class="text-3xl font-black text-gray-900">{{ number_format($product->sale_price, 0, '.', ' ') }} <span class="text-lg font-semibold text-gray-500">{{ __('app.currency') }}</span></span>
                    <span class="text-lg text-gray-400 line-through">{{ number_format($product->price, 0, '.', ' ') }} {{ __('app.currency') }}</span>
                @else
                    <span class="text-3xl font-black text-gray-900">{{ number_format($product->price, 0, '.', ' ') }} <span class="text-lg font-semibold text-gray-500">{{ __('app.currency') }}</span></span>
                @endif
            </div>

            <div class="border-t border-gray-100 pt-5">

                {{-- Size selector --}}
                <div class="mb-5">
                    <div class="flex items-center justify-between mb-3">
                        <label class="text-sm font-semibold text-gray-900">
                            {{ __('app.product_select_size') }}
                            <span class="text-red-500">*</span>
                        </label>
                        <a href="{{ route('size-guide') }}" class="text-xs text-violet-600 hover:underline flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 11h.01M12 11h.01M15 11h.01M12 7h.01M15 7h.01M9 14h.01M12 14h.01M15 14h.01M3 8l7-5 4 3 4-3 3 2v11a1 1 0 01-1 1H4a1 1 0 01-1-1V8z"/></svg>
                            {{ __('app.product_size_guide') }}
                        </a>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        @forelse($product->sizes as $size)
                            @if($size->stock > 0)
                                <button
                                    @click="selectSize('{{ $size->size }}')"
                                    :class="selectedSize === '{{ $size->size }}' ? 'border-gray-900 bg-gray-900 text-white' : 'border-gray-200 text-gray-700 hover:border-gray-900'"
                                    class="w-12 h-12 rounded-xl border-2 text-sm font-semibold transition-all">
                                    {{ $size->size }}
                                </button>
                            @else
                                <button disabled class="w-12 h-12 rounded-xl border-2 border-gray-100 text-sm font-semibold text-gray-300 relative overflow-hidden cursor-not-allowed">
                                    {{ $size->size }}
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="w-full h-px bg-gray-300 rotate-45 absolute"></div>
                                    </div>
                                </button>
                            @endif
                        @empty
                            <p class="text-sm text-gray-500">{{ __('app.product_no_sizes') }}</p>
                        @endforelse
                    </div>

                    <p x-show="!selectedSize" class="text-xs text-red-500 mt-2">{{ __('app.product_size_not_selected') }}</p>
                </div>

                {{-- Quantity + Add to cart --}}
                @auth
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="size" :value="selectedSize">

                    <div class="flex gap-3 mb-4">
                        <div class="flex items-center border border-gray-200 rounded-xl overflow-hidden">
                            <button type="button" @click="quantity = Math.max(1, quantity - 1)"
                                class="w-11 h-12 flex items-center justify-center text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                            </button>
                            <input type="number" name="quantity" :value="quantity" min="1"
                                class="w-14 h-12 text-center text-sm font-semibold text-gray-900 border-x border-gray-200 bg-white focus:outline-none">
                            <button type="button" @click="quantity++"
                                class="w-11 h-12 flex items-center justify-center text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            </button>
                        </div>

                        <button
                            type="submit"
                            :disabled="!canAddToCart"
                            :class="canAddToCart ? 'bg-gray-900 hover:bg-gray-800 cursor-pointer' : 'bg-gray-300 cursor-not-allowed'"
                            class="flex-1 flex items-center justify-center gap-2 text-white font-semibold py-3 px-6 rounded-xl transition-all text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            {{ __('app.product_add_to_cart') }}
                        </button>
                    </div>

                    {{-- Wishlist button --}}
                    <form action="{{ route('account.wishlist.toggle') }}" method="POST" class="mt-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 border border-gray-200 text-gray-700 font-medium py-3 px-6 rounded-xl hover:border-gray-400 transition-all text-sm {{ $inWishlist ? 'bg-red-50 border-red-200 text-red-600' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="{{ $inWishlist ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            {{ $inWishlist ? __('app.product_rm_from_wishlist') : __('app.product_add_to_wishlist') }}
                        </button>
                    </form>
                </form>
                @else
                    <a href="{{ route('login') }}"
                        class="w-full flex items-center justify-center gap-2 bg-gray-900 text-white font-semibold py-3.5 px-6 rounded-xl hover:bg-gray-800 transition-all text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                        {{ __('app.product_login_to_buy') }}
                    </a>
                @endauth

                {{-- Delivery info --}}
                <div class="mt-5 bg-gray-50 rounded-2xl p-4 space-y-2.5">
                    <div class="flex items-center gap-3 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        <span class="text-gray-700">{{ __('app.product_delivery_days') }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        <span class="text-gray-700">{{ __('app.product_original') }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        <span class="text-gray-700">{{ __('app.product_return') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Description --}}
    @if($product->description)
    <div class="mt-12 pt-8 border-t border-gray-100">
        <h2 class="text-xl font-bold text-gray-900 mb-4">{{ __('app.product_about') }}</h2>
        <div class="prose prose-gray max-w-none text-sm leading-relaxed text-gray-600">
            {{ $product->description }}
        </div>
    </div>
    @endif

    {{-- Related Products --}}
    @if($related->count())
    <div class="mt-16">
        <h2 class="text-xl font-bold text-gray-900 mb-6">{{ __('app.product_related') }}</h2>
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
            @foreach($related as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection
