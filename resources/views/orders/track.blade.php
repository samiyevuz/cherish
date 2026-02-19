@extends('layouts.app')
@section('title', __('app.track_title') . ' — CherishStyle')
@section('content')
<div class="max-w-2xl mx-auto px-4 py-12">

    <div class="text-center mb-10">
        <h1 class="text-2xl sm:text-3xl font-black text-gray-900 mb-2">{{ __('app.track_title') }}</h1>
        <p class="text-gray-500 text-sm">{{ __('app.track_subtitle') }}</p>
    </div>

    {{-- Search form --}}
    <form action="{{ route('order.track.search') }}" method="POST" class="flex gap-3 mb-10">
        @csrf
        <input type="text" name="order_number"
            value="{{ request('order_number') ?? (isset($order) ? $order->order_number : '') }}"
            placeholder="CTS-00001"
            class="flex-1 px-4 py-3 border border-gray-200 rounded-xl text-sm font-medium focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent uppercase tracking-widest @error('order_number') border-red-400 bg-red-50 @enderror">
        <button type="submit"
            class="px-5 py-3 bg-gray-900 text-white rounded-xl text-sm font-semibold hover:bg-gray-800 transition-all">
            {{ __('app.track_search') }}
        </button>
    </form>

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm mb-6">
            {{ session('error') }}
        </div>
    @endif

    @isset($order)
    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
        <div class="bg-gray-50 border-b border-gray-100 p-5 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <p class="text-xs text-gray-500 font-medium mb-1">{{ __('app.track_order_num') }}</p>
                    <p class="text-xl font-black text-gray-900 tracking-widest">{{ $order->order_number }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-500 mb-1">{{ __('app.track_date') }}</p>
                    <p class="text-sm font-semibold text-gray-900">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                </div>
            </div>
        </div>

        {{-- Progress timeline --}}
        <div class="p-5 sm:p-6">
            <div class="relative">
                <div class="absolute top-5 left-5 right-5 h-0.5 bg-gray-100">
                    @php
                        $progress = match($order->status) {
                            'accepted'  => '0%',
                            'packing'   => '33%',
                            'shipping'  => '66%',
                            'delivered' => '100%',
                        };
                    @endphp
                    <div class="h-full bg-gray-900 transition-all duration-500" style="width: {{ $progress }}"></div>
                </div>

                <div class="relative flex justify-between">
                    @foreach([
                        ['key' => 'accepted',  'label_key' => 'track_accepted',  'icon' => 'M5 13l4 4L19 7'],
                        ['key' => 'packing',   'label_key' => 'track_packing',   'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
                        ['key' => 'shipping',  'label_key' => 'track_shipping',  'icon' => 'M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0'],
                        ['key' => 'delivered', 'label_key' => 'track_delivered', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ] as $index => $step)
                        @php
                            $isDone    = $currentIndex >= $index;
                            $isActive  = $currentIndex === $index;
                        @endphp
                        <div class="flex flex-col items-center gap-2 text-center w-1/4">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center z-10 transition-all
                                {{ $isDone ? 'bg-gray-900 text-white shadow-lg shadow-gray-300' : 'bg-white border-2 border-gray-200 text-gray-400' }}
                                {{ $isActive ? 'ring-4 ring-gray-900/20 scale-110' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $step['icon'] }}"/>
                                </svg>
                            </div>
                            <p class="text-xs font-semibold {{ $isDone ? 'text-gray-900' : 'text-gray-400' }} leading-tight">
                                {{ __('app.' . $step['label_key']) }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-8 text-center">
                @php
                    $statusColors = [
                        'accepted'  => 'bg-blue-50 text-blue-700 border-blue-200',
                        'packing'   => 'bg-amber-50 text-amber-700 border-amber-200',
                        'shipping'  => 'bg-violet-50 text-violet-700 border-violet-200',
                        'delivered' => 'bg-green-50 text-green-700 border-green-200',
                    ];
                @endphp
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full border text-sm font-semibold {{ $statusColors[$order->status] ?? 'bg-gray-50 text-gray-700 border-gray-200' }}">
                    <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                    {{ $order->status_label }}
                </span>
            </div>
        </div>

        {{-- Order items --}}
        <div class="border-t border-gray-100 p-5 sm:p-6">
            <h3 class="text-sm font-bold text-gray-900 mb-4">{{ __('app.track_items') }}</h3>
            <div class="space-y-3">
                @foreach($order->items as $item)
                <div class="flex items-center gap-3">
                    @if($item->product)
                        <img src="{{ $item->product->primary_image_url }}" alt="{{ $item->product_name }}"
                            class="w-12 h-12 rounded-xl object-cover bg-gray-50 shrink-0">
                    @else
                        <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 line-clamp-1">{{ $item->product_name }}</p>
                        <p class="text-xs text-gray-500">{{ $item->size }} × {{ $item->quantity }}</p>
                    </div>
                    <p class="text-sm font-semibold text-gray-900">{{ number_format($item->subtotal, 0, '.', ' ') }} {{ __('app.currency') }}</p>
                </div>
                @endforeach
            </div>

            <div class="border-t border-gray-100 mt-4 pt-4 space-y-1.5 text-sm">
                <div class="flex justify-between text-gray-600">
                    <span>{{ __('app.track_delivery') }}</span>
                    <span>{{ number_format($order->delivery_price, 0, '.', ' ') }} {{ __('app.currency') }}</span>
                </div>
                <div class="flex justify-between font-bold text-gray-900">
                    <span>{{ __('app.track_total') }}</span>
                    <span>{{ number_format($order->total_price, 0, '.', ' ') }} {{ __('app.currency') }}</span>
                </div>
            </div>
        </div>

        {{-- Delivery address --}}
        <div class="border-t border-gray-100 p-5 sm:p-6 bg-gray-50">
            <h3 class="text-sm font-bold text-gray-900 mb-3">{{ __('app.track_address') }}</h3>
            <p class="text-sm text-gray-700">{{ $order->full_name }}</p>
            <p class="text-sm text-gray-500">{{ $order->phone }}</p>
            <p class="text-sm text-gray-500">{{ $order->city }}, {{ $order->address }}</p>
        </div>
    </div>
    @endisset
</div>
@endsection
