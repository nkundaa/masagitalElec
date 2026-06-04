@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                @if($selectedCategory === 'all')
                    All Products
                @else
                    {{ collect($categories)->firstWhere('id', $selectedCategory)['name'] ?? 'Products' }}
                @endif
            </h1>
            <p class="text-gray-500">
                {{ $products->count() }} product{{ $products->count() !== 1 ? 's' : '' }} found
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Search & Filter Bar Form -->
        <form id="filters-form" action="{{ route('products.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4 mb-8">
            <!-- Hidden Category Input -->
            <input type="hidden" name="category" id="category-input" value="{{ $selectedCategory }}">

            <!-- Search Field -->
            <div class="relative flex-1">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                <input
                    type="text"
                    name="search"
                    id="search-query-input"
                    placeholder="Search products..."
                    value="{{ $searchQuery }}"
                    class="w-full pl-12 pr-10 py-3 bg-white border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all"
                />
                @if(!empty($searchQuery))
                    <button
                        type="button"
                        onclick="document.getElementById('search-query-input').value = ''; document.getElementById('filters-form').submit();"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
                    >
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                @endif
            </div>

            <!-- Sort Selection -->
            <select
                name="sort"
                onchange="document.getElementById('filters-form').submit()"
                class="px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent cursor-pointer"
            >
                <option value="default" {{ $sortBy === 'default' ? 'selected' : '' }}>Sort: Default</option>
                <option value="price-low" {{ $sortBy === 'price-low' ? 'selected' : '' }}>Price: Low to High</option>
                <option value="price-high" {{ $sortBy === 'price-high' ? 'selected' : '' }}>Price: High to Low</option>
                <option value="rating" {{ $sortBy === 'rating' ? 'selected' : '' }}>Highest Rated</option>
                <option value="name" {{ $sortBy === 'name' ? 'selected' : '' }}>Name: A-Z</option>
            </select>

            <!-- Filter Toggle (mobile toggle helper) -->
            <button
                type="button"
                id="mobile-filters-toggle-btn"
                class="sm:hidden flex items-center justify-center gap-2 px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-700"
            >
                <i data-lucide="sliders-horizontal" class="w-4 h-4"></i> Filters
            </button>
        </form>

        <div class="flex flex-col sm:flex-row gap-8">
            <!-- Sidebar Categories -->
            <div id="sidebar-filters" class="hidden sm:block w-full sm:w-56 flex-shrink-0">
                <div class="bg-white rounded-2xl border border-gray-100 p-4 sticky top-24 shadow-sm">
                    <h3 class="font-semibold text-gray-900 mb-3 text-sm uppercase tracking-wider">Categories</h3>
                    <div class="space-y-1">
                        @foreach($categories as $cat)
                            <button
                                type="button"
                                onclick="submitWithCategory('{{ $cat['id'] }}')"
                                class="w-full text-left px-3 py-2.5 rounded-xl text-sm font-medium transition-all flex items-center justify-between {{ $selectedCategory === $cat['id'] ? 'bg-teal-50 text-teal-700 border border-teal-200' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 border border-transparent' }}"
                            >
                                <span class="flex items-center gap-2">
                                    <span>{{ $cat['icon'] }}</span>
                                    <span>{{ $cat['name'] }}</span>
                                </span>
                                <span class="text-xs px-2 py-0.5 rounded-full {{ $selectedCategory === $cat['id'] ? 'bg-teal-100 text-teal-700' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $cat['count'] }}
                                </span>
                            </button>
                        @endforeach
                    </div>

                    <!-- Payment Info Widget -->
                    <div class="mt-6 pt-4 border-t border-gray-100">
                        <h3 class="font-semibold text-gray-900 mb-3 text-sm uppercase tracking-wider">Payment</h3>
                        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-3 shadow-sm">
                            <p class="text-xs text-yellow-800 font-bold mb-1">📱 MTN Mobile Money</p>
                            <p class="text-xs text-yellow-700">Enter your number at checkout to trigger a USSD pull prompt directly on your phone.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="flex-1">
                @if($products->isEmpty())
                    <div class="text-center py-20 bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
                        <div class="text-6xl mb-4">🔍</div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No products found</h3>
                        <p class="text-gray-500 mb-6">Try adjusting your search query or filter criteria</p>
                        <button
                            type="button"
                            onclick="resetFilters()"
                            class="bg-teal-500 hover:bg-teal-600 text-white px-6 py-2.5 rounded-full font-medium transition-colors shadow-lg shadow-teal-500/20"
                        >
                            Clear Filters
                        </button>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                        @foreach($products as $product)
                            @include('components.product-card', ['product' => $product])
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function submitWithCategory(category) {
        document.getElementById('category-input').value = category;
        document.getElementById('filters-form').submit();
    }

    function resetFilters() {
        document.getElementById('search-query-input').value = '';
        document.getElementById('category-input').value = 'all';
        document.getElementById('filters-form').submit();
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Toggle Filters for mobile screen sizes
        const toggleBtn = document.getElementById('mobile-filters-toggle-btn');
        const sidebar = document.getElementById('sidebar-filters');
        
        if (toggleBtn && sidebar) {
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('hidden');
            });
        }
    });
</script>
@endsection
