@extends('layouts.admin')
@section('title', 'Yangi kategoriya')
@section('page_title', 'Yangi kategoriya')
@section('admin_content')

<div class="max-w-lg">
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        <div class="bg-white border border-gray-100 rounded-2xl p-6 space-y-4">
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Nomi *</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 @error('name') border-red-400 @enderror">
                @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Slug *</label>
                <input type="text" name="slug" value="{{ old('slug') }}" required
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 @error('slug') border-red-400 @enderror">
                @error('slug')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Turi *</label>
                <select name="type" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                    @foreach(['men' => 'Erkaklar', 'women' => 'Ayollar', 'new' => 'Yangi', 'sale' => 'Aksiya'] as $val => $label)
                        <option value="{{ $val }}" {{ old('type') === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Rasm (ixtiyoriy)</label>
                <input type="file" name="image" accept="image/*"
                    class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700">
            </div>
        </div>
        <div class="flex items-center gap-3">
            <button type="submit" class="px-6 py-3 bg-violet-600 text-white font-semibold rounded-xl hover:bg-violet-700 transition-colors text-sm">Saqlash</button>
            <a href="{{ route('admin.categories.index') }}" class="px-6 py-3 border border-gray-200 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition-colors text-sm">Bekor qilish</a>
        </div>
    </form>
</div>
@endsection
