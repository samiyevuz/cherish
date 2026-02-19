@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid lg:grid-cols-4 gap-8">

        {{-- Sidebar --}}
        <aside class="lg:col-span-1">
            <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
                <div class="bg-gray-900 p-5">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-3">
                        <span class="text-white font-black text-lg">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                    <p class="font-semibold text-white text-sm">{{ auth()->user()->name }}</p>
                    <p class="text-gray-400 text-xs mt-0.5">{{ auth()->user()->email }}</p>
                </div>

                <nav class="p-2">
                    @php
                        $navItems = [
                            ['route' => 'account.dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'label' => __('app.account_dashboard')],
                            ['route' => 'account.orders',    'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'label' => __('app.account_orders')],
                            ['route' => 'account.wishlist',  'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'label' => __('app.account_wishlist')],
                            ['route' => 'account.settings',  'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z', 'label' => __('app.account_settings')],
                        ];
                    @endphp
                    @foreach($navItems as $item)
                        <a href="{{ route($item['route']) }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all mb-0.5
                            {{ request()->routeIs($item['route']) ? 'bg-gray-900 text-white' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                            </svg>
                            {{ $item['label'] }}
                        </a>
                    @endforeach

                    <div class="border-t border-gray-100 mt-2 pt-2">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center gap-3 w-full px-3 py-2.5 rounded-xl text-sm font-medium text-red-600 hover:bg-red-50 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                {{ __('app.nav_logout') }}
                            </button>
                        </form>
                    </div>
                </nav>
            </div>
        </aside>

        {{-- Main content --}}
        <div class="lg:col-span-3">
            @yield('account_content')
        </div>
    </div>
</div>
@endsection
