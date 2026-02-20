@extends('layouts.app')

@section('title', 'CherishStyle — Sneakers')

@section('content')

{{-- Hero Section --}}
<section class="bg-gray-100 py-32 lg:py-48 xl:py-56">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-6xl sm:text-7xl lg:text-8xl xl:text-9xl font-light text-gray-900 tracking-tight leading-tight mb-8">
            {{ __('app.home_hero_title') }}
        </h1>
        <p class="text-lg sm:text-xl text-gray-500 mb-12">
            {{ __('app.home_hero_sub') }}
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4">
            <a href="{{ route('category.men') }}"
                class="inline-flex items-center gap-2 bg-gray-900 text-white font-medium text-base px-10 py-4 rounded-sm hover:bg-gray-800 transition-colors">
                {{ __('app.home_men_btn') }}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a href="{{ route('category.women') }}"
                class="inline-flex items-center gap-2 bg-white border border-gray-300 text-gray-700 font-medium text-base px-10 py-4 rounded-sm hover:bg-gray-50 transition-colors">
                {{ __('app.home_women_btn') }}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

{{-- Recommended Products (Tavsiya etilgan) --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <h2 class="text-xl font-semibold text-gray-900">{{ __('app.home_featured') }}</h2>
            <a href="{{ route('category.men') }}" class="text-sm text-gray-900 hover:text-gray-700 transition-colors flex items-center gap-1">
                {{ __('app.home_view_all') }}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        @if($featuredProducts->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                @foreach($featuredProducts->take(4) as $product)
                    @include('partials.product-card', ['product' => $product])
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500">{{ __('app.cat_no_products') }}</p>
            </div>
        @endif
    </div>
</section>

{{-- Categories Banner --}}
<section class="py-10 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
            <a href="{{ route('category.men') }}" class="group relative overflow-hidden bg-gray-900 h-64 md:h-80 flex items-center justify-center">
                <img src="https://picsum.photos/seed/men-cat/700/400"
                     alt="{{ __('app.home_men_cat') }}"
                     class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-50 group-hover:scale-105 transition-all duration-500">
                <span class="relative z-10 text-white text-2xl md:text-3xl font-medium tracking-wide">{{ __('app.home_men_cat') }}</span>
            </a>
            <a href="{{ route('category.women') }}" class="group relative overflow-hidden bg-gray-800 h-64 md:h-80 flex items-center justify-center">
                <img src="https://picsum.photos/seed/women-cat/700/400"
                     alt="{{ __('app.home_women_cat') }}"
                     class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-50 group-hover:scale-105 transition-all duration-500">
                <span class="relative z-10 text-white text-2xl md:text-3xl font-medium tracking-wide">{{ __('app.home_women_cat') }}</span>
            </a>
        </div>
    </div>
</section>

@endsection
