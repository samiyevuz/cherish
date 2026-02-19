@extends('layouts.account')
@section('title', 'Sozlamalar — CherishStyle')
@section('account_content')

<div class="space-y-6">
    <h1 class="text-xl font-black text-gray-900">Sozlamalar</h1>

    <div class="bg-white border border-gray-100 rounded-2xl p-6">
        <h2 class="font-bold text-gray-900 text-sm mb-5">Shaxsiy ma'lumotlar</h2>
        <form action="{{ route('account.settings.update') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Ism</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 @error('name') border-red-400 @enderror">
                    @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Email</label>
                    <input type="email" value="{{ $user->email }}" disabled
                        class="w-full px-4 py-2.5 border border-gray-100 rounded-xl text-sm bg-gray-50 text-gray-400 cursor-not-allowed">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Telefon</label>
                    <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}"
                        placeholder="+998 90 000 00 00"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 @error('phone') border-red-400 @enderror">
                    @error('phone')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wider">Shahar</label>
                    <input type="text" name="city" value="{{ old('city', $user->city) }}"
                        placeholder="Toshkent"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 @error('city') border-red-400 @enderror">
                    @error('city')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="flex justify-end pt-2">
                <button type="submit"
                    class="px-5 py-2.5 bg-gray-900 text-white text-sm font-semibold rounded-xl hover:bg-gray-800 transition-colors">
                    Saqlash
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
