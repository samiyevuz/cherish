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
            <h1 class="text-2xl font-black text-gray-900 mb-2">{{ __('app.auth_register') }}</h1>
            <p class="text-gray-500 text-sm mb-6">{{ __('app.auth_register_sub') }}</p>

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Name --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">
                        {{ __('app.auth_name') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" autofocus
                        placeholder="Ism Familiya"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 @error('name') border-red-400 bg-red-50 @enderror">
                    @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                {{-- Phone with +998 prefix --}}
                <div x-data="phoneInput()">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">
                        Telefon raqam <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-stretch @error('phone') ring-2 ring-red-400 @enderror rounded-xl overflow-hidden border border-gray-200 focus-within:ring-2 focus-within:ring-gray-900 focus-within:border-transparent">
                        {{-- +998 prefix badge --}}
                        <div class="flex items-center gap-1.5 pl-3.5 pr-2 bg-gray-50 border-r border-gray-200 shrink-0">
                            <span class="text-sm font-bold text-gray-900">🇺🇿</span>
                            <span class="text-sm font-semibold text-gray-700">+998</span>
                        </div>
                        {{-- Digits input --}}
                        <input
                            type="tel"
                            name="phone"
                            x-model="digits"
                            @input="formatDigits"
                            @keydown="allowOnly"
                            value="{{ old('phone') ? preg_replace('/^\+?998/', '', preg_replace('/\D/', '', old('phone'))) : '' }}"
                            placeholder="90 123 45 67"
                            maxlength="12"
                            class="flex-1 px-3 py-3 text-sm bg-white focus:outline-none text-gray-900 placeholder-gray-400">
                    </div>
                    @error('phone')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                {{-- Email (optional) --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">
                        {{ __('app.auth_email') }}
                        <span class="text-gray-400 font-normal normal-case text-xs">(ixtiyoriy)</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        placeholder="example@mail.com"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 @error('email') border-red-400 bg-red-50 @enderror">
                    @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                {{-- Password --}}
                <div x-data="{ show: false }">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">
                        {{ __('app.auth_password') }} <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" name="password"
                            placeholder="Kamida 8 belgi"
                            class="w-full px-4 py-3 pr-11 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 @error('password') border-red-400 bg-red-50 @enderror">
                        <button type="button" @click="show = !show"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-700">
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                        </button>
                    </div>
                    @error('password')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                {{-- Confirm Password --}}
                <div x-data="{ show: false }">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">
                        {{ __('app.auth_confirm_pass') }} <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" name="password_confirmation"
                            placeholder="Parolni takrorlang"
                            class="w-full px-4 py-3 pr-11 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                        <button type="button" @click="show = !show"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-700">
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                        </button>
                    </div>
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

<script>
function phoneInput() {
    return {
        digits: '',
        formatDigits() {
            let raw = this.digits.replace(/[^\d]/g, '');
            let out = '';
            if (raw.length > 0) out += raw.substring(0, 2);
            if (raw.length > 2) out += ' ' + raw.substring(2, 5);
            if (raw.length > 5) out += ' ' + raw.substring(5, 7);
            if (raw.length > 7) out += ' ' + raw.substring(7, 9);
            this.digits = out;
        },
        allowOnly(e) {
            const allowed = ['Backspace','Delete','Tab','ArrowLeft','ArrowRight','ArrowUp','ArrowDown'];
            if (allowed.includes(e.key)) return;
            if (!/^\d$/.test(e.key)) e.preventDefault();
        }
    }
}
</script>
</body>
</html>
