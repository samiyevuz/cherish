@extends('layouts.app')

@section('title', __('app.checkout_title') . ' — CherishStyle')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-8">
        <a href="{{ route('home') }}" class="hover:text-gray-900 transition-colors">{{ __('app.breadcrumb_home') }}</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('cart.index') }}" class="hover:text-gray-900 transition-colors">{{ __('app.cart_title') }}</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-900 font-medium">{{ __('app.checkout_title') }}</span>
    </nav>

    <h1 class="text-2xl sm:text-3xl font-black text-gray-900 mb-8">{{ __('app.checkout_heading') }}</h1>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="grid lg:grid-cols-3 gap-8">

            {{-- Delivery form --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white border border-gray-100 rounded-2xl p-6">
                    <h2 class="text-base font-bold text-gray-900 mb-5">{{ __('app.checkout_delivery_info') }}</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                {{ __('app.checkout_full_name') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="full_name"
                                value="{{ old('full_name', auth()->user()->name) }}"
                                placeholder="{{ __('app.checkout_name_ph') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all @error('full_name') border-red-400 bg-red-50 @enderror">
                            @error('full_name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                {{ __('app.checkout_phone') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="phone"
                                value="{{ old('phone', auth()->user()->phone) }}"
                                placeholder="{{ __('app.checkout_phone_ph') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all @error('phone') border-red-400 bg-red-50 @enderror">
                            @error('phone')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                {{ __('app.checkout_city') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="city"
                                value="{{ old('city', auth()->user()->city) }}"
                                placeholder="{{ __('app.checkout_city_ph') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all @error('city') border-red-400 bg-red-50 @enderror">
                            @error('city')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                {{ __('app.checkout_address') }} <span class="text-red-500">*</span>
                            </label>
                            <textarea name="address" rows="3"
                                placeholder="{{ __('app.checkout_address_ph') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all resize-none @error('address') border-red-400 bg-red-50 @enderror">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Payment Method Accordion --}}
                @php
                    $paymentLabels = [
                        'cash'  => __('app.payment_cash_desc'),
                        'click' => 'Click orqali to\'lov',
                        'payme' => 'Payme orqali to\'lov',
                        'uzum'  => 'Uzum Bank orqali to\'lov',
                    ];
                    $oldPayment = old('payment_method', 'cash');
                @endphp
                <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden"
                     x-data="{ open: {{ $errors->has('payment_method') ? 'true' : 'false' }}, selected: '{{ $oldPayment }}' }">

                    <input type="hidden" name="payment_method" :value="selected">

                    {{-- Accordion Header --}}
                    <button type="button" @click="open = !open"
                        class="w-full flex items-center gap-4 px-5 py-4 hover:bg-gray-50 transition-colors text-left">
                        {{-- Icon --}}
                        <div class="flex-shrink-0 w-9 h-9 rounded-xl bg-gray-100 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </div>
                        {{-- Title + current selection --}}
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-gray-900">{{ __('app.checkout_payment') }}</p>
                            <p class="text-xs text-blue-500 mt-0.5" x-text="
                                selected === 'cash'  ? '{{ __('app.payment_cash_desc') }}' :
                                selected === 'click' ? 'Click orqali to\'lov' :
                                selected === 'payme' ? 'Payme orqali to\'lov' :
                                                      'Uzum Bank orqali to\'lov'
                            "></p>
                        </div>
                        {{-- Chevron --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 transition-transform duration-300 shrink-0"
                             :class="open ? 'rotate-180' : ''"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    {{-- Accordion Body --}}
                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-2"
                         class="border-t border-gray-100">

                        @error('payment_method')
                            <p class="mx-5 mt-4 text-xs text-red-500 bg-red-50 border border-red-200 rounded-xl px-4 py-2">{{ $message }}</p>
                        @enderror

                        <div class="divide-y divide-gray-100">

                            {{-- Cash --}}
                            <label class="flex items-center gap-4 px-5 py-4 cursor-pointer hover:bg-gray-50 transition-colors">
                                <div class="relative flex items-center justify-center w-5 h-5 shrink-0">
                                    <div class="w-5 h-5 rounded-full border-2 transition-colors"
                                         :class="selected === 'cash' ? 'border-blue-500' : 'border-gray-300'"></div>
                                    <div class="absolute w-2.5 h-2.5 rounded-full bg-blue-500 transition-opacity"
                                         :class="selected === 'cash' ? 'opacity-100' : 'opacity-0'"></div>
                                </div>
                                <input type="radio" name="_payment_method_radio" value="cash" class="sr-only" @change="selected = 'cash'" :checked="selected === 'cash'">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900">{{ __('app.payment_cash') }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ __('app.payment_cash_desc') }}</p>
                                </div>
                                <div class="w-8 h-8 rounded-lg bg-orange-50 flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                            </label>

                            {{-- Click --}}
                            <label class="flex items-center gap-4 px-5 py-4 cursor-pointer hover:bg-gray-50 transition-colors">
                                <div class="relative flex items-center justify-center w-5 h-5 shrink-0">
                                    <div class="w-5 h-5 rounded-full border-2 transition-colors"
                                         :class="selected === 'click' ? 'border-blue-500' : 'border-gray-300'"></div>
                                    <div class="absolute w-2.5 h-2.5 rounded-full bg-blue-500 transition-opacity"
                                         :class="selected === 'click' ? 'opacity-100' : 'opacity-0'"></div>
                                </div>
                                <input type="radio" name="_payment_method_radio" value="click" class="sr-only" @change="selected = 'click'" :checked="selected === 'click'">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900">Click</p>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ __('app.payment_online_desc') }}</p>
                                </div>
                                <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                            </label>

                            {{-- Payme --}}
                            <label class="flex items-center gap-4 px-5 py-4 cursor-pointer hover:bg-gray-50 transition-colors">
                                <div class="relative flex items-center justify-center w-5 h-5 shrink-0">
                                    <div class="w-5 h-5 rounded-full border-2 transition-colors"
                                         :class="selected === 'payme' ? 'border-blue-500' : 'border-gray-300'"></div>
                                    <div class="absolute w-2.5 h-2.5 rounded-full bg-blue-500 transition-opacity"
                                         :class="selected === 'payme' ? 'opacity-100' : 'opacity-0'"></div>
                                </div>
                                <input type="radio" name="_payment_method_radio" value="payme" class="sr-only" @change="selected = 'payme'" :checked="selected === 'payme'">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900">Payme</p>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ __('app.payment_online_desc') }}</p>
                                </div>
                                <div class="w-8 h-8 rounded-lg bg-teal-50 flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                    </svg>
                                </div>
                            </label>

                            {{-- Uzum --}}
                            <label class="flex items-center gap-4 px-5 py-4 cursor-pointer hover:bg-gray-50 transition-colors">
                                <div class="relative flex items-center justify-center w-5 h-5 shrink-0">
                                    <div class="w-5 h-5 rounded-full border-2 transition-colors"
                                         :class="selected === 'uzum' ? 'border-blue-500' : 'border-gray-300'"></div>
                                    <div class="absolute w-2.5 h-2.5 rounded-full bg-blue-500 transition-opacity"
                                         :class="selected === 'uzum' ? 'opacity-100' : 'opacity-0'"></div>
                                </div>
                                <input type="radio" name="_payment_method_radio" value="uzum" class="sr-only" @change="selected = 'uzum'" :checked="selected === 'uzum'">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900">Uzum Bank</p>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ __('app.payment_online_desc') }}</p>
                                </div>
                                <div class="w-8 h-8 rounded-lg bg-purple-50 flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                    </svg>
                                </div>
                            </label>

                        </div>

                        {{-- Note based on selection --}}
                        <div class="px-5 pb-4 pt-1">
                            <div x-show="selected === 'cash'" x-transition
                                 class="flex items-start gap-2 bg-amber-50 border border-amber-200 rounded-xl px-4 py-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <p class="text-xs text-amber-700">{{ __('app.payment_cash_note') }}</p>
                            </div>
                            <div x-show="selected !== 'cash'" x-transition
                                 class="flex items-start gap-2 bg-blue-50 border border-blue-200 rounded-xl px-4 py-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <p class="text-xs text-blue-700">{{ __('app.payment_online_note') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Order summary --}}
            <div class="lg:col-span-1">
                <div class="bg-white border border-gray-100 rounded-2xl p-6 sticky top-24">
                    <h2 class="text-base font-bold text-gray-900 mb-5">{{ __('app.cart_summary') }}</h2>

                    <div class="space-y-3 mb-5">
                        @foreach($cart->items as $item)
                        <div class="flex items-center gap-3">
                            <img src="{{ $item->product->primary_image_url }}" alt="{{ $item->product->name }}"
                                class="w-12 h-12 rounded-xl object-cover bg-gray-50 shrink-0">
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-medium text-gray-900 line-clamp-1">{{ $item->product->name }}</p>
                                <p class="text-xs text-gray-500">{{ $item->size }} × {{ $item->quantity }}</p>
                            </div>
                            <p class="text-xs font-semibold text-gray-900 shrink-0">{{ number_format($item->subtotal, 0, '.', ' ') }}</p>
                        </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-100 pt-4 space-y-3 text-sm">
                        <div class="flex justify-between text-gray-600">
                            <span>{{ __('app.checkout_products') }}</span>
                            <span>{{ number_format($cart->total, 0, '.', ' ') }} {{ __('app.currency') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>{{ __('app.checkout_delivery') }}</span>
                            <span>{{ number_format($deliveryPrice, 0, '.', ' ') }} {{ __('app.currency') }}</span>
                        </div>
                        <div class="border-t border-gray-100 pt-3 flex justify-between">
                            <span class="font-bold text-gray-900">{{ __('app.checkout_total') }}</span>
                            <span class="font-black text-lg text-gray-900">{{ number_format($cart->total + $deliveryPrice, 0, '.', ' ') }} {{ __('app.currency') }}</span>
                        </div>
                    </div>

                    <button type="submit"
                        class="mt-6 w-full flex items-center justify-center gap-2 bg-gray-900 text-white font-semibold py-3.5 rounded-xl hover:bg-gray-800 transition-all hover:shadow-lg text-sm">
                        {{ __('app.checkout_confirm') }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
