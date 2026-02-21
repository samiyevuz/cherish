<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yangi parol — CherishStyle</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-inter min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-sm">
        {{-- Logo (navbar'dagidek) --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center">
                @if(file_exists(public_path('images/logo.svg')))
                    <img src="{{ asset('images/logo.svg') }}" alt="CTS" class="h-12 w-auto" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <span class="text-4xl font-black tracking-tight text-gray-900 leading-none" style="display:none;">
                        <span style="font-style:italic;letter-spacing:-3px;opacity:0.45">C</span><span style="letter-spacing:-1px">TS</span>
                    </span>
                @else
                    <span class="text-4xl font-black tracking-tight text-gray-900 leading-none">
                        <span style="font-style:italic;letter-spacing:-3px;opacity:0.45">C</span><span style="letter-spacing:-1px">TS</span>
                    </span>
                @endif
            </a>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
            <h1 class="text-2xl font-black text-gray-900 mb-6">Yangi parol o'rnatish</h1>
            <form action="{{ route('password.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Email</label>
                    <input type="email" name="email" value="{{ old('email', $request->email) }}" required
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Yangi parol</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Tasdiqlash</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                </div>
                <button type="submit" class="w-full bg-gray-900 text-white font-semibold py-3.5 rounded-xl hover:bg-gray-800 transition-all text-sm">
                    Parolni yangilash
                </button>
            </form>
        </div>
    </div>
</body>
</html>
