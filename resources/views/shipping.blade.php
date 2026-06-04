@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-gray-500 hover:text-teal-600 mb-4 transition-colors font-medium text-sm">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Home
            </a>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">🚚 Shipping Information</h1>
            <p class="text-gray-500">Everything you need to know about our delivery service</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Highlights -->
        <div class="grid sm:grid-cols-3 gap-4 mb-12">
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm text-center">
                <div class="w-12 h-12 bg-teal-50 text-teal-600 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i data-lucide="truck" class="w-6 h-6"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">Free Delivery in Kigali</h3>
                <p class="text-sm text-gray-500">On all orders</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm text-center">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i data-lucide="clock" class="w-6 h-6"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">Fast Processing</h3>
                <p class="text-sm text-gray-500">Orders ship within 24hrs</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm text-center">
                <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i data-lucide="package" class="w-6 h-6"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">Safe Packaging</h3>
                <p class="text-sm text-gray-500">Anti-static protection</p>
            </div>
        </div>

        <!-- Shipping Zones Table -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-8">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2"><i data-lucide="map-pin" class="w-5 h-5 text-teal-600"></i> Delivery Zones & Rates</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="text-left px-6 py-3 text-sm font-semibold text-gray-700">Destination</th>
                            <th class="text-left px-6 py-3 text-sm font-semibold text-gray-700">Delivery Time</th>
                            <th class="text-left px-6 py-3 text-sm font-semibold text-gray-700">Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t border-gray-50 bg-teal-50/50">
                            <td class="px-6 py-4 text-sm text-gray-900 font-bold">Kigali (All districts)</td>
                            <td class="px-6 py-4 text-sm text-gray-600">1 – 2 business days</td>
                            <td class="px-6 py-4 text-sm font-semibold">
                                <span class="text-green-600 bg-green-50 px-3 py-1 rounded-full text-xs font-bold">FREE</span>
                            </td>
                        </tr>
                        <tr class="border-t border-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900 font-medium">Butare (Huye)</td>
                            <td class="px-6 py-4 text-sm text-gray-600">2 – 3 business days</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">1,500 RWF</td>
                        </tr>
                        <tr class="border-t border-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900 font-medium">Musanze</td>
                            <td class="px-6 py-4 text-sm text-gray-600">2 – 3 business days</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">1,500 RWF</td>
                        </tr>
                        <tr class="border-t border-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900 font-medium">Rubavu (Gisenyi)</td>
                            <td class="px-6 py-4 text-sm text-gray-600">3 – 4 business days</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">2,000 RWF</td>
                        </tr>
                        <tr class="border-t border-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900 font-medium">Muhanga</td>
                            <td class="px-6 py-4 text-sm text-gray-600">2 – 3 business days</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">1,500 RWF</td>
                        </tr>
                        <tr class="border-t border-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900 font-medium">Nyagatare</td>
                            <td class="px-6 py-4 text-sm text-gray-600">3 – 4 business days</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">2,000 RWF</td>
                        </tr>
                        <tr class="border-t border-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900 font-medium">Other provinces</td>
                            <td class="px-6 py-4 text-sm text-gray-600">3 – 5 business days</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">2,500 RWF</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- How It Works -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-sm mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6 font-bold">How Delivery Works</h2>
            <div class="space-y-4">
                <div class="flex gap-4">
                    <div class="w-8 h-8 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0">1</div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Place Your Order</h4>
                        <p class="text-sm text-gray-500">Add items to cart and complete checkout with MTN Mobile Money.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0">2</div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Order Confirmation</h4>
                        <p class="text-sm text-gray-500">You'll receive a confirmation flash message and order logging within minutes.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0">3</div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Processing & Packing</h4>
                        <p class="text-sm text-gray-500">We carefully pack your electronics with anti-static bags and bubble wrap.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0">4</div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Shipping</h4>
                        <p class="text-sm text-gray-500">Your package is picked up by our delivery partner and dispatched.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0">5</div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Delivery</h4>
                        <p class="text-sm text-gray-500">The rider calls you before arrival. Sign to confirm receipt.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Important Notes -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-6 shadow-inner">
            <h3 class="font-bold text-yellow-900 flex items-center gap-2 mb-3"><i data-lucide="alert-circle" class="w-5 h-5 text-yellow-800"></i> Important Notes</h3>
            <ul class="space-y-2 text-sm text-yellow-800 font-medium">
                <li class="flex items-start gap-2"><i data-lucide="check-circle" class="w-4 h-4 mt-0.5 flex-shrink-0 text-yellow-700"></i> Delivery times are estimates and may vary due to weather or road conditions.</li>
                <li class="flex items-start gap-2"><i data-lucide="check-circle" class="w-4 h-4 mt-0.5 flex-shrink-0 text-yellow-700"></i> Orders placed after 2:00 PM will be processed the next business day.</li>
                <li class="flex items-start gap-2"><i data-lucide="check-circle" class="w-4 h-4 mt-0.5 flex-shrink-0 text-yellow-700"></i> Free delivery in Kigali applies to all orders regardless of amount.</li>
                <li class="flex items-start gap-2"><i data-lucide="check-circle" class="w-4 h-4 mt-0.5 flex-shrink-0 text-yellow-700"></i> You can track your order status from the "My Orders" page.</li>
            </ul>
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('products.index') }}" class="bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white px-8 py-3.5 rounded-full font-bold transition-all shadow-lg shadow-teal-500/20 inline-flex items-center gap-2 active:scale-95 text-sm">
                Start Shopping <i data-lucide="truck" class="w-4 h-4"></i>
            </a>
        </div>
    </div>
</div>
@endsection
