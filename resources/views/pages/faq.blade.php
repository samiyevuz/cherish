@extends('layouts.app')
@section('title', 'Savol-javob — CherishStyle')
@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-12">
        <span class="text-xs font-bold uppercase tracking-widest text-violet-600 mb-3 block">FAQ</span>
        <h1 class="text-3xl sm:text-4xl font-black text-gray-900 mb-4">Ko'p so'raladigan savollar</h1>
        <p class="text-gray-500 text-base">Quyida eng ko'p beriladigan savollarga javoblarni topa olasiz.</p>
    </div>

    @if($faqs->count())
        <div class="space-y-3">
            @foreach($faqs as $faq)
            <div x-data="{ open: false }" class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between p-5 text-left hover:bg-gray-50 transition-colors">
                    <span class="font-semibold text-gray-900 text-sm pr-4">{{ $faq->question }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        :class="open ? 'rotate-180' : ''"
                        class="h-4 w-4 text-gray-500 shrink-0 transition-transform duration-200"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" x-transition class="px-5 pb-5">
                    <div class="border-t border-gray-100 pt-4 text-sm text-gray-600 leading-relaxed">
                        {{ $faq->answer }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-10 text-gray-500 text-sm">Hali FAQ'lar qo'shilmagan.</div>
    @endif

    <div class="mt-10 bg-violet-50 border border-violet-100 rounded-2xl p-6 text-center">
        <p class="font-semibold text-gray-900 mb-1 text-sm">Savolingizga javob topa olmadingizmi?</p>
        <p class="text-xs text-gray-500 mb-4">Biz bilan to'g'ridan-to'g'ri bog'laning.</p>
        <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 bg-gray-900 text-white font-medium px-5 py-2.5 rounded-xl text-sm hover:bg-gray-800 transition-colors">
            Aloqaga chiqish
        </a>
    </div>
</div>
@endsection
