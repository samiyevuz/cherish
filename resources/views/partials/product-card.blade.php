@php
    $showButtonAlways = $showButtonAlways ?? false;
    $inWishlist = false;
    if (auth()->check()) {
        $inWishlist = auth()->user()->wishlists()->where('product_id', $product->id)->exists();
    }
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

        {{-- Wishlist button (top-right) --}}
        @auth
        <div class="absolute top-3 right-3 z-20" 
             x-data="{ inWishlist: {{ $inWishlist ? 'true' : 'false' }}, loading: false }">
            <button 
                @click.prevent="
                    if (loading) return;
                    loading = true;
                    fetch('{{ route('account.wishlist.toggle') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ product_id: {{ $product->id }} })
                    })
                    .then(response => response.json())
                    .then(data => {
                        inWishlist = data.added;
                        loading = false;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        loading = false;
                    });
                "
                :disabled="loading"
                :class="inWishlist ? 'bg-red-500 text-white' : 'bg-white/90 text-gray-700 hover:bg-white'"
                class="p-2 rounded-full shadow-md transition-all duration-200 disabled:opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" :fill="inWishlist ? 'currentColor' : 'none'" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </button>
        </div>
        @endauth

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

        {{-- Batafsil button: har doim ko'rinadi --}}
        <a href="{{ route('product.show', $product->slug) }}"
           class="block w-full bg-gray-900 text-white text-sm font-semibold text-center py-3 hover:bg-gray-700 transition-all duration-300 ease-out opacity-100">
            {{ __('app.details') }}
        </a>
    </div>
</div>
