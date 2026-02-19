@extends('layouts.app')
@section('title', "O'lcham jadvali — CherishStyle")
@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16" x-data="{ tab: 'men' }">
    <div class="text-center mb-12">
        <span class="text-xs font-bold uppercase tracking-widest text-violet-600 mb-3 block">Size Guide</span>
        <h1 class="text-3xl sm:text-4xl font-black text-gray-900 mb-4">O'lcham jadvali</h1>
        <p class="text-gray-500 text-base">To'g'ri o'lchamni tanlash uchun quyidagi jadvaldan foydalaning.</p>
    </div>

    {{-- Tabs --}}
    <div class="flex justify-center mb-8">
        <div class="inline-flex items-center bg-gray-100 p-1 rounded-xl">
            <button @click="tab = 'men'"
                :class="tab === 'men' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-600'"
                class="px-6 py-2 rounded-lg text-sm font-semibold transition-all">Erkaklar</button>
            <button @click="tab = 'women'"
                :class="tab === 'women' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-600'"
                class="px-6 py-2 rounded-lg text-sm font-semibold transition-all">Ayollar</button>
        </div>
    </div>

    {{-- Men table --}}
    <div x-show="tab === 'men'">
        @if($menSizes->count())
        <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        @foreach(['EU', 'UK', 'US', 'Uzunlik (sm)'] as $h)
                        <th class="px-5 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">{{ $h }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($menSizes as $size)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-5 py-3 text-sm font-semibold text-gray-900">{{ $size->eu }}</td>
                        <td class="px-5 py-3 text-sm text-gray-600">{{ $size->uk }}</td>
                        <td class="px-5 py-3 text-sm text-gray-600">{{ $size->us }}</td>
                        <td class="px-5 py-3 text-sm text-gray-600">{{ $size->length_cm }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <p class="text-center text-gray-500 text-sm py-8">Ma'lumotlar hali kiritilmagan.</p>
        @endif
    </div>

    {{-- Women table --}}
    <div x-show="tab === 'women'">
        @if($womenSizes->count())
        <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        @foreach(['EU', 'UK', 'US', 'Uzunlik (sm)'] as $h)
                        <th class="px-5 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">{{ $h }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($womenSizes as $size)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-5 py-3 text-sm font-semibold text-gray-900">{{ $size->eu }}</td>
                        <td class="px-5 py-3 text-sm text-gray-600">{{ $size->uk }}</td>
                        <td class="px-5 py-3 text-sm text-gray-600">{{ $size->us }}</td>
                        <td class="px-5 py-3 text-sm text-gray-600">{{ $size->length_cm }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <p class="text-center text-gray-500 text-sm py-8">Ma'lumotlar hali kiritilmagan.</p>
        @endif
    </div>

    <div class="mt-8 bg-amber-50 border border-amber-100 rounded-2xl p-5">
        <p class="text-xs font-semibold text-amber-800 mb-1">💡 Maslahat</p>
        <p class="text-xs text-amber-700">Agar o'lchamingiz ikkita raqam orasida bo'lsa, kattaroq o'lchamni tanlashingizni tavsiya etamiz.</p>
    </div>
</div>
@endsection
