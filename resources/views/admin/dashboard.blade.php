@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('admin_content')

{{-- Stats grid --}}
<div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-6">
    @foreach([
        ['label' => 'Mahsulotlar', 'value' => $stats['total_products'], 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4', 'color' => 'bg-blue-50 text-blue-600'],
        ['label' => 'Buyurtmalar', 'value' => $stats['total_orders'], 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'color' => 'bg-violet-50 text-violet-600'],
        ['label' => 'Mijozlar', 'value' => $stats['total_users'], 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197', 'color' => 'bg-green-50 text-green-600'],
        ['label' => 'Yangi buyurtma', 'value' => $stats['new_orders'], 'icon' => 'M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'bg-amber-50 text-amber-600'],
        ['label' => 'Yangi xabar', 'value' => $stats['new_messages'], 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'color' => 'bg-red-50 text-red-600'],
        ['label' => "Tushum (so'm)", 'value' => number_format($stats['total_revenue'], 0, '.', ' '), 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 10v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'bg-emerald-50 text-emerald-600'],
    ] as $stat)
    <div class="bg-white border border-gray-100 rounded-2xl p-5">
        <div class="w-9 h-9 {{ explode(' ', $stat['color'])[0] }} rounded-xl flex items-center justify-center mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 {{ explode(' ', $stat['color'])[1] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"/>
            </svg>
        </div>
        <p class="text-lg font-black text-gray-900">{{ $stat['value'] }}</p>
        <p class="text-xs text-gray-500 mt-0.5">{{ $stat['label'] }}</p>
    </div>
    @endforeach
</div>

<div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
    {{-- Recent Orders --}}
    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
        <div class="flex items-center justify-between p-5 border-b border-gray-50">
            <h2 class="font-bold text-gray-900 text-sm">So'nggi buyurtmalar</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-xs text-violet-600 hover:underline">Barchasi →</a>
        </div>
        @if($recentOrders->count())
        <div class="divide-y divide-gray-50">
            @foreach($recentOrders as $order)
            <div class="flex items-center justify-between px-5 py-3">
                <div>
                    <p class="text-sm font-semibold text-gray-900">{{ $order->order_number }}</p>
                    <p class="text-xs text-gray-500">{{ $order->user?->name ?? 'Guest' }}</p>
                </div>
                <div class="text-right">
                    @php $colors = ['accepted'=>'bg-blue-50 text-blue-700', 'packing'=>'bg-amber-50 text-amber-700', 'shipping'=>'bg-violet-50 text-violet-700', 'delivered'=>'bg-green-50 text-green-700']; @endphp
                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $colors[$order->status] ?? 'bg-gray-50 text-gray-700' }}">{{ $order->status_label }}</span>
                    <p class="text-xs font-bold text-gray-900 mt-0.5">{{ number_format($order->total_price, 0, '.', ' ') }} so'm</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
            <p class="p-5 text-sm text-gray-500">Buyurtmalar yo'q.</p>
        @endif
    </div>

    {{-- Top Products --}}
    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
        <div class="flex items-center justify-between p-5 border-b border-gray-50">
            <h2 class="font-bold text-gray-900 text-sm">Mashhur mahsulotlar</h2>
            <a href="{{ route('admin.products.index') }}" class="text-xs text-violet-600 hover:underline">Barchasi →</a>
        </div>
        @if($topProducts->count())
        <div class="divide-y divide-gray-50">
            @foreach($topProducts as $product)
            <div class="flex items-center gap-3 px-5 py-3">
                <img src="{{ $product->primary_image_url }}" alt="{{ $product->name }}"
                    class="w-10 h-10 rounded-xl object-cover bg-gray-50 shrink-0">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">{{ $product->name }}</p>
                    <p class="text-xs text-gray-500">{{ $product->wishlists_count }} wishlist</p>
                </div>
                <p class="text-sm font-bold text-gray-900 shrink-0">{{ number_format($product->current_price, 0, '.', ' ') }}</p>
            </div>
            @endforeach
        </div>
        @else
            <p class="p-5 text-sm text-gray-500">Mahsulotlar yo'q.</p>
        @endif
    </div>
</div>
@endsection
