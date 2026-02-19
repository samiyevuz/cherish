@extends('layouts.account')
@section('title', 'Istaklarim — CherishStyle')
@section('account_content')

<div class="space-y-4">
    <h1 class="text-xl font-black text-gray-900">Istaklarim</h1>

    @if($wishlists->count())
        <div class="grid grid-cols-2 gap-4">
            @foreach($wishlists as $wishlist)
                @include('partials.product-card', ['product' => $wishlist->product])
            @endforeach
        </div>
        {{ $wishlists->links('partials.pagination') }}
    @else
        <div class="bg-white border border-gray-100 rounded-2xl p-12 text-center">
            <div class="w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            </div>
            <p class="font-semibold text-gray-900 mb-1">Istaklarim bo'sh</p>
            <p class="text-sm text-gray-500 mb-4">Yoqtirgan mahsulotlaringizni saqlang.</p>
            <a href="{{ route('home') }}" class="text-sm font-semibold text-violet-600 hover:underline">Xarid qilish →</a>
        </div>
    @endif
</div>
@endsection
