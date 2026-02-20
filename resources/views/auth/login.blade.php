<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('app.auth_login') }} — CherishStyle</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-inter min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-sm">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center">
                @if(file_exists(public_path('images/logo.png')))
                    <img src="{{ asset('images/logo.png') }}" alt="CTS" class="h-12 w-auto" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <span class="text-3xl font-black tracking-tight text-gray-900 leading-none" style="display:none;">
                        <span style="font-style:italic;letter-spacing:-2px;opacity:0.55">C</span><span style="letter-spacing:-1px">TS</span>
                    </span>
                @else
                    <span class="text-3xl font-black tracking-tight text-gray-900 leading-none">
                        <span style="font-style:italic;letter-spacing:-2px;opacity:0.55">C</span><span style="letter-spacing:-1px">TS</span>
                    </span>
                @endif
            </a>
        </div>

        {{-- Language switcher --}}
        @php $currentLocale = app()->getLocale(); @endphp
        <div class="flex justify-center gap-3 mb-6">
            <a href="{{ route('locale.switch', 'uz') }}" class="text-sm font-semibold {{ $currentLocale === 'uz' ? 'text-gray-900 underline' : 'text-gray-400 hover:text-gray-700' }}">UZ</a>
            <a href="{{ route('locale.switch', 'ru') }}" class="text-sm font-semibold {{ $currentLocale === 'ru' ? 'text-gray-900 underline' : 'text-gray-400 hover:text-gray-700' }}">RU</a>
            <a href="{{ route('locale.switch', 'en') }}" class="text-sm font-semibold {{ $currentLocale === 'en' ? 'text-gray-900 underline' : 'text-gray-400 hover:text-gray-700' }}">EN</a>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
            <h1 class="text-2xl font-black text-gray-900 mb-2">{{ __('app.auth_login') }}</h1>
            <p class="text-gray-500 text-sm mb-6">{{ __('app.auth_login_sub') }}</p>

            @if(session('status'))
                <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 text-sm mb-4">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">{{ __('app.auth_email') }}</label>
                    <input type="email" name="email" value="{{ old('email') }}" autofocus required
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 @error('email') border-red-400 bg-red-50 @enderror">
                    @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('app.auth_password') }}</label>
                        <a href="{{ route('password.request') }}" class="text-xs text-violet-600 hover:underline">{{ __('app.auth_forgot') }}</a>
                    </div>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 @error('password') border-red-400 bg-red-50 @enderror">
                    @error('password')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300">
                    <label for="remember" class="text-sm text-gray-600">{{ __('app.auth_remember') }}</label>
                </div>
                <button type="submit"
                    class="w-full bg-gray-900 text-white font-semibold py-3.5 rounded-xl hover:bg-gray-800 transition-all text-sm mt-2">
                    {{ __('app.auth_login') }}
                </button>
            </form>
        </div>

        <p class="text-center text-sm text-gray-500 mt-5">
            {{ __('app.auth_no_account') }}
            <a href="{{ route('register') }}" class="font-semibold text-gray-900 hover:text-violet-600 transition-colors">{{ __('app.auth_register_link') }}</a>
        </p>
    </div>
</body>
</html>
