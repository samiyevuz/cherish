@extends('layouts.account')
@section('title', $order->order_number . ' — CherishStyle')
@section('account_content')

<div>
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('account.orders') }}" class="text-sm text-gray-500 hover:text-gray-900 transition-colors">← Buyurtmalar</a>
    </div>
    <h1 class="text-xl font-black text-gray-900 mb-6">{{ $order->order_number }}</h1>

    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
        <div class="p-5 border-b border-gray-100">
            @php
                $colors = ['accepted'=>'bg-blue-50 text-blue-700', 'packing'=>'bg-amber-50 text-amber-700', 'shipping'=>'bg-violet-50 text-violet-700', 'delivered'=>'bg-green-50 text-green-700'];
            @endphp
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs text-gray-500">Sana</p>
                    <p class="font-semibold text-gray-900 text-sm">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                </div>
                <span class="text-sm font-semibold px-3 py-1 rounded-full {{ $colors[$order->status] ?? 'bg-gray-50 text-gray-600' }}">{{ $order->status_label }}</span>
            </div>
        </div>

        <div class="divide-y divide-gray-50">
            @foreach($order->items as $item)
            <div class="p-5 flex items-center gap-4">
                @if($item->product)
                    <img src="{{ $item->product->primary_image_url }}" alt="" class="w-14 h-14 rounded-xl object-cover bg-gray-50 shrink-0">
                @else
                    <div class="w-14 h-14 bg-gray-100 rounded-xl shrink-0"></div>
                @endif
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-900">{{ $item->product_name }}</p>
                    <p class="text-xs text-gray-500">{{ $item->size }} × {{ $item->quantity }}</p>
                </div>
                <p class="text-sm font-bold text-gray-900">{{ number_format($item->subtotal, 0, '.', ' ') }} so'm</p>
            </div>
            @endforeach
        </div>

        <div class="p-5 bg-gray-50 space-y-2 text-sm">
            <div class="flex justify-between text-gray-600"><span>Yetkazib berish</span><span>{{ number_format($order->delivery_price, 0, '.', ' ') }} so'm</span></div>
            <div class="flex justify-between font-black text-gray-900 text-base"><span>Jami</span><span>{{ number_format($order->total_price, 0, '.', ' ') }} so'm</span></div>
        </div>

        <div class="p-5 border-t border-gray-100">
            <p class="text-sm font-semibold text-gray-900 mb-2">Yetkazib berish manzili</p>
            <p class="text-sm text-gray-700">{{ $order->full_name }}</p>
            <p class="text-sm text-gray-500">{{ $order->phone }}</p>
            <p class="text-sm text-gray-500">{{ $order->city }}, {{ $order->address }}</p>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('order.track') }}" class="text-sm font-medium text-violet-600 hover:underline">
            Buyurtmani kuzatish →
        </a>
    </div>
</div>
@endsection
