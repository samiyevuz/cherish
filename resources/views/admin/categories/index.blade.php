@extends('layouts.admin')
@section('title', 'Kategoriyalar')
@section('page_title', 'Kategoriyalar')
@section('admin_content')

<div class="flex justify-end mb-5">
    <a href="{{ route('admin.categories.create') }}"
        class="flex items-center gap-2 px-4 py-2.5 bg-violet-600 text-white rounded-xl text-sm font-semibold hover:bg-violet-700 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Yangi kategoriya
    </a>
</div>

<div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
    @if($categories->count())
    <table class="w-full">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nomi</th>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Turi</th>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Mahsulotlar</th>
                <th class="px-5 py-3.5 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Amallar</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($categories as $category)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-5 py-4">
                    <p class="text-sm font-semibold text-gray-900">{{ $category->name }}</p>
                    <p class="text-xs text-gray-500">{{ $category->slug }}</p>
                </td>
                <td class="px-5 py-4">
                    @php $typeColors = ['men'=>'bg-blue-50 text-blue-700','women'=>'bg-pink-50 text-pink-700','new'=>'bg-violet-50 text-violet-700','sale'=>'bg-red-50 text-red-600']; @endphp
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $typeColors[$category->type] ?? 'bg-gray-50 text-gray-600' }}">
                        {{ match($category->type) { 'men' => 'Erkaklar', 'women' => 'Ayollar', 'new' => 'Yangi', 'sale' => 'Aksiya', default => $category->type } }}
                    </span>
                </td>
                <td class="px-5 py-4">
                    <span class="text-sm font-semibold text-gray-900">{{ $category->products_count }}</span>
                    <span class="text-xs text-gray-500 ml-1">ta</span>
                </td>
                <td class="px-5 py-4">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.categories.edit', $category) }}"
                            class="p-1.5 text-gray-400 hover:text-violet-600 rounded-lg hover:bg-violet-50 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('O\'chirishni tasdiqlaysizmi?')">
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
    @else
        <div class="p-12 text-center text-sm text-gray-500">
            Kategoriyalar yo'q.
            <a href="{{ route('admin.categories.create') }}" class="font-semibold text-violet-600 hover:underline ml-1">Qo'shish →</a>
        </div>
    @endif
</div>
@endsection
