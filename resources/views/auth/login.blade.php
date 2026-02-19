<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirish — CherishStyle</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-inter min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-sm">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2">
                <div class="w-10 h-10 bg-gray-900 rounded-xl flex items-center justify-center">
                    <span class="text-white font-black">CS</span>
                </div>
                <span class="font-black text-xl text-gray-900">CherishStyle</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
            <h1 class="text-2xl font-black text-gray-900 mb-2">Kirish</h1>
            <p class="text-gray-500 text-sm mb-6">Akkauntingizga kiring</p>

            @if(session('status'))
                <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 text-sm mb-4">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" autofocus required
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 @error('email') border-red-400 bg-red-50 @enderror">
                    @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider">Parol</label>
                        <a href="{{ route('password.request') }}" class="text-xs text-violet-600 hover:underline">Unutdingizmi?</a>
                    </div>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 @error('password') border-red-400 bg-red-50 @enderror">
                    @error('password')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300">
                    <label for="remember" class="text-sm text-gray-600">Eslab qolish</label>
                </div>
                <button type="submit"
                    class="w-full bg-gray-900 text-white font-semibold py-3.5 rounded-xl hover:bg-gray-800 transition-all text-sm mt-2">
                    Kirish
                </button>
            </form>
        </div>

        <p class="text-center text-sm text-gray-500 mt-5">
            Akkauntingiz yo'qmi?
            <a href="{{ route('register') }}" class="font-semibold text-gray-900 hover:text-violet-600 transition-colors">Ro'yxatdan o'ting</a>
        </p>
    </div>
</body>
</html>
