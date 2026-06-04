@php
    $discount = $product->original_price 
        ? round((($product->original_price - $product->price) / $product->original_price) * 100)
        : 0;
    
    $ratingVal = floatval($product->rating);
@endphp

<div
    class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 flex flex-col relative cursor-pointer"
    onclick="window.location.href='{{ route('products.show', $product->id) }}'"
>
    <!-- Image Container -->
    <div class="relative overflow-hidden bg-gray-50 aspect-[4/3]">
        <img
            src="{{ $product->image }}"
            alt="{{ $product->name }}"
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
        />
        
        <!-- Overlay on hover -->
        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300 flex items-center justify-center">
            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <div class="bg-white/90 backdrop-blur-sm rounded-full p-3 shadow-lg">
                    <i data-lucide="eye" class="w-5 h-5 text-gray-700"></i>
                </div>
            </div>
        </div>
        
        <!-- Badge -->
        @if(!empty($product->badge))
            <span class="absolute top-3 left-3 bg-gradient-to-r from-teal-500 to-cyan-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                {{ $product->badge }}
            </span>
        @endif
        
        <!-- Discount -->
        @if($discount > 0)
            <span class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                -{{ $discount }}%
            </span>
        @endif
        
        <!-- Category pill -->
        <span class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm text-gray-700 text-xs font-medium px-3 py-1 rounded-full capitalize">
            {{ $product->category === 'iot' ? 'IoT System' : Str::singular($product->category) }}
        </span>
    </div>

    <!-- Content -->
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="font-semibold text-gray-900 text-sm leading-tight line-clamp-2 mb-1 group-hover:text-teal-600 transition-colors">
            {{ $product->name }}
        </h3>
        <p class="text-xs text-gray-500 line-clamp-2 mb-3 flex-grow">
            {{ $product->short_description }}
        </p>

        <!-- Rating -->
        <div class="flex items-center gap-1 mb-3">
            <div class="flex items-center">
                @for($i = 0; $i < 5; $i++)
                    @if($i < floor($ratingVal))
                        <i data-lucide="star" class="w-3 h-3 text-amber-400 fill-amber-400"></i>
                    @else
                        <i data-lucide="star" class="w-3 h-3 text-gray-200 fill-gray-200"></i>
                    @endif
                @endfor
            </div>
            <span class="text-xs text-gray-500">({{ $product->reviews }})</span>
        </div>

        <!-- Price & Action Form -->
        <div class="flex items-end justify-between mt-auto pt-2 border-t border-gray-50/50">
            <div>
                <p class="text-base font-bold text-gray-900">{{ number_format($product->price) }} RWF</p>
                @if($product->original_price)
                    <p class="text-xs text-gray-400 line-through">{{ number_format($product->original_price) }} RWF</p>
                @endif
            </div>
            <form action="{{ route('cart.add') }}" method="POST" onclick="event.stopPropagation()">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <button
                    type="submit"
                    class="bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white p-2.5 rounded-xl transition-all shadow-md hover:shadow-lg active:scale-95 flex items-center justify-center"
                    title="Add to Cart"
                >
                    <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                </button>
            </form>
        </div>
    </div>
</div>
