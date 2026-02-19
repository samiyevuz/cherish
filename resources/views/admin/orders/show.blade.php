@extends('layouts.admin')
@section('title', $order->order_number)
@section('page_title', 'Buyurtma: ' . $order->order_number)
@section('admin_content')

<div class="max-w-3xl space-y-5">
    {{-- Status update --}}
    <div class="bg-white border border-gray-100 rounded-2xl p-5">
        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
            <div class="flex-1">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Joriy status</p>
                @php $colors = ['accepted'=>'bg-blue-50 text-blue-700','packing'=>'bg-amber-50 text-amber-700','shipping'=>'bg-violet-50 text-violet-700','delivered'=>'bg-green-50 text-green-700']; @endphp
                <span class="text-sm font-bold px-3 py-1.5 rounded-full {{ $colors[$order->status] ?? 'bg-gray-50 text-gray-700' }}">{{ $order->status_label }}</span>
            </div>
            <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="flex gap-2">
                @csrf @method('PATCH')
                <select name="status" class="px-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                    @foreach(['accepted' => 'Qabul qilindi', 'packing' => 'Qadoqlanmoqda', 'shipping' => 'Yetkazilmoqda', 'delivered' => 'Yetkazildi'] as $val => $label)
                        <option value="{{ $val }}" {{ $order->status === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-xl text-sm font-medium hover:bg-gray-800">Yangilash</button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        {{-- Customer info --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-5">
            <h2 class="font-bold text-gray-900 text-sm mb-3 border-b border-gray-100 pb-2">Mijoz ma'lumotlari</h2>
            <div class="space-y-1.5 text-sm">
                <div class="flex justify-between"><span class="text-gray-500">Ism:</span><span class="font-medium text-gray-900">{{ $order->full_name }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Telefon:</span><span class="font-medium text-gray-900">{{ $order->phone }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Shahar:</span><span class="font-medium text-gray-900">{{ $order->city }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Manzil:</span><span class="font-medium text-gray-900 text-right max-w-xs">{{ $order->address }}</span></div>
                @if($order->user)
                    <div class="flex justify-between pt-1 border-t border-gray-100"><span class="text-gray-500">Akkaunt:</span><a href="{{ route('admin.users.show', $order->user) }}" class="font-medium text-violet-600 hover:underline">{{ $order->user->email }}</a></div>
                @endif
            </div>
        </div>

        {{-- Order summary --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-5">
            <h2 class="font-bold text-gray-900 text-sm mb-3 border-b border-gray-100 pb-2">Buyurtma xulosasi</h2>
            <div class="space-y-1.5 text-sm">
                <div class="flex justify-between"><span class="text-gray-500">Raqam:</span><span class="font-bold text-gray-900 tracking-wide">{{ $order->order_number }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Sana:</span><span class="font-medium text-gray-900">{{ $order->created_at->format('d.m.Y H:i') }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Yetkazish:</span><span class="font-medium text-gray-900">{{ number_format($order->delivery_price, 0, '.', ' ') }} so'm</span></div>
                <div class="flex justify-between border-t border-gray-100 pt-1.5"><span class="font-bold text-gray-900">Jami:</span><span class="font-black text-gray-900">{{ number_format($order->total_price, 0, '.', ' ') }} so'm</span></div>
            </div>
        </div>
    </div>

    {{-- Order items --}}
    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
        <h2 class="font-bold text-gray-900 text-sm p-5 border-b border-gray-100">Mahsulotlar</h2>
        <div class="divide-y divide-gray-50">
            @foreach($order->items as $item)
            <div class="flex items-center gap-4 p-5">
                @if($item->product)
                    <img src="{{ $item->product->primary_image_url }}" class="w-12 h-12 rounded-xl object-cover bg-gray-50 shrink-0">
                @else
                    <div class="w-12 h-12 bg-gray-100 rounded-xl shrink-0"></div>
                @endif
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-900">{{ $item->product_name }}</p>
                    <p class="text-xs text-gray-500">O'lcham: {{ $item->size }} | Miqdor: {{ $item->quantity }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm font-bold text-gray-900">{{ number_format($item->subtotal, 0, '.', ' ') }} so'm</p>
                    <p class="text-xs text-gray-500">{{ number_format($item->price, 0, '.', ' ') }} × {{ $item->quantity }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div>
        <a href="{{ route('admin.orders.index') }}" class="text-sm font-medium text-gray-700 hover:text-violet-600 transition-colors">← Buyurtmalarga qaytish</a>
    </div>
</div>
@endsection
