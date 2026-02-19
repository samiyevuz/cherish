@extends('layouts.admin')
@section('title', $user->name)
@section('page_title', $user->name)
@section('admin_content')

<div class="max-w-2xl space-y-5">
    <div class="bg-white border border-gray-100 rounded-2xl p-6">
        <div class="flex items-center gap-4 mb-5">
            <div class="w-14 h-14 bg-gray-900 rounded-full flex items-center justify-center">
                <span class="text-white text-xl font-black">{{ substr($user->name, 0, 1) }}</span>
            </div>
            <div>
                <p class="text-lg font-black text-gray-900">{{ $user->name }}</p>
                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full mt-1 inline-block {{ $user->role === 'admin' ? 'bg-violet-50 text-violet-700' : 'bg-gray-100 text-gray-600' }}">
                    {{ $user->role === 'admin' ? 'Admin' : 'Mijoz' }}
                </span>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-3 text-sm">
            <div><span class="text-gray-500">Telefon:</span> <span class="font-medium text-gray-900">{{ $user->phone ?? '—' }}</span></div>
            <div><span class="text-gray-500">Shahar:</span> <span class="font-medium text-gray-900">{{ $user->city ?? '—' }}</span></div>
            <div><span class="text-gray-500">Ro'yxatdan:</span> <span class="font-medium text-gray-900">{{ $user->created_at->format('d.m.Y') }}</span></div>
            <div><span class="text-gray-500">Buyurtmalar:</span> <span class="font-medium text-gray-900">{{ $user->orders->count() }}</span></div>
        </div>
    </div>

    @if($user->orders->count())
    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
        <h2 class="font-bold text-gray-900 text-sm p-5 border-b border-gray-100">Buyurtmalar</h2>
        <div class="divide-y divide-gray-50">
            @foreach($user->orders->take(10) as $order)
            <div class="flex items-center justify-between px-5 py-3">
                <div>
                    <p class="text-sm font-semibold text-gray-900">{{ $order->order_number }}</p>
                    <p class="text-xs text-gray-500">{{ $order->created_at->format('d.m.Y') }}</p>
                </div>
                <div class="text-right">
                    @php $colors = ['accepted'=>'bg-blue-50 text-blue-700','packing'=>'bg-amber-50 text-amber-700','shipping'=>'bg-violet-50 text-violet-700','delivered'=>'bg-green-50 text-green-700']; @endphp
                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $colors[$order->status] ?? '' }}">{{ $order->status_label }}</span>
                    <p class="text-sm font-bold text-gray-900 mt-0.5">{{ number_format($order->total_price, 0, '.', ' ') }} so'm</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <a href="{{ route('admin.users.index') }}" class="text-sm font-medium text-gray-700 hover:text-violet-600 transition-colors">← Foydalanuvchilarga qaytish</a>
</div>
@endsection
