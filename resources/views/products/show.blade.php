@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="flex text-sm text-gray-500 mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-teal-600 transition-colors inline-flex items-center gap-1.5">
                        <i data-lucide="home" class="w-4 h-4"></i> Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 text-gray-400"></i>
                        <a href="{{ route('products.index', ['category' => $product->category]) }}" class="ml-1 md:ml-2 hover:text-teal-600 transition-colors capitalize">
                            {{ $product->category }}
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i data-lucide="chevron-right" class="w-4 h-4 text-gray-400"></i>
                        <span class="ml-1 md:ml-2 text-gray-800 font-medium truncate max-w-xs md:max-w-md">
                            {{ $product->name }}
                        </span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Product Core Info Grid -->
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 md:p-8 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
                <!-- Left: Product Image -->
                <div class="relative rounded-2xl overflow-hidden bg-gray-50 border border-gray-100 aspect-[4/3] flex items-center justify-center">
                    <img
                        src="{{ $product->image }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover"
                    />
                    @if(!empty($product->badge))
                        <span class="absolute top-4 left-4 bg-gradient-to-r from-teal-500 to-cyan-500 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg">
                            {{ $product->badge }}
                        </span>
                    @endif
                    
                    @if($product->original_price)
                        @php
                            $discount = round((($product->original_price - $product->price) / $product->original_price) * 100);
                        @endphp
                        @if($discount > 0)
                            <span class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                                -{{ $discount }}%
                            </span>
                        @endif
                    @endif
                </div>

                <!-- Right: Product Controls & Description -->
                <div class="flex flex-col justify-between">
                    <div>
                        <!-- Category & Status -->
                        <div class="flex items-center justify-between mb-4">
                            <span class="bg-teal-50 border border-teal-100 text-teal-800 text-xs font-bold px-3 py-1 rounded-full capitalize">
                                {{ $product->category === 'iot' ? 'IoT System' : Str::singular($product->category) }}
                            </span>
                            @if($product->in_stock)
                                <span class="text-green-600 text-xs font-semibold flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 bg-green-500 rounded-full animate-ping"></span> In Stock
                                </span>
                            @else
                                <span class="text-red-500 text-xs font-semibold flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 bg-red-500 rounded-full"></span> Out of Stock
                                </span>
                            @endif
                        </div>

                        <!-- Product Title -->
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2 leading-tight">
                            {{ $product->name }}
                        </h1>

                        <!-- Ratings and Reviews -->
                        <div class="flex items-center gap-2 mb-6">
                            <div class="flex items-center text-amber-400">
                                @for($i = 0; $i < 5; $i++)
                                    @if($i < floor(floatval($product->rating)))
                                        <i data-lucide="star" class="w-4 h-4 fill-amber-400 text-amber-400"></i>
                                    @else
                                        <i data-lucide="star" class="w-4 h-4 text-gray-200 fill-gray-200"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-sm font-semibold text-gray-800">{{ $product->rating }}</span>
                            <span class="text-xs text-gray-500">({{ $product->reviews }} customer reviews)</span>
                        </div>

                        <!-- Short Description -->
                        <p class="text-sm text-gray-600 mb-6 leading-relaxed">
                            {{ $product->short_description }}
                        </p>

                        <!-- Price Section -->
                        <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100 mb-6">
                            <div class="flex items-baseline gap-2">
                                <span class="text-3xl font-extrabold text-gray-900">{{ number_format($product->price) }} RWF</span>
                                @if($product->original_price)
                                    <span class="text-sm text-gray-400 line-through">{{ number_format($product->original_price) }} RWF</span>
                                @endif
                            </div>
                            <p class="text-xs text-gray-500 mt-1">📱 Includes interactive MTN Mobile Money checkout billing option.</p>
                        </div>
                    </div>

                    <!-- Add to Cart Form controls -->
                    <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div class="flex flex-col sm:flex-row gap-4 items-stretch sm:items-center">
                            <!-- Quantity Selector -->
                            <div class="flex items-center justify-between border border-gray-200 rounded-xl px-4 py-2.5 bg-white w-full sm:w-36">
                                <button type="button" onclick="decrementQty()" class="text-gray-500 hover:text-teal-600 focus:outline-none p-1 font-bold">&minus;</button>
                                <input type="number" name="quantity" id="quantity-input" value="1" min="1" class="w-12 text-center font-bold text-gray-900 focus:outline-none border-none pointer-events-none" readonly>
                                <button type="button" onclick="incrementQty()" class="text-gray-500 hover:text-teal-600 focus:outline-none p-1 font-bold">&plus;</button>
                            </div>
                            
                            <!-- Submit Add-to-Cart Button -->
                            <button
                                type="submit"
                                class="flex-1 bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-teal-500/20 active:scale-95 transition-all flex items-center justify-center gap-2"
                                {{ !$product->in_stock ? 'disabled' : '' }}
                            >
                                <i data-lucide="shopping-cart" class="w-5 h-5"></i> Add to Cart
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Technical Description & Tutorial Tabs -->
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden mb-12">
            <!-- Tab Headers -->
            <div class="flex border-b border-gray-100 bg-gray-50">
                <button
                    onclick="switchTab('specs-tab')"
                    id="specs-tab-btn"
                    class="tab-btn px-6 py-4 text-sm font-semibold border-b-2 border-teal-500 text-teal-600 transition-colors focus:outline-none"
                >
                    🔧 Specifications
                </button>
                <button
                    onclick="switchTab('tutorial-tab')"
                    id="tutorial-tab-btn"
                    class="tab-btn px-6 py-4 text-sm font-semibold border-b-2 border-transparent text-gray-500 hover:text-gray-800 transition-colors focus:outline-none"
                >
                    📚 How it Works
                </button>
                @if(!empty($product->youtube_video_id))
                    <button
                        onclick="switchTab('video-tab')"
                        id="video-tab-btn"
                        class="tab-btn px-6 py-4 text-sm font-semibold border-b-2 border-transparent text-gray-500 hover:text-gray-800 transition-colors focus:outline-none"
                    >
                        🎥 Video Tutorial
                    </button>
                @endif
            </div>

            <!-- Tab Panels -->
            <div class="p-6 md:p-8">
                <!-- Specifications Panel -->
                <div id="specs-tab" class="tab-panel space-y-4">
                    <h3 class="text-lg font-bold text-gray-900 border-b border-gray-50 pb-2 mb-4">Technical Specs</h3>
                    @if(count($product->specifications) > 0)
                        <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($product->specifications as $spec)
                                <li class="flex items-start gap-2 bg-gray-50 p-3 rounded-xl border border-gray-100">
                                    <i data-lucide="check" class="w-4 h-4 text-teal-600 mt-0.5 flex-shrink-0"></i>
                                    <span class="text-sm font-medium text-gray-700">{{ $spec }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-sm text-gray-500">No specifications provided for this product.</p>
                    @endif
                </div>

                <!-- How it Works Panel -->
                <div id="tutorial-tab" class="tab-panel hidden space-y-4">
                    <h3 class="text-lg font-bold text-gray-900 border-b border-gray-50 pb-2 mb-4">Step-by-Step Connection & Tutorial</h3>
                    @if(count($product->how_it_works) > 0)
                        <ol class="space-y-4">
                            @foreach($product->how_it_works as $index => $step)
                                <li class="flex gap-4 items-start bg-gray-50 p-4 rounded-xl border border-gray-100">
                                    <span class="w-7 h-7 bg-teal-500 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0">
                                        {{ $index + 1 }}
                                    </span>
                                    <p class="text-sm text-gray-700 leading-relaxed font-medium">{{ $step }}</p>
                                </li>
                            @endforeach
                        </ol>
                    @else
                        <p class="text-sm text-gray-500">No tutorial available for this product.</p>
                    @endif
                </div>

                <!-- Video Tutorial Panel -->
                @if(!empty($product->youtube_video_id))
                    <div id="video-tab" class="tab-panel hidden space-y-4">
                        <h3 class="text-lg font-bold text-gray-900 border-b border-gray-50 pb-2 mb-4">{{ $product->tutorial_title ?? 'Video Tutorial' }}</h3>
                        <div class="relative overflow-hidden w-full rounded-2xl border border-gray-100 bg-black aspect-video max-w-3xl mx-auto shadow-sm">
                            <iframe
                                class="absolute top-0 left-0 w-full h-full"
                                src="https://www.youtube.com/embed/{{ $product->youtube_video_id }}"
                                title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen
                            ></iframe>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Similar Products Grid -->
        @if(!$similarProducts->isEmpty())
            <section class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Similar Products</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                    @foreach($similarProducts as $simProduct)
                        @include('components.product-card', ['product' => $simProduct])
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</div>

<script>
    function incrementQty() {
        const input = document.getElementById('quantity-input');
        if (input) {
            input.value = parseInt(input.value) + 1;
        }
    }

    function decrementQty() {
        const input = document.getElementById('quantity-input');
        if (input && parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }

    function switchTab(tabId) {
        // Hide all tab panels
        const panels = document.querySelectorAll('.tab-panel');
        panels.forEach(p => p.classList.add('hidden'));

        // Deactivate all tab buttons
        const buttons = document.querySelectorAll('.tab-btn');
        buttons.forEach(b => {
            b.classList.remove('border-teal-500', 'text-teal-600');
            b.classList.add('border-transparent', 'text-gray-500');
        });

        // Show selected panel
        const targetPanel = document.getElementById(tabId);
        if (targetPanel) {
            targetPanel.classList.remove('hidden');
        }

        // Activate selected button
        const targetBtn = document.getElementById(tabId + '-btn');
        if (targetBtn) {
            targetBtn.classList.remove('border-transparent', 'text-gray-500');
            targetBtn.classList.add('border-teal-500', 'text-teal-600');
        }
    }
</script>
@endsection
