<div class="group bg-white rounded-2xl overflow-hidden border border-gray-100 hover:border-gray-200 hover:shadow-lg transition-all duration-300">
    <a href="{{ route('product.show', $product->slug) }}" class="block relative overflow-hidden aspect-square bg-gray-50">
        <img
            src="{{ $product->primary_image_url }}"
            alt="{{ $product->name }}"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
            loading="lazy"
        >

        {{-- Badges --}}
        <div class="absolute top-3 left-3 flex flex-col gap-1.5">
            @if($product->is_new)
                <span class="inline-block bg-violet-600 text-white text-xs font-bold px-2.5 py-1 rounded-full leading-none">Yangi</span>
            @endif
            @if($product->sale_price)
                <span class="inline-block bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-full leading-none">
                    -{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                </span>
            @endif
        </div>

        {{-- Wishlist button --}}
        @auth
        <form action="{{ route('account.wishlist.toggle') }}" method="POST" class="absolute top-3 right-3">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit"
                class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-sm hover:bg-gray-50 transition-colors opacity-0 group-hover:opacity-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </button>
        </form>
        @endauth

        {{-- Out of stock --}}
        @if($product->total_stock === 0)
            <div class="absolute inset-0 bg-white/70 flex items-center justify-center">
                <span class="bg-gray-900 text-white text-xs font-bold px-3 py-1.5 rounded-full">Tugagan</span>
            </div>
        @endif
    </a>

    <div class="p-4">
        @if($product->category)
            <p class="text-xs text-gray-400 font-medium mb-1">{{ $product->category->name }}</p>
        @endif
        <a href="{{ route('product.show', $product->slug) }}" class="block">
            <h3 class="font-semibold text-gray-900 text-sm leading-snug hover:text-violet-600 transition-colors line-clamp-2">{{ $product->name }}</h3>
        </a>

        <div class="flex items-center justify-between mt-3">
            <div class="flex items-center gap-2">
                @if($product->sale_price)
                    <span class="font-bold text-gray-900 text-base">{{ number_format($product->sale_price, 0, '.', ' ') }} so'm</span>
                    <span class="text-xs text-gray-400 line-through">{{ number_format($product->price, 0, '.', ' ') }}</span>
                @else
                    <span class="font-bold text-gray-900 text-base">{{ number_format($product->price, 0, '.', ' ') }} so'm</span>
                @endif
            </div>
        </div>

        {{-- Sizes preview --}}
        @if($product->sizes->count())
            <div class="flex flex-wrap gap-1 mt-3">
                @foreach($product->sizes->take(5) as $size)
                    <span class="text-xs px-1.5 py-0.5 border border-gray-200 rounded text-gray-600 {{ $size->stock === 0 ? 'opacity-40 line-through' : '' }}">
                        {{ $size->size }}
                    </span>
                @endforeach
                @if($product->sizes->count() > 5)
                    <span class="text-xs px-1.5 py-0.5 text-gray-400">+{{ $product->sizes->count() - 5 }}</span>
                @endif
            </div>
        @endif
    </div>
</div>
