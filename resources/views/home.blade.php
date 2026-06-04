@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <section class="relative bg-gray-900 overflow-hidden">
        <div class="absolute inset-0">
            <!-- Pexels electronics workshop placeholder or custom image -->
            <img
                src="https://images.pexels.com/photos/2582937/pexels-photo-2582937.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                alt="Electronics Workshop"
                class="w-full h-full object-cover opacity-30"
            />
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-900/95 to-gray-900/70"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 lg:py-36">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 bg-teal-500/10 border border-teal-500/20 text-teal-400 px-4 py-1.5 rounded-full text-sm font-medium mb-6">
                    <span class="w-2 h-2 bg-teal-400 rounded-full animate-pulse"></span>
                    Rwanda's #1 Electronics Store
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                    Build Your Next
                    <span class="bg-gradient-to-r from-teal-400 to-cyan-400 bg-clip-text text-transparent"> Electronic </span>
                    Project
                </h1>
                <p class="text-lg text-gray-300 mb-8 leading-relaxed">
                    From sensors to microcontrollers, IoT systems to actuators — find everything you need
                    with detailed tutorials, step-by-step guides, and fast delivery across Rwanda.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a
                        href="{{ route('products.index') }}"
                        class="bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white px-8 py-3.5 rounded-full font-semibold text-base transition-all shadow-lg shadow-teal-500/25 flex items-center gap-2 active:scale-95"
                    >
                        Shop Now <i data-lucide="arrow-right" class="w-5 h-5"></i>
                    </a>
                    <a
                        href="#categories-section"
                        class="bg-white/10 hover:bg-white/20 text-white px-8 py-3.5 rounded-full font-semibold text-base transition-all backdrop-blur-sm border border-white/20 flex items-center justify-center"
                    >
                        Browse Categories
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Bar -->
    <section class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <a
                    href="{{ route('shipping') }}"
                    class="flex items-center gap-3 text-left hover:bg-teal-50 rounded-xl p-2 -m-2 transition-colors group"
                >
                    <div class="w-10 h-10 bg-teal-50 group-hover:bg-teal-100 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors">
                        <i data-lucide="truck" class="w-5 h-5 text-teal-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Fast Delivery</p>
                        <p class="text-xs text-gray-500">Across Rwanda</p>
                    </div>
                </a>
                <a
                    href="{{ route('returns') }}"
                    class="flex items-center gap-3 text-left hover:bg-teal-50 rounded-xl p-2 -m-2 transition-colors group"
                >
                    <div class="w-10 h-10 bg-teal-50 group-hover:bg-teal-100 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors">
                        <i data-lucide="shield" class="w-5 h-5 text-teal-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Quality Guaranteed</p>
                        <p class="text-xs text-gray-500">Original components</p>
                    </div>
                </a>
                <a
                    href="{{ route('contact.index') }}"
                    class="flex items-center gap-3 text-left hover:bg-teal-50 rounded-xl p-2 -m-2 transition-colors group"
                >
                    <div class="w-10 h-10 bg-teal-50 group-hover:bg-teal-100 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors">
                        <i data-lucide="headphones" class="w-5 h-5 text-teal-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Tech Support</p>
                        <p class="text-xs text-gray-500">Expert assistance</p>
                    </div>
                </a>
                <a
                    href="{{ route('products.index') }}"
                    class="flex items-center gap-3 text-left hover:bg-teal-50 rounded-xl p-2 -m-2 transition-colors group"
                >
                    <div class="w-10 h-10 bg-teal-50 group-hover:bg-teal-100 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors">
                        <i data-lucide="star" class="w-5 h-5 text-teal-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Tutorials Included</p>
                        <p class="text-xs text-gray-500">Learn as you build</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="categories-section" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-900 mb-3">Shop by Category</h2>
            <p class="text-gray-500 max-w-lg mx-auto">
                Explore our wide range of electronic components organized by category
            </p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($categories as $cat)
                <a
                    href="{{ route('products.index', ['category' => $cat['id']]) }}"
                    class="group relative bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all border border-gray-100 overflow-hidden text-left block"
                >
                    <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br {{ $cat['color'] }} opacity-5 rounded-bl-full group-hover:opacity-10 transition-opacity"></div>
                    <div class="w-12 h-12 bg-gradient-to-br {{ $cat['color'] }} rounded-xl flex items-center justify-center mb-4 shadow-lg">
                        <i data-lucide="{{ $cat['icon'] }}" class="w-6 h-6 text-white"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1">{{ $cat['name'] }}</h3>
                    <p class="text-sm text-gray-500">{{ $cat['count'] }} products</p>
                    <i data-lucide="arrow-right" class="w-4 h-4 text-gray-300 group-hover:text-teal-500 absolute bottom-6 right-6 transition-colors"></i>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Featured Products</h2>
                    <p class="text-gray-500">Our most popular electronic components</p>
                </div>
                <a
                    href="{{ route('products.index') }}"
                    class="hidden sm:flex items-center gap-2 text-teal-600 hover:text-teal-700 font-medium transition-colors"
                >
                    View All <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                @foreach($featuredProducts as $product)
                    @include('components.product-card', ['product' => $product])
                @endforeach
            </div>
            <div class="text-center mt-8 sm:hidden">
                <a
                    href="{{ route('products.index') }}"
                    class="text-teal-600 font-medium inline-flex items-center gap-2 mx-auto"
                >
                    View All Products <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- New Arrivals / All Products Preview Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">New Arrivals</h2>
                <p class="text-gray-500">Browse our complete collection</p>
            </div>
            <a
                href="{{ route('products.index') }}"
                class="hidden sm:flex items-center gap-2 text-teal-600 hover:text-teal-700 font-medium transition-colors"
            >
                See All <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            @foreach($newArrivals as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a
                href="{{ route('products.index') }}"
                class="bg-gray-900 hover:bg-gray-800 text-white px-8 py-3 rounded-full font-semibold transition-all inline-flex items-center gap-2"
            >
                View All {{ $products->count() }} Products <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>
    </section>

    <!-- MTN Mobile Money Banner -->
    <section class="bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-400 py-12 shadow-inner">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="text-center md:text-left">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Pay with MTN Mobile Money 📱</h3>
                    <p class="text-gray-800 font-medium">
                        Fast, secure, and convenient payment. Enter your number at checkout to receive a payment request prompt directly on your phone!
                    </p>
                </div>
                <a
                    href="{{ route('products.index') }}"
                    class="bg-gray-900 hover:bg-gray-800 text-white px-8 py-3 rounded-full font-semibold transition-all inline-flex items-center gap-2 whitespace-nowrap active:scale-95"
                >
                    Start Shopping <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </a>
            </div>
        </div>
    </section>
</div>
@endsection
