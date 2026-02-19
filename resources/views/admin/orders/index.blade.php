@extends('layouts.admin')
@section('title', 'Buyurtmalar')
@section('page_title', 'Buyurtmalar')
@section('admin_content')

<div class="flex flex-col sm:flex-row gap-3 mb-5">
    <form method="GET" class="flex gap-2 flex-1">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buyurtma raqami..."
            class="flex-1 px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 max-w-xs">
        <select name="status" class="px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
            <option value="">Barcha statuslar</option>
            @foreach(['accepted' => 'Qabul', 'packing' => 'Qadoqlash', 'shipping' => 'Yetkazish', 'delivered' => 'Yetkazildi'] as $val => $label)
                <option value="{{ $val }}" {{ request('status') === $val ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        <button type="submit" class="px-4 py-2.5 bg-gray-900 text-white rounded-xl text-sm font-medium hover:bg-gray-800">Filter</button>
    </form>
</div>

<div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
    @if($orders->count())
    <table class="w-full">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Raqam</th>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider hidden sm:table-cell">Mijoz</th>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider hidden md:table-cell">Jami</th>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider hidden lg:table-cell">Sana</th>
                <th class="px-5 py-3.5 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Amal</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($orders as $order)
            @php $colors = ['accepted'=>'bg-blue-50 text-blue-700','packing'=>'bg-amber-50 text-amber-700','shipping'=>'bg-violet-50 text-violet-700','delivered'=>'bg-green-50 text-green-700']; @endphp
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-5 py-4">
                    <p class="text-sm font-bold text-gray-900 tracking-wide">{{ $order->order_number }}</p>
                    <p class="text-xs text-gray-500">{{ $order->full_name }}</p>
                </td>
                <td class="px-5 py-4 hidden sm:table-cell">
                    <p class="text-sm text-gray-700">{{ $order->user?->name ?? 'Mehmon' }}</p>
                    <p class="text-xs text-gray-500">{{ $order->phone }}</p>
                </td>
                <td class="px-5 py-4">
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $colors[$order->status] ?? 'bg-gray-50 text-gray-600' }}">{{ $order->status_label }}</span>
                </td>
                <td class="px-5 py-4 hidden md:table-cell">
                    <p class="text-sm font-bold text-gray-900">{{ number_format($order->total_price, 0, '.', ' ') }} so'm</p>
                </td>
                <td class="px-5 py-4 hidden lg:table-cell text-xs text-gray-500">
                    {{ $order->created_at->format('d.m.Y') }}
                </td>
                <td class="px-5 py-4 text-right">
                    <a href="{{ route('admin.orders.show', $order) }}"
                        class="inline-flex items-center gap-1 text-xs font-semibold text-violet-600 hover:underline">
                        Ko'rish
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-5 border-t border-gray-100">
        {{ $orders->links('partials.pagination') }}
    </div>
    @else
        <div class="p-12 text-center text-sm text-gray-500">Buyurtmalar topilmadi.</div>
    @endif
</div>
@endsection
