@extends('layouts.app')

@section('title', 'CherishStyle — Sneakers Uzbekistonda')

@section('content')

{{-- Hero Section --}}
<section class="bg-gray-100 py-24 lg:py-40">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-light text-gray-900 tracking-tight leading-tight mb-6">
            Yangi Kolleksiya
        </h1>
        <p class="text-base text-gray-500 mb-10">
            Erkaklar va ayollar uchun zamonaviy krossovkalar
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4">
            <a href="{{ route('category.men') }}"
                class="inline-flex items-center gap-2 bg-gray-900 text-white font-medium text-sm px-8 py-3.5 rounded-sm hover:bg-gray-800 transition-colors">
                Erkaklar
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a href="{{ route('category.women') }}"
                class="inline-flex items-center gap-2 bg-white border border-gray-300 text-gray-700 font-medium text-sm px-8 py-3.5 rounded-sm hover:bg-gray-50 transition-colors">
                Ayollar
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

{{-- Featured Products --}}
@if($featuredProducts->count())
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <h2 class="text-xl font-semibold text-gray-900">Tavsiya etilgan</h2>
            <a href="{{ route('category.men') }}" class="text-sm text-gray-500 hover:text-gray-900 transition-colors flex items-center gap-1">
                Batafsil
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- New Arrivals --}}
@if($newProducts->count())
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <h2 class="text-xl font-semibold text-gray-900">Yangi kelganlar</h2>
            <a href="{{ route('category.new') }}" class="text-sm text-gray-500 hover:text-gray-900 transition-colors flex items-center gap-1">
                Batafsil
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($newProducts as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Categories Banner --}}
<section class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Men --}}
            <a href="{{ route('category.men') }}" class="group relative overflow-hidden bg-gray-900 h-56 flex items-center justify-center">
                <img src="https://picsum.photos/seed/men-cat/700/400"
                     alt="Erkaklar"
                     class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-50 group-hover:scale-105 transition-all duration-500">
                <span class="relative z-10 text-white text-2xl font-medium tracking-wide">Erkaklar</span>
            </a>

            {{-- Women --}}
            <a href="{{ route('category.women') }}" class="group relative overflow-hidden bg-gray-800 h-56 flex items-center justify-center">
                <img src="https://picsum.photos/seed/women-cat/700/400"
                     alt="Ayollar"
                     class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-50 group-hover:scale-105 transition-all duration-500">
                <span class="relative z-10 text-white text-2xl font-medium tracking-wide">Ayollar</span>
            </a>
        </div>
    </div>
</section>

@endsection
