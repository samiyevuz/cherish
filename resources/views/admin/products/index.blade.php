@extends('layouts.admin')
@section('title', 'Mahsulotlar')
@section('page_title', 'Mahsulotlar')
@section('admin_content')

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <form method="GET" class="flex gap-2 flex-1 max-w-md">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Qidirish..."
            class="flex-1 px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
        <select name="category" class="px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
            <option value="">Barcha kategoriyalar</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="px-4 py-2.5 bg-gray-900 text-white rounded-xl text-sm font-medium hover:bg-gray-800 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </button>
    </form>
    <a href="{{ route('admin.products.create') }}"
        class="flex items-center gap-2 px-4 py-2.5 bg-violet-600 text-white rounded-xl text-sm font-semibold hover:bg-violet-700 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Yangi mahsulot
    </a>
</div>

<div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
    @if($products->count())
    <table class="w-full">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Mahsulot</th>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider hidden md:table-cell">Kategoriya</th>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Narx</th>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider hidden sm:table-cell">Status</th>
                <th class="px-5 py-3.5 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Amallar</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($products as $product)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ $product->primary_image_url }}" alt="{{ $product->name }}"
                            class="w-10 h-10 rounded-xl object-cover bg-gray-100 shrink-0">
                        <div>
                            <p class="text-sm font-semibold text-gray-900">{{ $product->name }}</p>
                            <p class="text-xs text-gray-500">#{{ $product->id }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-5 py-4 hidden md:table-cell">
                    <span class="text-xs text-gray-600 bg-gray-100 px-2 py-0.5 rounded-full">{{ $product->category?->name ?? '—' }}</span>
                </td>
                <td class="px-5 py-4">
                    <div>
                        <p class="text-sm font-bold text-gray-900">{{ number_format($product->current_price, 0, '.', ' ') }}</p>
                        @if($product->sale_price)
                            <p class="text-xs text-gray-400 line-through">{{ number_format($product->price, 0, '.', ' ') }}</p>
                        @endif
                    </div>
                </td>
                <td class="px-5 py-4 hidden sm:table-cell">
                    <div class="flex flex-wrap gap-1">
                        @if($product->is_new)
                            <span class="text-xs bg-violet-100 text-violet-700 px-2 py-0.5 rounded-full font-medium">Yangi</span>
                        @endif
                        @if($product->is_featured)
                            <span class="text-xs bg-amber-100 text-amber-700 px-2 py-0.5 rounded-full font-medium">Tavsiya</span>
                        @endif
                        @if($product->sale_price)
                            <span class="text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-medium">Aksiya</span>
                        @endif
                    </div>
                </td>
                <td class="px-5 py-4">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('product.show', $product->slug) }}" target="_blank"
                            class="p-1.5 text-gray-400 hover:text-blue-600 rounded-lg hover:bg-blue-50 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </a>
                        <a href="{{ route('admin.products.edit', $product) }}"
                            class="p-1.5 text-gray-400 hover:text-violet-600 rounded-lg hover:bg-violet-50 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                            onsubmit="return confirm('O\'chirishni tasdiqlaysizmi?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-1.5 text-gray-400 hover:text-red-500 rounded-lg hover:bg-red-50 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-5 border-t border-gray-100">
        {{ $products->links('partials.pagination') }}
    </div>
    @else
        <div class="p-12 text-center">
            <p class="text-gray-500 text-sm">Mahsulotlar topilmadi.</p>
            <a href="{{ route('admin.products.create') }}" class="mt-3 inline-flex items-center gap-1.5 text-sm font-semibold text-violet-600 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Yangi mahsulot qo'shish
            </a>
        </div>
    @endif
</div>
@endsection
