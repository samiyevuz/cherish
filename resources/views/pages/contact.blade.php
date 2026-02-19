@extends('layouts.app')
@section('title', 'Aloqa — CherishStyle')
@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-12">
        <span class="text-xs font-bold uppercase tracking-widest text-violet-600 mb-3 block">Bog'laning</span>
        <h1 class="text-3xl sm:text-4xl font-black text-gray-900 mb-4">Biz bilan aloqa</h1>
        <p class="text-gray-500 text-base max-w-xl mx-auto">Savollaringiz bormi? Xabar qoldiring, tez orada javob beramiz.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Contact info --}}
        <div class="space-y-4">
            @foreach([
                ['icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z', 'title' => 'Telefon', 'value' => '+998 90 123 45 67', 'color' => 'bg-blue-50'],
                ['icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'title' => 'Email', 'value' => 'info@cherishstyle.uz', 'color' => 'bg-violet-50'],
                ['icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z', 'title' => 'Manzil', 'value' => 'Toshkent, Chilonzor tumani', 'color' => 'bg-green-50'],
            ] as $info)
            <div class="flex items-start gap-4 bg-white border border-gray-100 rounded-2xl p-5">
                <div class="w-10 h-10 {{ $info['color'] }} rounded-xl flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $info['icon'] }}"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-0.5">{{ $info['title'] }}</p>
                    <p class="text-sm font-medium text-gray-900">{{ $info['value'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Contact Form --}}
        <div class="lg:col-span-2 bg-white border border-gray-100 rounded-2xl p-6 sm:p-8">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 text-sm mb-5 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Ism <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Ismingiz"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 @error('name') border-red-400 bg-red-50 @enderror">
                        @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="email@gmail.com"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 @error('email') border-red-400 bg-red-50 @enderror">
                        @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Telefon</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+998 90 000 00 00"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Xabar <span class="text-red-500">*</span></label>
                    <textarea name="message" rows="5" placeholder="Xabaringizni yozing..."
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 resize-none @error('message') border-red-400 bg-red-50 @enderror">{{ old('message') }}</textarea>
                    @error('message')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-gray-900 text-white font-semibold py-3.5 rounded-xl hover:bg-gray-800 transition-all text-sm">
                    Xabar yuborish
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
