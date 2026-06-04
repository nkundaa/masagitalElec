@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <h1 class="text-3xl font-bold text-gray-900 mb-8">My Orders</h1>
        
        @if($orders->isEmpty())
            <!-- Empty Orders State -->
            <div class="text-center py-16 bg-white border border-gray-100 rounded-3xl p-8 shadow-sm">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="package" class="w-12 h-12 text-gray-300"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">No orders found</h2>
                <p class="text-gray-500 mb-8">You haven't placed any orders yet. Build your first electronic kit today!</p>
                <a
                    href="{{ route('products.index') }}"
                    class="bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white px-8 py-3.5 rounded-full font-semibold transition-all inline-flex items-center gap-2 shadow-lg shadow-teal-500/20 active:scale-95"
                >
                    <i data-lucide="shopping-bag" class="w-5 h-5"></i> Browse Products
                </a>
            </div>
        @else
            <!-- Orders List -->
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                        
                        <!-- Order Header Banner -->
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex flex-wrap items-center justify-between gap-4">
                            <div>
                                <span class="text-xs text-gray-400 font-bold block uppercase tracking-wider">Order ID</span>
                                <span class="font-extrabold text-gray-900 text-sm sm:text-base">{{ $order->id }}</span>
                            </div>
                            
                            <div>
                                <span class="text-xs text-gray-400 font-bold block uppercase tracking-wider">Date Placed</span>
                                <span class="font-semibold text-gray-800 text-sm">{{ $order->created_at->format('F d, Y \a\t g:i A') }}</span>
                            </div>

                            <!-- Payment status pills -->
                            <div>
                                @if($order->status === 'paid')
                                    <span class="inline-flex items-center gap-1 bg-green-50 border border-green-100 text-green-700 text-xs font-bold px-3 py-1.5 rounded-full">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Paid & Confirmed
                                    </span>
                                @elseif($order->status === 'pending_payment')
                                    <span class="inline-flex items-center gap-1 bg-yellow-50 border border-yellow-100 text-yellow-700 text-xs font-bold px-3 py-1.5 rounded-full animate-pulse">
                                        <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></span> Pending Payment
                                    </span>
                                @elseif($order->status === 'cancelled')
                                    <span class="inline-flex items-center gap-1 bg-red-50 border border-red-100 text-red-700 text-xs font-bold px-3 py-1.5 rounded-full">
                                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span> Cancelled
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 bg-teal-50 border border-teal-100 text-teal-700 text-xs font-bold px-3 py-1.5 rounded-full">
                                        <span class="w-1.5 h-1.5 bg-teal-500 rounded-full"></span> Confirmed
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Order Details Body -->
                        <div class="p-6 space-y-6">
                            <!-- Items list loops -->
                            <div class="space-y-4">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Items Purchased</h3>
                                @foreach($order->items as $item)
                                    <div class="flex items-center justify-between text-sm py-1 border-b border-gray-50 last:border-none">
                                        <div class="min-w-0 flex-1">
                                            <span class="font-bold text-gray-800">{{ $item->name }}</span>
                                            <span class="text-xs text-gray-400 ml-2">× {{ $item->quantity }}</span>
                                        </div>
                                        <span class="font-bold text-gray-900 whitespace-nowrap">{{ number_format($item->price * $item->quantity) }} RWF</span>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Delivery Details section -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-2xl border border-gray-100 text-xs">
                                <div>
                                    <h4 class="font-bold text-gray-400 uppercase mb-1.5">Shipping Details</h4>
                                    <p class="text-gray-800 font-semibold leading-relaxed">{{ $order->delivery_address }}</p>
                                </div>
                                <div class="space-y-1">
                                    <div>
                                        <span class="font-bold text-gray-400 uppercase">Contact Phone: </span>
                                        <span class="text-gray-800 font-semibold">{{ $order->phone }}</span>
                                    </div>
                                    <div>
                                        <span class="font-bold text-gray-400 uppercase">Payment Method: </span>
                                        <span class="text-gray-800 font-semibold capitalize">
                                            {{ $order->payment_method === 'momo' ? 'MTN Mobile Money' : 'Cash on Delivery' }}
                                        </span>
                                    </div>
                                    @if($order->payment_phone)
                                        <div>
                                            <span class="font-bold text-gray-400 uppercase">MoMo Number: </span>
                                            <span class="text-gray-800 font-semibold">{{ $order->payment_phone }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Footer block: Total summary -->
                            <div class="flex items-baseline justify-between border-t border-gray-100 pt-4">
                                <span class="text-sm font-bold text-gray-500">Order Bill Total</span>
                                <span class="text-lg font-black text-gray-900">{{ number_format($order->total) }} RWF</span>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
