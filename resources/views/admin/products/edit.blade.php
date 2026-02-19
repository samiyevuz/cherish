@extends('layouts.admin')
@section('title', 'Mahsulotni tahrirlash')
@section('page_title', 'Mahsulotni tahrirlash: ' . $product->name)
@section('admin_content')

<div class="max-w-3xl">
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')

        <div class="bg-white border border-gray-100 rounded-2xl p-6 space-y-4">
            <h2 class="font-bold text-gray-900 text-sm border-b border-gray-100 pb-3">Asosiy ma'lumotlar</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Nomi *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 @error('name') border-red-400 @enderror">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Slug *</label>
                    <input type="text" name="slug" value="{{ old('slug', $product->slug) }}" required
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 @error('slug') border-red-400 @enderror">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Kategoriya</label>
                    <select name="category_id" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                        <option value="">— Tanlang —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div></div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Narx *</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" min="0" step="1000" required
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 @error('price') border-red-400 @enderror">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Aksiya narxi</label>
                    <input type="number" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" min="0" step="1000"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Tavsif</label>
                    <textarea name="description" rows="4"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 resize-none">{{ old('description', $product->description) }}</textarea>
                </div>
            </div>
            <div class="flex flex-wrap gap-4 pt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_new" value="1" {{ old('is_new', $product->is_new) ? 'checked' : '' }} class="rounded border-gray-300">
                    <span class="text-sm text-gray-700">Yangi mahsulot</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="rounded border-gray-300">
                    <span class="text-sm text-gray-700">Tavsiya etilgan</span>
                </label>
            </div>
        </div>

        {{-- Existing Images --}}
        @if($product->images->count())
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h2 class="font-bold text-gray-900 text-sm border-b border-gray-100 pb-3 mb-4">Mavjud rasmlar</h2>
            <div class="flex flex-wrap gap-3">
                @foreach($product->images as $image)
                <div class="relative group">
                    <img src="{{ $image->url }}" alt="" class="w-20 h-20 rounded-xl object-cover border-2 {{ $image->is_primary ? 'border-violet-500' : 'border-gray-200' }}">
                    @if($image->is_primary)
                        <span class="absolute -top-1.5 -right-1.5 bg-violet-500 text-white text-xs px-1 py-0.5 rounded-full font-bold">A</span>
                    @endif
                    <div class="absolute inset-0 bg-black/50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-1">
                        @if(!$image->is_primary)
                        <form action="{{ route('admin.products.images.primary', [$product, $image]) }}" method="POST">
                            @csrf
                            <button type="submit" class="p-1 bg-white/20 rounded text-white hover:bg-white/40 transition-colors" title="Asosiy">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </button>
                        </form>
                        @endif
                        <form action="{{ route('admin.products.images.delete', $image) }}" method="POST" onsubmit="return confirm('Rasmni o\'chirasizmi?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-1 bg-red-500/80 rounded text-white hover:bg-red-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- New Images --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h2 class="font-bold text-gray-900 text-sm border-b border-gray-100 pb-3 mb-4">Yangi rasmlar qo'shish</h2>
            <input type="file" name="images[]" multiple accept="image/*"
                class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100">
        </div>

        {{-- Sizes --}}
        @php $existingSizes = $product->sizes->map(fn($s) => ['size' => $s->size, 'stock' => $s->stock])->toJson(); @endphp
        <div class="bg-white border border-gray-100 rounded-2xl p-6"
            x-data="{ sizes: {{ $existingSizes }} }">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3 mb-4">
                <h2 class="font-bold text-gray-900 text-sm">O'lchamlar va zaxira</h2>
                <button type="button" @click="sizes.push({ size: '', stock: 0 })"
                    class="flex items-center gap-1 text-xs font-semibold text-violet-600 hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Qo'shish
                </button>
            </div>
            <div class="space-y-3">
                <template x-for="(s, i) in sizes" :key="i">
                    <div class="flex items-center gap-3">
                        <input type="text" :name="`sizes[${i}][size]`" x-model="s.size" placeholder="EU 40"
                            class="w-28 px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                        <input type="number" :name="`sizes[${i}][stock]`" x-model="s.stock" min="0" placeholder="Zaxira"
                            class="w-24 px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                        <button type="button" @click="sizes.splice(i, 1)"
                            class="p-1.5 text-gray-400 hover:text-red-500 rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </template>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="px-6 py-3 bg-violet-600 text-white font-semibold rounded-xl hover:bg-violet-700 transition-colors text-sm">
                Yangilash
            </button>
            <a href="{{ route('admin.products.index') }}" class="px-6 py-3 border border-gray-200 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition-colors text-sm">
                Bekor qilish
            </a>
        </div>
    </form>
</div>
@endsection
