@extends('layouts.admin')
@section('title', 'Yangi mahsulot')
@section('page_title', 'Yangi mahsulot qo\'shish')
@section('admin_content')

<div class="max-w-3xl">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="bg-white border border-gray-100 rounded-2xl p-6 space-y-4">
            <h2 class="font-bold text-gray-900 text-sm border-b border-gray-100 pb-3">Asosiy ma'lumotlar</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Nomi <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 @error('name') border-red-400 @enderror"
                        oninput="autoSlug(this.value)">
                    @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Slug <span class="text-red-500">*</span></label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}" required
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 @error('slug') border-red-400 @enderror">
                    @error('slug')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Kategoriya</label>
                    <select name="category_id" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                        <option value="">— Tanlang —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div></div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Narx (so'm) <span class="text-red-500">*</span></label>
                    <input type="number" name="price" value="{{ old('price') }}" min="0" step="1000" required
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 @error('price') border-red-400 @enderror">
                    @error('price')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Aksiya narxi (ixtiyoriy)</label>
                    <input type="number" name="sale_price" value="{{ old('sale_price') }}" min="0" step="1000"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 @error('sale_price') border-red-400 @enderror">
                    @error('sale_price')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Tavsif</label>
                    <textarea name="description" rows="4"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 resize-none">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="flex flex-wrap gap-4 pt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_new" value="1" {{ old('is_new') ? 'checked' : '' }} class="rounded border-gray-300">
                    <span class="text-sm text-gray-700">Yangi mahsulot</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="rounded border-gray-300">
                    <span class="text-sm text-gray-700">Tavsiya etilgan</span>
                </label>
            </div>
        </div>

        {{-- Images --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h2 class="font-bold text-gray-900 text-sm border-b border-gray-100 pb-3 mb-4">Rasmlar</h2>
            <input type="file" name="images[]" multiple accept="image/*"
                class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 cursor-pointer">
            <p class="text-xs text-gray-500 mt-2">Birinchi rasm asosiy rasm sifatida saqlanadi. Maksimal 5MB.</p>
        </div>

        {{-- Sizes --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-6" x-data="{ sizes: [{ size: '', stock: 0 }] }">
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
                        <button type="button" @click="sizes.splice(i, 1)" x-show="sizes.length > 1"
                            class="p-1.5 text-gray-400 hover:text-red-500 rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </template>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="px-6 py-3 bg-violet-600 text-white font-semibold rounded-xl hover:bg-violet-700 transition-colors text-sm">
                Saqlash
            </button>
            <a href="{{ route('admin.products.index') }}" class="px-6 py-3 border border-gray-200 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition-colors text-sm">
                Bekor qilish
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script>
function autoSlug(name) {
    document.getElementById('slug').value = name
        .toLowerCase()
        .replace(/[^\w\s-]/g, '')
        .replace(/[\s_]+/g, '-')
        .replace(/^-+|-+$/g, '');
}
</script>
@endpush
@endsection
