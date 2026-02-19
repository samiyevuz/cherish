<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') — CherishStyle</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-inter antialiased" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">

        {{-- Sidebar --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-900 flex flex-col transition-transform duration-300 lg:relative lg:translate-x-0">

            {{-- Logo --}}
            <div class="flex items-center gap-2.5 px-5 h-16 border-b border-gray-800">
                <div class="w-7 h-7 bg-violet-500 rounded-lg flex items-center justify-center">
                    <span class="text-white font-black text-xs">CS</span>
                </div>
                <div>
                    <span class="font-bold text-white text-sm">CherishStyle</span>
                    <p class="text-gray-500 text-xs">Admin Panel</p>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto p-3 space-y-0.5">
                @php
                    $navItems = [
                        ['route' => 'admin.dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'label' => 'Dashboard'],
                        ['route' => 'admin.products.index', 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4', 'label' => 'Mahsulotlar'],
                        ['route' => 'admin.categories.index', 'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z', 'label' => 'Kategoriyalar'],
                        ['route' => 'admin.orders.index', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'label' => 'Buyurtmalar'],
                        ['route' => 'admin.users.index', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'label' => 'Foydalanuvchilar'],
                        ['route' => 'admin.faqs.index', 'icon' => 'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'label' => 'FAQ'],
                        ['route' => 'admin.contacts.index', 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'label' => 'Xabarlar'],
                        ['route' => 'admin.size-guides.index', 'icon' => 'M3 8l7-5 4 3 4-3 3 2v11a1 1 0 01-1 1H4a1 1 0 01-1-1V8z', 'label' => "O'lcham jadvali"],
                    ];
                @endphp

                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all
                        {{ request()->routeIs($item['route']) ? 'bg-violet-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                        </svg>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            {{-- Bottom --}}
            <div class="p-3 border-t border-gray-800">
                <a href="{{ route('home') }}" target="_blank"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-400 hover:bg-gray-800 hover:text-white transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Saytni ko'rish
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 w-full px-3 py-2.5 rounded-xl text-sm text-gray-400 hover:bg-red-900/30 hover:text-red-400 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Chiqish
                    </button>
                </form>
            </div>
        </aside>

        {{-- Mobile overlay --}}
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            class="fixed inset-0 bg-black/50 z-40 lg:hidden"></div>

        {{-- Main --}}
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

            {{-- Top bar --}}
            <header class="h-16 bg-white border-b border-gray-100 flex items-center justify-between px-4 sm:px-6 shrink-0">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 text-gray-500 hover:text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <div>
                        <h1 class="font-semibold text-gray-900 text-sm">@yield('page_title', 'Dashboard')</h1>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-gray-900 rounded-full flex items-center justify-center">
                        <span class="text-white text-xs font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                    <div class="hidden sm:block">
                        <p class="text-xs font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">Admin</p>
                    </div>
                </div>
            </header>

            {{-- Flash --}}
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                    class="mx-4 sm:mx-6 mt-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                    class="mx-4 sm:mx-6 mt-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            {{-- Content --}}
            <main class="flex-1 overflow-y-auto p-4 sm:p-6">
                @yield('admin_content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
