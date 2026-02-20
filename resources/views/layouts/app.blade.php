<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
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
            <div class="flex items-center justify-between h-[76px]">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center shrink-0">
                    @if(file_exists(public_path('images/logo.png')))
                        <img src="{{ asset('images/logo.png') }}" alt="CTS" class="h-12 w-auto" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                        <span class="text-4xl font-black tracking-tight text-gray-900 leading-none" style="display:none;">
                            <span style="font-style:italic;letter-spacing:-3px;opacity:0.45">C</span><span style="letter-spacing:-1px">TS</span>
                        </span>
                    @else
                        <span class="text-4xl font-black tracking-tight text-gray-900 leading-none">
                            <span style="font-style:italic;letter-spacing:-3px;opacity:0.45">C</span><span style="letter-spacing:-1px">TS</span>
                        </span>
                    @endif
                </a>

                {{-- Desktop Navigation --}}
                <nav class="hidden lg:flex items-center gap-9">
                    <a href="{{ route('home') }}"
                       class="text-sm text-gray-700 hover:text-gray-900 transition-colors {{ request()->routeIs('home') ? 'font-semibold text-gray-900' : 'font-normal' }}">{{ __('app.nav_home') }}</a>
                    <a href="{{ route('category.men') }}"
                       class="text-sm text-gray-700 hover:text-gray-900 transition-colors {{ request()->routeIs('category.men') ? 'font-semibold text-gray-900' : 'font-normal' }}">{{ __('app.nav_men') }}</a>
                    <a href="{{ route('category.women') }}"
                       class="text-sm text-gray-700 hover:text-gray-900 transition-colors {{ request()->routeIs('category.women') ? 'font-semibold text-gray-900' : 'font-normal' }}">{{ __('app.nav_women') }}</a>
                    <a href="{{ route('category.new') }}"
                       class="text-sm text-gray-700 hover:text-gray-900 transition-colors {{ request()->routeIs('category.new') ? 'font-semibold text-gray-900' : 'font-normal' }}">{{ __('app.nav_new') }}</a>
                    <a href="{{ route('category.sale') }}"
                       class="text-sm text-red-500 hover:text-red-600 transition-colors {{ request()->routeIs('category.sale') ? 'font-semibold' : 'font-normal' }}">{{ __('app.nav_sale') }}</a>
                </nav>

                {{-- Right side --}}
                <div class="flex items-center gap-3">

                    {{-- Language Switcher --}}
                    @php $currentLocale = app()->getLocale(); @endphp
                    <div class="hidden lg:flex items-center gap-1.5 border border-gray-200 rounded-2xl px-3 py-1.5">
                        {{-- Globe icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-[17px] w-[17px] text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <circle cx="12" cy="12" r="9"/>
                            <path d="M3.6 9h16.8M3.6 15h16.8M12 3a15 15 0 010 18M12 3a15 15 0 000 18"/>
                        </svg>
                        <a href="{{ route('locale.switch', 'uz') }}"
                           class="text-xs font-bold px-2.5 py-0.5 rounded-full transition-all {{ $currentLocale === 'uz' ? 'bg-gray-900 text-white' : 'text-gray-500 hover:text-gray-800' }}">UZ</a>
                        <a href="{{ route('locale.switch', 'ru') }}"
                           class="text-xs font-medium transition-all {{ $currentLocale === 'ru' ? 'bg-gray-900 text-white px-2.5 py-0.5 rounded-full' : 'text-gray-500 hover:text-gray-800 px-1' }}">RU</a>
                        <a href="{{ route('locale.switch', 'en') }}"
                           class="text-xs font-medium transition-all {{ $currentLocale === 'en' ? 'bg-gray-900 text-white px-2.5 py-0.5 rounded-full' : 'text-gray-500 hover:text-gray-800 px-1' }}">EN</a>
                    </div>

                    {{-- Cart --}}
                    <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-600 hover:text-gray-900 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-[22px] w-[22px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        @if($cartCount > 0)
                        <span class="absolute top-0 right-0 h-[18px] w-[18px] bg-gray-900 text-white text-[10px] rounded-full flex items-center justify-center font-bold leading-none">{{ $cartCount }}</span>
                        @endif
                    </a>

                    {{-- Account --}}
                    @auth
                        <div class="relative hidden lg:block" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center p-2 text-gray-600 hover:text-gray-900 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-[22px] w-[22px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
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
                                        {{ __('app.nav_admin') }}
                                    </a>
                                @endif
                                <a href="{{ route('account.dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    {{ __('app.nav_cabinet') }}
                                </a>
                                <a href="{{ route('account.orders') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                    {{ __('app.nav_my_orders') }}
                                </a>
                                <div class="border-t border-gray-100 mt-1 pt-1">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                            {{ __('app.nav_logout') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="hidden lg:flex items-center p-2 text-gray-600 hover:text-gray-900 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-[22px] w-[22px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </a>
                    @endauth

                    {{-- Mobile menu button --}}
                    <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 text-gray-600 hover:text-gray-900 transition-colors">
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
                <a href="{{ route('home') }}" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg">{{ __('app.nav_home') }}</a>
                <a href="{{ route('category.men') }}" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg">{{ __('app.nav_men') }}</a>
                <a href="{{ route('category.women') }}" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg">{{ __('app.nav_women') }}</a>
                <a href="{{ route('category.new') }}" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg">{{ __('app.nav_new') }}</a>
                <a href="{{ route('category.sale') }}" class="block px-4 py-2.5 text-sm font-medium text-red-500 hover:bg-red-50 rounded-lg">{{ __('app.nav_sale') }}</a>
                {{-- Mobile locale switcher --}}
                <div class="flex items-center gap-3 px-4 pt-2 border-t border-gray-100 mt-2">
                    <a href="{{ route('locale.switch', 'uz') }}" class="text-sm font-semibold {{ $currentLocale === 'uz' ? 'text-gray-900 underline' : 'text-gray-400' }}">UZ</a>
                    <a href="{{ route('locale.switch', 'ru') }}" class="text-sm font-semibold {{ $currentLocale === 'ru' ? 'text-gray-900 underline' : 'text-gray-400' }}">RU</a>
                    <a href="{{ route('locale.switch', 'en') }}" class="text-sm font-semibold {{ $currentLocale === 'en' ? 'text-gray-900 underline' : 'text-gray-400' }}">EN</a>
                </div>
                @guest
                    <a href="{{ route('login') }}" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg">{{ __('app.nav_login') }}</a>
                    <a href="{{ route('register') }}" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg">{{ __('app.nav_register') }}</a>
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
    <footer class="bg-white border-t border-gray-200 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">

                {{-- Brand --}}
                <div>
                    <a href="{{ route('home') }}" class="inline-flex items-center mb-3">
                        @if(file_exists(public_path('images/logo.png')))
                            <img src="{{ asset('images/logo.png') }}" alt="CTS" class="h-10 w-auto" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                            <span class="text-3xl font-black tracking-tight text-gray-900 leading-none" style="display:none;">
                                <span style="font-style:italic;letter-spacing:-2px;opacity:0.55">C</span><span style="letter-spacing:-1px">TS</span>
                            </span>
                        @else
                            <span class="text-3xl font-black tracking-tight text-gray-900 leading-none">
                                <span style="font-style:italic;letter-spacing:-2px;opacity:0.55">C</span><span style="letter-spacing:-1px">TS</span>
                            </span>
                        @endif
                    </a>
                    <p class="text-sm text-gray-500 mt-2">{{ __('app.footer_tagline') }}</p>
                </div>

                {{-- Biz haqimizda --}}
                <div>
                    <h4 class="font-semibold text-sm text-gray-900 mb-3">{{ __('app.footer_about_col') }}</h4>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('about') }}" class="text-sm text-gray-500 hover:text-gray-900 transition-colors">{{ __('app.footer_about') }}</a></li>
                        <li><a href="{{ route('contact') }}" class="text-sm text-gray-500 hover:text-gray-900 transition-colors">{{ __('app.footer_contact') }}</a></li>
                        <li><a href="{{ route('faq') }}" class="text-sm text-gray-500 hover:text-gray-900 transition-colors">{{ __('app.footer_faq') }}</a></li>
                    </ul>
                </div>

                {{-- Yetkazib berish --}}
                <div>
                    <h4 class="font-semibold text-sm text-gray-900 mb-3">{{ __('app.footer_delivery_col') }}</h4>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('size-guide') }}" class="text-sm text-blue-500 hover:text-blue-700 transition-colors">{{ __('app.footer_sizes') }}</a></li>
                        <li><a href="{{ route('order.track') }}" class="text-sm text-blue-500 hover:text-blue-700 transition-colors">{{ __('app.footer_track') }}</a></li>
                        <li><a href="{{ route('faq') }}" class="text-sm text-blue-500 hover:text-blue-700 transition-colors">{{ __('app.footer_delivery') }}</a></li>
                        <li><a href="{{ route('faq') }}" class="text-sm text-blue-500 hover:text-blue-700 transition-colors">{{ __('app.footer_returns') }}</a></li>
                        <li><a href="{{ route('account.dashboard') }}" class="text-sm text-blue-500 hover:text-blue-700 transition-colors">{{ __('app.footer_account') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-100 mt-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 text-center">
                <p class="text-sm text-gray-400">{{ __('app.footer_copyright', ['year' => date('Y')]) }}</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
