@extends('layouts.app')

@section('title', 'Savat — CherishStyle')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-8">
        <a href="{{ route('home') }}" class="hover:text-gray-900 transition-colors">Bosh sahifa</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-900 font-medium">Savat</span>
    </nav>

    <h1 class="text-2xl sm:text-3xl font-black text-gray-900 mb-8">Mening savatim</h1>

    @if($cart->items->count())
    <div class="grid lg:grid-cols-3 gap-8">

        {{-- Cart Items --}}
        <div class="lg:col-span-2 space-y-4">
            @foreach($cart->items as $item)
            <div class="bg-white border border-gray-100 rounded-2xl p-5 flex gap-4">
                {{-- Product image --}}
                <a href="{{ route('product.show', $item->product->slug) }}"
                    class="w-24 h-24 sm:w-28 sm:h-28 rounded-xl overflow-hidden bg-gray-50 shrink-0">
                    <img src="{{ $item->product->primary_image_url }}" alt="{{ $item->product->name }}"
                        class="w-full h-full object-cover">
                </a>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <a href="{{ route('product.show', $item->product->slug) }}"
                                class="font-semibold text-gray-900 hover:text-violet-600 transition-colors text-sm sm:text-base line-clamp-2">
                                {{ $item->product->name }}
                            </a>
                            <p class="text-xs text-gray-500 mt-1">O'lcham: <span class="font-semibold text-gray-700">{{ $item->size }}</span></p>
                        </div>
                        {{-- Remove --}}
                        <form action="{{ route('cart.remove', $item) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-1.5 text-gray-400 hover:text-red-500 transition-colors rounded-lg hover:bg-red-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </form>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        {{-- Quantity --}}
                        <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center border border-gray-200 rounded-lg overflow-hidden">
                            @csrf @method('PATCH')
                            <button type="submit" name="quantity" value="{{ max(1, $item->quantity - 1) }}"
                                class="w-9 h-9 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                            </button>
                            <span class="w-10 text-center text-sm font-semibold text-gray-900">{{ $item->quantity }}</span>
                            <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}"
                                class="w-9 h-9 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            </button>
                        </form>

                        {{-- Price --}}
                        <div class="text-right">
                            <p class="font-bold text-gray-900 text-sm sm:text-base">{{ number_format($item->subtotal, 0, '.', ' ') }} so'm</p>
                            @if($item->product->sale_price)
                                <p class="text-xs text-gray-400">{{ number_format($item->product->sale_price, 0, '.', ' ') }} × {{ $item->quantity }}</p>
                            @else
                                <p class="text-xs text-gray-400">{{ number_format($item->product->price, 0, '.', ' ') }} × {{ $item->quantity }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- Clear cart --}}
            <div class="flex justify-end">
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-sm text-gray-500 hover:text-red-500 transition-colors flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Savatni tozalash
                    </button>
                </form>
            </div>
        </div>

        {{-- Order Summary --}}
        <div class="lg:col-span-1">
            <div class="bg-white border border-gray-100 rounded-2xl p-6 sticky top-24">
                <h2 class="text-lg font-bold text-gray-900 mb-5">Buyurtma xulosasi</h2>

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between text-gray-600">
                        <span>Mahsulotlar ({{ $cart->count }} ta)</span>
                        <span class="font-medium text-gray-900">{{ number_format($cart->total, 0, '.', ' ') }} so'm</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Yetkazib berish</span>
                        <span class="font-medium text-gray-900">30 000 so'm</span>
                    </div>
                    <div class="border-t border-gray-100 pt-3 flex justify-between">
                        <span class="font-bold text-gray-900">Jami</span>
                        <span class="font-black text-lg text-gray-900">{{ number_format($cart->total + 30000, 0, '.', ' ') }} so'm</span>
                    </div>
                </div>

                <a href="{{ route('checkout.index') }}"
                    class="mt-6 w-full flex items-center justify-center gap-2 bg-gray-900 text-white font-semibold py-3.5 rounded-xl hover:bg-gray-800 transition-all hover:shadow-lg text-sm">
                    Buyurtma berish
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>

                <a href="{{ route('home') }}" class="mt-3 w-full flex items-center justify-center gap-2 border border-gray-200 text-gray-700 font-medium py-3 rounded-xl hover:bg-gray-50 transition-all text-sm">
                    Xaridni davom ettirish
                </a>

                {{-- Promo features --}}
                <div class="mt-5 space-y-2 text-xs text-gray-500">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Xavfsiz to'lov tizimi
                    </div>
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        1-3 kun ichida yetkazib berish
                    </div>
                </div>
            </div>
        </div>
    </div>

    @else
        {{-- Empty cart --}}
        <div class="text-center py-20">
            <div class="w-20 h-20 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-900 mb-2">Savatingiz bo'sh</h2>
            <p class="text-gray-500 text-sm mb-6">Xarid qilishni boshlash uchun mahsulotlar qo'shing.</p>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-gray-900 text-white font-semibold px-6 py-3 rounded-xl hover:bg-gray-800 transition-all text-sm">
                Xarid qilish
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    @endif
</div>
@endsection
