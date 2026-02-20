@php
    $showButtonAlways = $showButtonAlways ?? false;
@endphp
<div class="group relative bg-white overflow-hidden transition-all duration-500 ease-out hover:-translate-y-2 shadow-md hover:shadow-xl">
    {{-- Image Container --}}
    <a href="{{ route('product.show', $product->slug) }}" class="block relative overflow-hidden bg-gray-100 aspect-square">
        <img
            src="{{ $product->primary_image_url }}"
            alt="{{ $product->name }}"
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out"
            loading="lazy"
        >

        {{-- Badges --}}
        <div class="absolute top-3 left-3 flex flex-col gap-1.5 z-10">
            @if($product->is_new)
                <span class="inline-block bg-violet-600 text-white text-xs font-semibold px-2.5 py-1 rounded-full leading-none">{{ __('app.badge_new') }}</span>
            @endif
            @if($product->sale_price)
                <span class="inline-block bg-red-500 text-white text-xs font-semibold px-2.5 py-1 rounded-full leading-none">
                    -{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                </span>
            @endif
        </div>

        {{-- Out of stock --}}
        @if($product->total_stock === 0)
            <div class="absolute inset-0 bg-white/60 flex items-center justify-center z-20">
                <span class="bg-gray-900 text-white text-xs font-semibold px-3 py-1.5 rounded-full">{{ __('app.badge_out_of_stock') }}</span>
            </div>
        @endif

        {{-- Hover: Details button (only for homepage) --}}
        @if(!$showButtonAlways)
            <div class="absolute bottom-0 left-0 right-0 opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500 ease-out z-10">
                <a href="{{ route('product.show', $product->slug) }}" class="block w-full bg-gray-900 text-white text-sm font-semibold text-center py-3 hover:bg-gray-800 transition-colors">
                    {{ __('app.details') }}
                </a>
            </div>
        @endif
    </a>

    {{-- Info --}}
    <div class="pt-3 px-1">
        <a href="{{ route('product.show', $product->slug) }}" class="block">
            <h3 class="text-sm text-blue-600 hover:text-blue-800 transition-colors leading-snug line-clamp-2">{{ $product->name }}</h3>
        </a>
        <div class="mt-1.5 flex items-center gap-2">
            @if($product->sale_price)
                <span class="text-sm font-semibold text-gray-900">${{ number_format($product->sale_price, 0) }}</span>
                <span class="text-xs text-gray-400 line-through">${{ number_format($product->price, 0) }}</span>
            @else
                <span class="text-sm font-semibold text-gray-900">${{ number_format($product->price, 0) }}</span>
            @endif
        </div>
        {{-- Details button (always visible for category pages) --}}
        @if($showButtonAlways)
            <a href="{{ route('product.show', $product->slug) }}" class="block w-full bg-gray-900 text-white text-sm font-semibold text-center py-3 mt-3 hover:bg-gray-800 transition-colors">
                {{ __('app.details') }}
            </a>
        @endif
    </div>
</div>
