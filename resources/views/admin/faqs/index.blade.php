@extends('layouts.admin')
@section('title', 'FAQ')
@section('page_title', 'FAQ Boshqaruvi')
@section('admin_content')

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    {{-- Add form --}}
    <div class="bg-white border border-gray-100 rounded-2xl p-6">
        <h2 class="font-bold text-gray-900 text-sm mb-4">Yangi savol-javob qo'shish</h2>
        <form action="{{ route('admin.faqs.store') }}" method="POST" class="space-y-3">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Savol *</label>
                <textarea name="question" rows="2" required
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 resize-none">{{ old('question') }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Javob *</label>
                <textarea name="answer" rows="4" required
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 resize-none">{{ old('answer') }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Tartib raqami</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                    class="w-24 px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
            </div>
            <button type="submit" class="w-full py-2.5 bg-violet-600 text-white font-semibold rounded-xl hover:bg-violet-700 transition-colors text-sm">Qo'shish</button>
        </form>
    </div>

    {{-- FAQ list --}}
    <div class="space-y-3">
        @forelse($faqs as $faq)
        <div class="bg-white border border-gray-100 rounded-2xl p-4" x-data="{ editing: false }">
            <div x-show="!editing">
                <div class="flex items-start justify-between gap-2 mb-2">
                    <p class="text-sm font-semibold text-gray-900">{{ $faq->question }}</p>
                    <div class="flex gap-1 shrink-0">
                        <button @click="editing = true" class="p-1.5 text-gray-400 hover:text-violet-600 rounded-lg hover:bg-violet-50 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </button>
                        <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('O\'chirasizmi?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-1.5 text-gray-400 hover:text-red-500 rounded-lg hover:bg-red-50 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
                <p class="text-xs text-gray-500 leading-relaxed">{{ Str::limit($faq->answer, 100) }}</p>
            </div>
            <div x-show="editing">
                <form action="{{ route('admin.faqs.update', $faq) }}" method="POST" class="space-y-2">
                    @csrf @method('PUT')
                    <textarea name="question" rows="2" class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 resize-none">{{ $faq->question }}</textarea>
                    <textarea name="answer" rows="3" class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 resize-none">{{ $faq->answer }}</textarea>
                    <div class="flex gap-2">
                        <button type="submit" class="px-3 py-1.5 bg-violet-600 text-white text-xs font-semibold rounded-lg hover:bg-violet-700">Saqlash</button>
                        <button type="button" @click="editing = false" class="px-3 py-1.5 border border-gray-200 text-gray-700 text-xs font-medium rounded-lg hover:bg-gray-50">Bekor</button>
                    </div>
                </form>
            </div>
        </div>
        @empty
            <div class="text-center py-8 text-sm text-gray-500 bg-white border border-gray-100 rounded-2xl">FAQ'lar yo'q.</div>
        @endforelse
    </div>
</div>
@endsection
