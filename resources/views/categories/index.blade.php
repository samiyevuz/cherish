@extends('layouts.app')

@section('title', $title . ' — CherishStyle')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-8">
        <a href="{{ route('home') }}" class="hover:text-gray-900 transition-colors">{{ __('app.breadcrumb_home') }}</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-900 font-medium">{{ $title }}</span>
    </nav>

    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-gray-900">{{ $title }}</h1>
            <p class="text-gray-500 text-sm mt-1">{{ __('app.cat_products_found', ['count' => $products->total()]) }}</p>
        </div>

        {{-- Filter Tabs --}}
        <div class="flex items-center gap-1.5 bg-gray-100 p-1 rounded-xl">
            <a href="{{ route('category.men') }}"
                class="px-4 py-1.5 rounded-lg text-sm font-medium transition-all {{ $type === 'men' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                {{ __('app.cat_men') }}
            </a>
            <a href="{{ route('category.women') }}"
                class="px-4 py-1.5 rounded-lg text-sm font-medium transition-all {{ $type === 'women' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                {{ __('app.cat_women') }}
            </a>
            <a href="{{ route('category.new') }}"
                class="px-4 py-1.5 rounded-lg text-sm font-medium transition-all {{ $type === 'new' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                {{ __('app.cat_new') }}
            </a>
            <a href="{{ route('category.sale') }}"
                class="px-4 py-1.5 rounded-lg text-sm font-medium transition-all {{ $type === 'sale' ? 'bg-white text-red-600 shadow-sm' : 'text-red-500 hover:text-red-600' }}">
                {{ __('app.cat_sale') }}
            </a>
        </div>
    </div>

    @if($products->count())
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
            @foreach($products as $product)
                @include('partials.product-card', ['product' => $product, 'showButtonAlways' => true])
            @endforeach
        </div>

        @if($products->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $products->links('partials.pagination') }}
            </div>
        @endif
    @else
        <div class="text-center py-24">
            <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('app.cat_no_products') }}</h3>
            <p class="text-gray-500 text-sm">{{ __('app.cat_no_products_desc') }}</p>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mt-5 bg-gray-900 text-white px-5 py-2.5 rounded-xl text-sm font-medium hover:bg-gray-800 transition-colors">
                {{ __('app.back_to_home') }}
            </a>
        </div>
    @endif
</div>
@endsection
