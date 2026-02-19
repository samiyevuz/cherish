<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('app.auth_register') }} — CherishStyle</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-inter min-h-screen flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-sm">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="CTS" class="h-12 w-auto">
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
            <h1 class="text-2xl font-black text-gray-900 mb-2">{{ __('app.auth_register') }}</h1>
            <p class="text-gray-500 text-sm mb-6">{{ __('app.auth_register_sub') }}</p>

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">{{ __('app.auth_name') }}</label>
                    <input type="text" name="name" value="{{ old('name') }}" autofocus required
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 @error('name') border-red-400 bg-red-50 @enderror">
                    @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">{{ __('app.auth_email') }}</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 @error('email') border-red-400 bg-red-50 @enderror">
                    @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">{{ __('app.auth_password') }}</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 @error('password') border-red-400 bg-red-50 @enderror">
                    @error('password')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">{{ __('app.auth_confirm_pass') }}</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                </div>
                <button type="submit"
                    class="w-full bg-gray-900 text-white font-semibold py-3.5 rounded-xl hover:bg-gray-800 transition-all text-sm mt-2">
                    {{ __('app.auth_register') }}
                </button>
            </form>
        </div>

        <p class="text-center text-sm text-gray-500 mt-5">
            {{ __('app.auth_already') }}
            <a href="{{ route('login') }}" class="font-semibold text-gray-900 hover:text-violet-600 transition-colors">{{ __('app.auth_login_link') }}</a>
        </p>
    </div>
</body>
</html>
