@extends('layouts.app')

@section('title', 'CherishStyle — Sneakers Uzbekistonda')

@section('content')

{{-- Hero Section --}}
<section class="relative bg-gray-50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-8 items-center min-h-[580px] py-12 lg:py-0">
            {{-- Text --}}
            <div class="space-y-6 lg:space-y-8">
                <div class="inline-flex items-center gap-2 bg-violet-50 border border-violet-200 text-violet-700 text-xs font-semibold uppercase tracking-widest px-3 py-1.5 rounded-full">
                    <span class="w-1.5 h-1.5 bg-violet-500 rounded-full"></span>
                    Yangi kolleksiya 2025
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-gray-900 leading-[1.1] tracking-tight">
                    Eng yaxshi<br>
                    <span class="text-violet-600">Sneakerlar</span><br>
                    siz uchun
                </h1>
                <p class="text-gray-500 text-lg leading-relaxed max-w-md">
                    Premium sifatli poyabzallar. Har bir qadam uchun to'g'ri tanlov. Yetkazib berish 1-3 kun ichida.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('category.new') }}"
                        class="inline-flex items-center gap-2 bg-gray-900 text-white font-semibold px-6 py-3.5 rounded-xl hover:bg-gray-800 transition-all hover:shadow-lg hover:-translate-y-0.5">
                        Yangi mahsulotlar
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a href="{{ route('category.sale') }}"
                        class="inline-flex items-center gap-2 border border-gray-200 text-gray-700 font-semibold px-6 py-3.5 rounded-xl hover:border-gray-300 hover:bg-gray-50 transition-all">
                        Aksiya
                        <span class="text-xs bg-red-500 text-white px-1.5 py-0.5 rounded-full font-bold">-30%</span>
                    </a>
                </div>

                {{-- Stats --}}
                <div class="flex gap-8 pt-2">
                    <div>
                        <p class="text-2xl font-black text-gray-900">500+</p>
                        <p class="text-xs text-gray-500 mt-0.5">Mahsulotlar</p>
                    </div>
                    <div class="border-l border-gray-200 pl-8">
                        <p class="text-2xl font-black text-gray-900">10K+</p>
                        <p class="text-xs text-gray-500 mt-0.5">Mijozlar</p>
                    </div>
                    <div class="border-l border-gray-200 pl-8">
                        <p class="text-2xl font-black text-gray-900">4.9★</p>
                        <p class="text-xs text-gray-500 mt-0.5">Reyting</p>
                    </div>
                </div>
            </div>

            {{-- Hero Image --}}
            <div class="relative lg:flex items-center justify-center hidden">
                <div class="relative w-full max-w-lg">
                    {{-- Background circle --}}
                    <div class="absolute inset-0 m-auto w-80 h-80 bg-violet-100 rounded-full blur-3xl opacity-60"></div>
                    {{-- Product image --}}
                    <img src="https://picsum.photos/seed/hero-sneaker/600/500"
                        alt="Featured Sneaker"
                        class="relative z-10 w-full object-contain drop-shadow-2xl rounded-2xl">
                    {{-- Floating badge 1 --}}
                    <div class="absolute top-10 -left-4 bg-white rounded-2xl shadow-xl p-3 flex items-center gap-3 z-20">
                        <div class="w-10 h-10 bg-violet-100 rounded-xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-900">Original</p>
                            <p class="text-xs text-gray-500">Kafolat bilan</p>
                        </div>
                    </div>
                    {{-- Floating badge 2 --}}
                    <div class="absolute bottom-10 -right-4 bg-white rounded-2xl shadow-xl p-3 flex items-center gap-3 z-20">
                        <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-900">Tez yetkazish</p>
                            <p class="text-xs text-gray-500">1-3 kun</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Features bar --}}
<section class="border-y border-gray-100 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach([
                ['icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4', 'title' => 'Bepul yetkazish', 'desc' => '500,000 so\'mdan'],
                ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'title' => 'Original mahsulot', 'desc' => '100% kafolat'],
                ['icon' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15', 'title' => '30 kun qaytarish', 'desc' => 'Muammo bo\'lmaydi'],
                ['icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z', 'title' => '24/7 qo\'llab-quvvatlash', 'desc' => 'Doimo yordamda'],
            ] as $feature)
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-gray-100 rounded-xl flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $feature['icon'] }}"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-900">{{ $feature['title'] }}</p>
                    <p class="text-xs text-gray-500">{{ $feature['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- New Arrivals --}}
@if($newProducts->count())
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-violet-600 mb-2 block">Yangiliklar</span>
                <h2 class="text-2xl sm:text-3xl font-black text-gray-900">Yangi mahsulotlar</h2>
            </div>
            <a href="{{ route('category.new') }}" class="text-sm font-semibold text-gray-900 hover:text-violet-600 transition-colors flex items-center gap-1">
                Barchasini ko'rish
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
            @foreach($newProducts as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Featured Products --}}
@if($featuredProducts->count())
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-violet-600 mb-2 block">Mashhur</span>
                <h2 class="text-2xl sm:text-3xl font-black text-gray-900">Tavsiya etilgan mahsulotlar</h2>
            </div>
            <a href="{{ route('category.men') }}" class="text-sm font-semibold text-gray-900 hover:text-violet-600 transition-colors flex items-center gap-1">
                Barchasini ko'rish
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
            @foreach($featuredProducts as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Categories Banner --}}
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Men --}}
            <a href="{{ route('category.men') }}" class="group relative overflow-hidden rounded-2xl bg-gray-900 h-64 flex items-end p-8">
                <img src="https://picsum.photos/seed/men-banner/600/300" alt="Erkaklar" class="absolute inset-0 w-full h-full object-cover opacity-50 group-hover:opacity-40 group-hover:scale-105 transition-all duration-500">
                <div class="relative z-10">
                    <span class="text-xs font-bold uppercase tracking-widest text-gray-300 mb-1 block">Kolleksiya</span>
                    <h3 class="text-2xl font-black text-white">Erkaklar</h3>
                    <span class="inline-flex items-center gap-1 mt-3 text-sm font-semibold text-white border border-white/30 px-4 py-1.5 rounded-full group-hover:bg-white group-hover:text-gray-900 transition-all">
                        Ko'rish
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </div>
            </a>

            {{-- Women --}}
            <a href="{{ route('category.women') }}" class="group relative overflow-hidden rounded-2xl bg-violet-900 h-64 flex items-end p-8">
                <img src="https://picsum.photos/seed/women-banner/600/300" alt="Ayollar" class="absolute inset-0 w-full h-full object-cover opacity-50 group-hover:opacity-40 group-hover:scale-105 transition-all duration-500">
                <div class="relative z-10">
                    <span class="text-xs font-bold uppercase tracking-widest text-violet-300 mb-1 block">Kolleksiya</span>
                    <h3 class="text-2xl font-black text-white">Ayollar</h3>
                    <span class="inline-flex items-center gap-1 mt-3 text-sm font-semibold text-white border border-white/30 px-4 py-1.5 rounded-full group-hover:bg-white group-hover:text-violet-900 transition-all">
                        Ko'rish
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </div>
            </a>
        </div>
    </div>
</section>

@endsection
