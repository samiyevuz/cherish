@extends('layouts.account')
@section('title', 'Kabinet — CherishStyle')
@section('account_content')

<div class="space-y-6">
    <h1 class="text-xl font-black text-gray-900">Xush kelibsiz, {{ auth()->user()->name }}! 👋</h1>

    {{-- Stats --}}
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white border border-gray-100 rounded-2xl p-5 text-center">
            <p class="text-2xl font-black text-gray-900">{{ $totalOrders }}</p>
            <p class="text-xs text-gray-500 mt-1">Buyurtmalar</p>
        </div>
        <div class="bg-white border border-gray-100 rounded-2xl p-5 text-center">
            <p class="text-2xl font-black text-gray-900">{{ $wishlistCount }}</p>
            <p class="text-xs text-gray-500 mt-1">Istaklarim</p>
        </div>
        <div class="bg-violet-50 border border-violet-100 rounded-2xl p-5 text-center">
            <p class="text-2xl font-black text-violet-700">VIP</p>
            <p class="text-xs text-violet-600 mt-1">Mijoz</p>
        </div>
    </div>

    {{-- Recent Orders --}}
    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
        <div class="flex items-center justify-between p-5 border-b border-gray-100">
            <h2 class="font-bold text-gray-900 text-sm">So'nggi buyurtmalar</h2>
            <a href="{{ route('account.orders') }}" class="text-xs text-violet-600 hover:underline font-medium">Barchasi</a>
        </div>
        @if($recentOrders->count())
            <div class="divide-y divide-gray-50">
                @foreach($recentOrders as $order)
                <div class="flex items-center justify-between px-5 py-3.5">
                    <div>
                        <p class="text-sm font-semibold text-gray-900 tracking-wide">{{ $order->order_number }}</p>
                        <p class="text-xs text-gray-500">{{ $order->created_at->format('d.m.Y') }}</p>
                    </div>
                    <div class="text-right">
                        @php
                            $colors = ['accepted'=>'bg-blue-50 text-blue-700', 'packing'=>'bg-amber-50 text-amber-700', 'shipping'=>'bg-violet-50 text-violet-700', 'delivered'=>'bg-green-50 text-green-700'];
                        @endphp
                        <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $colors[$order->status] ?? 'bg-gray-50 text-gray-600' }}">{{ $order->status_label }}</span>
                        <p class="text-sm font-bold text-gray-900 mt-1">{{ number_format($order->total_price, 0, '.', ' ') }} so'm</p>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="p-8 text-center text-sm text-gray-500">Hali buyurtmalar yo'q.</div>
        @endif
    </div>
</div>
@endsection
