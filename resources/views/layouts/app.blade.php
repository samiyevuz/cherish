<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CherishStyle — Sneakers')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-inter antialiased">

    {{-- Header --}}
    <header class="sticky top-0 z-50 bg-white border-b border-gray-100" x-data="{ mobileOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0">
                    <div class="w-8 h-8 bg-gray-900 rounded-lg flex items-center justify-center">
                        <span class="text-white font-black text-sm">CS</span>
                    </div>
                    <span class="font-bold text-xl text-gray-900 tracking-tight">CherishStyle</span>
                </a>

                {{-- Desktop Navigation --}}
                <nav class="hidden lg:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors {{ request()->routeIs('home') ? 'text-gray-900' : '' }}">Bosh sahifa</a>
                    <a href="{{ route('category.men') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors {{ request()->routeIs('category.men') ? 'text-gray-900' : '' }}">Erkaklar</a>
                    <a href="{{ route('category.women') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors {{ request()->routeIs('category.women') ? 'text-gray-900' : '' }}">Ayollar</a>
                    <a href="{{ route('category.new') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors {{ request()->routeIs('category.new') ? 'text-gray-900' : '' }}">Yangi</a>
                    <a href="{{ route('category.sale') }}" class="text-sm font-medium text-red-500 hover:text-red-600 transition-colors font-semibold {{ request()->routeIs('category.sale') ? 'text-red-600' : '' }}">Aksiya</a>
                </nav>

                {{-- Right icons --}}
                <div class="flex items-center gap-4">
                    {{-- Search --}}
                    <button class="hidden lg:flex p-2 text-gray-500 hover:text-gray-900 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>

                    {{-- Cart --}}
                    <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-500 hover:text-gray-900 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        @if($cartCount > 0)
                            <span class="absolute -top-0.5 -right-0.5 h-4 w-4 bg-gray-900 text-white text-xs rounded-full flex items-center justify-center font-semibold">{{ $cartCount }}</span>
                        @endif
                    </a>

                    {{-- Account --}}
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-2 p-2 text-gray-500 hover:text-gray-900 transition-colors">
                                <div class="w-7 h-7 bg-gray-900 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                            </button>
                            <div x-show="open" @click.outside="open = false" x-transition
                                class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                                <div class="px-4 py-2 border-b border-gray-100 mb-1">
                                    <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                                </div>
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        Admin panel
                                    </a>
                                @endif
                                <a href="{{ route('account.dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    Kabinetim
                                </a>
                                <a href="{{ route('account.orders') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                    Buyurtmalarim
                                </a>
                                <div class="border-t border-gray-100 mt-1 pt-1">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                            Chiqish
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:flex items-center gap-1.5 px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-gray-800 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Kirish
                        </a>
                    @endauth

                    {{-- Mobile menu button --}}
                    <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 text-gray-500 hover:text-gray-900 transition-colors">
                        <svg x-show="!mobileOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-show="mobileOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Mobile menu --}}
            <div x-show="mobileOpen" x-transition class="lg:hidden border-t border-gray-100 py-4 space-y-1">
                <a href="{{ route('home') }}" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg">Bosh sahifa</a>
                <a href="{{ route('category.men') }}" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg">Erkaklar</a>
                <a href="{{ route('category.women') }}" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg">Ayollar</a>
                <a href="{{ route('category.new') }}" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg">Yangi</a>
                <a href="{{ route('category.sale') }}" class="block px-4 py-2.5 text-sm font-medium text-red-500 hover:bg-red-50 rounded-lg font-semibold">Aksiya</a>
                @guest
                    <a href="{{ route('login') }}" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg">Kirish</a>
                    <a href="{{ route('register') }}" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg">Ro'yxatdan o'tish</a>
                @endguest
            </div>
        </div>
    </header>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="fixed top-20 right-4 z-50 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl shadow-lg flex items-center gap-2 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            class="fixed top-20 right-4 z-50 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl shadow-lg flex items-center gap-2 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
    @endif

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                {{-- Brand --}}
                <div class="md:col-span-1">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                            <span class="text-gray-900 font-black text-sm">CS</span>
                        </div>
                        <span class="font-bold text-xl">CherishStyle</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Eng yaxshi sneakerlar brendi. Sifat va uslubni birlashtiramiz.
                    </p>
                </div>

                {{-- About --}}
                <div>
                    <h4 class="font-semibold text-sm uppercase tracking-widest text-gray-400 mb-4">Biz haqimizda</h4>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('about') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Biz haqimizda</a></li>
                        <li><a href="{{ route('contact') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Aloqa</a></li>
                        <li><a href="{{ route('faq') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Savol-javob</a></li>
                    </ul>
                </div>

                {{-- Delivery --}}
                <div>
                    <h4 class="font-semibold text-sm uppercase tracking-widest text-gray-400 mb-4">Yetkazib berish</h4>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('order.track') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Buyurtmani kuzatish</a></li>
                        <li><a href="{{ route('size-guide') }}" class="text-sm text-gray-400 hover:text-white transition-colors">O'lcham jadvali</a></li>
                    </ul>
                </div>

                {{-- Categories --}}
                <div>
                    <h4 class="font-semibold text-sm uppercase tracking-widest text-gray-400 mb-4">Kategoriyalar</h4>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('category.men') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Erkaklar</a></li>
                        <li><a href="{{ route('category.women') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Ayollar</a></li>
                        <li><a href="{{ route('category.new') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Yangi mahsulotlar</a></li>
                        <li><a href="{{ route('category.sale') }}" class="text-sm text-red-400 hover:text-red-300 transition-colors">Aksiya</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-sm text-gray-500">© {{ date('Y') }} CherishStyle. Barcha huquqlar himoyalangan.</p>
                <div class="flex items-center gap-4">
                    <span class="text-xs text-gray-600 bg-gray-800 px-2.5 py-1 rounded-full">UZS</span>
                    <span class="text-xs text-gray-600 bg-gray-800 px-2.5 py-1 rounded-full">UZ</span>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
