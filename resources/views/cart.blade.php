@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Link -->
        <a
            href="{{ route('products.index') }}"
            class="flex items-center gap-2 text-gray-500 hover:text-teal-600 mb-6 transition-colors font-medium text-sm"
        >
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Continue Shopping
        </a>

        @if(empty($cart))
            <!-- Empty Cart Screen -->
            <div class="text-center py-16 bg-white border border-gray-100 rounded-3xl p-8 shadow-sm">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="shopping-bag" class="w-12 h-12 text-gray-300"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
                <p class="text-gray-500 mb-8">Looks like you haven't added any products yet.</p>
                <a
                    href="{{ route('products.index') }}"
                    class="bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white px-8 py-3.5 rounded-full font-semibold transition-all inline-flex items-center gap-2 shadow-lg shadow-teal-500/20 active:scale-95"
                >
                    <i data-lucide="shopping-bag" class="w-5 h-5"></i> Browse Products
                </a>
            </div>
        @else
            <!-- Cart Title -->
            <h1 class="text-3xl font-bold text-gray-900 mb-8">
                Shopping Cart ({{ count($cart) }} item{{ count($cart) !== 1 ? 's' : '' }})
            </h1>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Cart Items List (Col 2/3) -->
                <div class="lg:col-span-2 space-y-4">
                    @foreach($cart as $id => $item)
                        <div class="bg-white rounded-2xl border border-gray-100 p-4 sm:p-6 flex gap-4 shadow-sm relative group">
                            <!-- Image -->
                            <a href="{{ route('products.show', $id) }}" class="w-24 h-24 sm:w-28 sm:h-28 object-cover rounded-xl overflow-hidden flex-shrink-0 bg-gray-50 border border-gray-100 block">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </a>

                            <!-- Details -->
                            <div class="flex-1 min-w-0 flex flex-col justify-between">
                                <div>
                                    <a href="{{ route('products.show', $id) }}" class="font-semibold text-gray-900 mb-1 hover:text-teal-600 transition-colors line-clamp-2 block text-sm sm:text-base">
                                        {{ $item['name'] }}
                                    </a>
                                    <span class="inline-block bg-gray-100 text-gray-600 text-xs px-2 py-0.5 rounded capitalize">
                                        {{ $item['category'] === 'iot' ? 'IoT System' : Str::singular($item['category']) }}
                                    </span>
                                </div>

                                <div class="flex items-center justify-between flex-wrap gap-3 mt-4">
                                    <!-- Dynamic Quantity Form -->
                                    <form action="{{ route('cart.update') }}" method="POST" class="inline-block">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $id }}">
                                        <div class="flex items-center border border-gray-200 rounded-xl overflow-hidden bg-white">
                                            <button
                                                type="submit"
                                                name="quantity"
                                                value="{{ $item['quantity'] - 1 }}"
                                                class="px-3 py-1.5 text-gray-500 hover:bg-gray-50 transition-colors focus:outline-none"
                                            >
                                                <i data-lucide="minus" class="w-3 h-3"></i>
                                            </button>
                                            <span class="px-3 py-1.5 text-gray-900 font-bold text-sm bg-gray-50 border-x border-gray-200">{{ $item['quantity'] }}</span>
                                            <button
                                                type="submit"
                                                name="quantity"
                                                value="{{ $item['quantity'] + 1 }}"
                                                class="px-3 py-1.5 text-gray-500 hover:bg-gray-50 transition-colors focus:outline-none"
                                            >
                                                <i data-lucide="plus" class="w-3 h-3"></i>
                                            </button>
                                        </div>
                                    </form>

                                    <!-- Price & Delete -->
                                    <div class="flex items-center gap-4">
                                        <span class="font-bold text-gray-950 text-sm sm:text-base">{{ number_format($item['price'] * $item['quantity']) }} RWF</span>
                                        <form action="{{ route('cart.remove', $id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button
                                                type="submit"
                                                class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all"
                                                title="Remove item"
                                            >
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Clear Cart Action Button -->
                    <div class="text-right">
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button
                                type="submit"
                                class="text-sm font-semibold text-red-500 hover:text-red-600 transition-colors inline-flex items-center gap-1 bg-red-50 hover:bg-red-100/50 px-4 py-2 rounded-xl"
                            >
                                <i data-lucide="trash" class="w-4 h-4"></i> Clear All Cart Items
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Order Summary Panel (Col 1/3) -->
                <div>
                    <div class="bg-white rounded-3xl border border-gray-100 p-6 shadow-sm sticky top-24">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Order Summary</h3>

                        <!-- Itemized list -->
                        <div class="space-y-3 mb-6 max-h-48 overflow-y-auto pr-1">
                            @foreach($cart as $item)
                                <div class="flex justify-between text-xs font-medium">
                                    <span class="text-gray-500 truncate mr-2">{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                                    <span class="text-gray-800 font-bold whitespace-nowrap">{{ number_format($item['price'] * $item['quantity']) }} RWF</span>
                                </div>
                            @endforeach
                        </div>

                        <!-- Calculations -->
                        <div class="border-t border-gray-100 pt-4 mb-4">
                            <div class="flex justify-between text-sm mb-2 font-medium">
                                <span class="text-gray-500">Subtotal</span>
                                <span class="text-gray-700 font-bold">{{ number_format($totalPrice) }} RWF</span>
                            </div>
                            <div class="flex justify-between text-sm mb-2 font-medium">
                                <span class="text-gray-500">Delivery</span>
                                <span class="text-green-600 font-bold">Free</span>
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-4 mb-6">
                            <div class="flex justify-between items-baseline">
                                <span class="text-lg font-bold text-gray-900">Total</span>
                                <span class="text-xl font-black text-gray-950">{{ number_format($totalPrice) }} RWF</span>
                            </div>
                        </div>

                        <!-- Checkout Button -->
                        <a
                            href="{{ route('checkout.index') }}"
                            class="w-full bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white py-3.5 rounded-xl font-bold transition-all shadow-lg shadow-teal-500/20 flex items-center justify-center gap-2 active:scale-95 text-center text-sm"
                        >
                            Proceed to Checkout <i data-lucide="arrow-right" class="w-5 h-5"></i>
                        </a>

                        <!-- MoMo Notification badge -->
                        <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-xl p-3 shadow-inner">
                            <p class="text-xs text-yellow-800 font-semibold text-center flex items-center justify-center gap-1.5">
                                📱 Direct Mobile Money (MTN MoMo) USSD pull integration supported at checkout.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
