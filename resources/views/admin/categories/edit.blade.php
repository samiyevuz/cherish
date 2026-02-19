@extends('layouts.admin')
@section('title', 'Kategoriyani tahrirlash')
@section('page_title', 'Kategoriyani tahrirlash')
@section('admin_content')

<div class="max-w-lg">
    <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf @method('PUT')
        <div class="bg-white border border-gray-100 rounded-2xl p-6 space-y-4">
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Nomi *</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Slug *</label>
                <input type="text" name="slug" value="{{ old('slug', $category->slug) }}" required
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Turi *</label>
                <select name="type" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                    @foreach(['men' => 'Erkaklar', 'women' => 'Ayollar', 'new' => 'Yangi', 'sale' => 'Aksiya'] as $val => $label)
                        <option value="{{ $val }}" {{ old('type', $category->type) === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            @if($category->image_path)
            <div>
                <p class="text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wider">Joriy rasm</p>
                <img src="{{ asset('storage/' . $category->image_path) }}" class="w-20 h-20 rounded-xl object-cover">
            </div>
            @endif
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Yangi rasm</label>
                <input type="file" name="image" accept="image/*"
                    class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700">
            </div>
        </div>
        <div class="flex items-center gap-3">
            <button type="submit" class="px-6 py-3 bg-violet-600 text-white font-semibold rounded-xl hover:bg-violet-700 transition-colors text-sm">Yangilash</button>
            <a href="{{ route('admin.categories.index') }}" class="px-6 py-3 border border-gray-200 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition-colors text-sm">Bekor qilish</a>
        </div>
    </form>
</div>
@endsection
