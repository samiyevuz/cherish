@php
    $showButtonAlways = $showButtonAlways ?? false;
@endphp
<div class="group relative bg-white transition-all duration-300 ease-out hover:-translate-y-1">

    {{-- Image Container --}}
    <div class="relative overflow-hidden bg-gray-100 aspect-square">
        <a href="{{ route('product.show', $product->slug) }}" class="block w-full h-full">
            <img
                src="{{ $product->primary_image_url }}"
                alt="{{ $product->name }}"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                loading="lazy"
            >
        </a>

        {{-- Badges --}}
        <div class="absolute top-3 left-3 flex flex-col gap-1.5 z-10 pointer-events-none">
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
            <div class="absolute inset-0 bg-white/60 flex items-center justify-center z-20 pointer-events-none">
                <span class="bg-gray-900 text-white text-xs font-semibold px-3 py-1.5 rounded-full">{{ __('app.badge_out_of_stock') }}</span>
            </div>
        @endif
    </div>

    {{-- Info --}}
    <div class="pt-3 pb-3 px-1">
        <a href="{{ route('product.show', $product->slug) }}" class="block">
            <h3 class="text-sm text-gray-900 font-medium hover:text-gray-600 transition-colors leading-snug line-clamp-2 mb-1.5">{{ $product->name }}</h3>
        </a>
        <div class="flex items-center gap-2 mb-3">
            @if($product->sale_price)
                <span class="text-sm font-semibold text-gray-900">{{ number_format($product->sale_price, 0) }} so'm</span>
                <span class="text-xs text-gray-400 line-through">{{ number_format($product->price, 0) }} so'm</span>
            @else
                <span class="text-sm font-semibold text-gray-900">{{ number_format($product->price, 0) }} so'm</span>
            @endif
        </div>

        {{-- Batafsil button: hover da opacity o'zgaradi (layout shift yo'q) --}}
        <a href="{{ route('product.show', $product->slug) }}"
           class="block w-full bg-gray-900 text-white text-sm font-semibold text-center py-3 hover:bg-gray-700 transition-all duration-300 ease-out
                  {{ $showButtonAlways ? 'opacity-100' : 'opacity-0 group-hover:opacity-100 translate-y-1 group-hover:translate-y-0' }}">
            {{ __('app.details') }}
        </a>
    </div>
</div>
