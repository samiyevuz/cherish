@extends('layouts.app')
@section('title', 'Buyurtma qabul qilindi — CherishStyle')
@section('content')
<div class="max-w-xl mx-auto px-4 py-20 text-center">
    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
    </div>
    <h1 class="text-2xl font-black text-gray-900 mb-2">Buyurtmangiz qabul qilindi!</h1>
    <p class="text-gray-500 text-sm mb-6">Tez orada siz bilan bog'lanamiz. Buyurtmangizni kuzatib boring.</p>

    <div class="bg-gray-50 rounded-2xl p-6 mb-8">
        <p class="text-sm text-gray-600 mb-2">Buyurtma raqami</p>
        <p class="text-2xl font-black text-gray-900 tracking-widest">{{ $orderNumber }}</p>
    </div>

    <div class="flex flex-col sm:flex-row gap-3 justify-center">
        <a href="{{ route('order.track') }}?order_number={{ $orderNumber }}"
            class="inline-flex items-center justify-center gap-2 bg-gray-900 text-white font-semibold px-6 py-3 rounded-xl hover:bg-gray-800 transition-all text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            Buyurtmani kuzatish
        </a>
        <a href="{{ route('home') }}"
            class="inline-flex items-center justify-center gap-2 border border-gray-200 text-gray-700 font-medium px-6 py-3 rounded-xl hover:bg-gray-50 transition-all text-sm">
            Xaridni davom ettirish
        </a>
    </div>
</div>
@endsection
