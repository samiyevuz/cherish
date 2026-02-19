@extends('layouts.account')
@section('title', 'Buyurtmalarim — CherishStyle')
@section('account_content')

<div class="space-y-4">
    <h1 class="text-xl font-black text-gray-900">Buyurtmalarim</h1>

    @if($orders->count())
        @foreach($orders as $order)
        <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-4 sm:p-5 border-b border-gray-50">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-gray-100 rounded-xl flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900 text-sm tracking-wide">{{ $order->order_number }}</p>
                        <p class="text-xs text-gray-500">{{ $order->created_at->format('d.m.Y, H:i') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    @php
                        $colors = ['accepted'=>'bg-blue-50 text-blue-700', 'packing'=>'bg-amber-50 text-amber-700', 'shipping'=>'bg-violet-50 text-violet-700', 'delivered'=>'bg-green-50 text-green-700'];
                    @endphp
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $colors[$order->status] ?? 'bg-gray-50 text-gray-600' }}">{{ $order->status_label }}</span>
                    <a href="{{ route('account.order.show', $order) }}" class="text-xs font-medium text-gray-700 hover:text-violet-600 transition-colors">Ko'rish →</a>
                </div>
            </div>
            <div class="p-4 sm:p-5 flex items-center justify-between">
                <p class="text-xs text-gray-500">{{ $order->items->count() }} ta mahsulot</p>
                <p class="font-black text-gray-900">{{ number_format($order->total_price, 0, '.', ' ') }} so'm</p>
            </div>
        </div>
        @endforeach

        {{ $orders->links('partials.pagination') }}
    @else
        <div class="bg-white border border-gray-100 rounded-2xl p-12 text-center">
            <div class="w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <p class="font-semibold text-gray-900 mb-1">Buyurtmalar yo'q</p>
            <p class="text-sm text-gray-500 mb-4">Hali birorta buyurtma berilmagan.</p>
            <a href="{{ route('home') }}" class="text-sm font-semibold text-violet-600 hover:underline">Xarid qilish →</a>
        </div>
    @endif
</div>
@endsection
