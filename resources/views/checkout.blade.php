@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Checkout</h1>
        
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Left Panel: Billing Form (Col 2/3) -->
            <div class="lg:col-span-2">
                <form action="{{ route('checkout.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="bg-white rounded-3xl border border-gray-100 p-6 md:p-8 shadow-sm space-y-5">
                        <h2 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-3 mb-4">
                            Delivery Details
                        </h2>
                        
                        <div>
                            <label for="phone" class="block text-xs font-bold text-gray-700 uppercase mb-1">Contact Phone Number</label>
                            <input
                                type="tel"
                                name="phone"
                                id="phone"
                                required
                                value="{{ old('phone', Auth::user()->phone ?? '') }}"
                                placeholder="0788123456"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-medium"
                            />
                        </div>

                        <div>
                            <label for="delivery_address" class="block text-xs font-bold text-gray-700 uppercase mb-1">Shipping Address / Location</label>
                            <textarea
                                name="delivery_address"
                                id="delivery_address"
                                rows="3"
                                required
                                placeholder="Kigali, Rwanda, Gikondo, House 24"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-medium"
                            >{{ old('delivery_address') }}</textarea>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl border border-gray-100 p-6 md:p-8 shadow-sm space-y-5">
                        <h2 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-3 mb-4">
                            Payment Method
                        </h2>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Mobile Money Selection -->
                            <label class="relative flex flex-col p-4 bg-gray-50 hover:bg-gray-100/50 border-2 border-teal-500 rounded-2xl cursor-pointer transition-all shadow-sm group" id="momo-label">
                                <div class="flex items-center gap-2 mb-2">
                                    <input
                                        type="radio"
                                        name="payment_method"
                                        value="momo"
                                        id="pay-momo"
                                        checked
                                        onchange="togglePaymentFields('momo')"
                                        class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300"
                                    />
                                    <span class="font-bold text-sm text-gray-900">MTN Mobile Money 📱</span>
                                </div>
                                <span class="text-xs text-gray-500 leading-relaxed font-medium">
                                    Pay instantly using MTN MoMo. We will send a secure USSD PIN request prompt to your phone.
                                </span>
                            </label>

                            <!-- Cash on Delivery Selection -->
                            <label class="relative flex flex-col p-4 bg-gray-50 hover:bg-gray-100/50 border-2 border-gray-200 rounded-2xl cursor-pointer transition-all shadow-sm group" id="cash-label">
                                <div class="flex items-center gap-2 mb-2">
                                    <input
                                        type="radio"
                                        name="payment_method"
                                        value="cash"
                                        id="pay-cash"
                                        onchange="togglePaymentFields('cash')"
                                        class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300"
                                    />
                                    <span class="font-bold text-sm text-gray-900">Cash on Delivery 💵</span>
                                </div>
                                <span class="text-xs text-gray-500 leading-relaxed font-medium">
                                    Pay with physical cash or local card payment upon physical delivery of components at your doorstep.
                                </span>
                            </label>
                        </div>

                        <!-- Dynamic MoMo Phone Number Input -->
                        <div id="momo-phone-container" class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-2xl shadow-inner">
                            <label for="payment_phone" class="block text-xs font-bold text-yellow-800 uppercase mb-1">MTN MoMo Number (For Payment Trigger)</label>
                            <input
                                type="tel"
                                name="payment_phone"
                                id="payment_phone"
                                value="{{ old('payment_phone', Auth::user()->phone ?? '') }}"
                                placeholder="078xxxxxxx or 079xxxxxxx"
                                class="w-full bg-white border border-yellow-300 rounded-xl py-3 px-4 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-semibold"
                            />
                            <p class="text-xxs text-yellow-700 mt-2 font-medium">
                                📢 Important: The backend will simulate pushing an MTN USSD prompt message asking you to approve the RWF amount.
                            </p>
                        </div>
                    </div>

                    <!-- Submit checkout form -->
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white font-bold py-3.5 rounded-2xl transition-all shadow-lg shadow-teal-500/20 active:scale-95 text-center text-sm flex items-center justify-center gap-2"
                    >
                        <i data-lucide="shield-check" class="w-5 h-5"></i> Place Order & Proceed
                    </button>
                </form>
            </div>

            <!-- Right Panel: Order Items Summary (Col 1/3) -->
            <div>
                <div class="bg-white rounded-3xl border border-gray-100 p-6 shadow-sm sticky top-24 space-y-6">
                    <h3 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-3">Order Summary</h3>
                    
                    <!-- Items -->
                    <div class="space-y-4 max-h-60 overflow-y-auto pr-1">
                        @foreach($cart as $id => $item)
                            <div class="flex items-center gap-3">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-12 h-12 object-cover rounded-lg border border-gray-100 bg-gray-50 flex-shrink-0">
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-xs font-bold text-gray-800 truncate">{{ $item['name'] }}</h4>
                                    <p class="text-xxs text-gray-400 font-medium">Qty: {{ $item['quantity'] }} × {{ number_format($item['price']) }} RWF</p>
                                </div>
                                <span class="text-xs font-bold text-gray-900 whitespace-nowrap">{{ number_format($item['price'] * $item['quantity']) }} RWF</span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Final Total -->
                    <div class="border-t border-gray-100 pt-4 space-y-2">
                        <div class="flex justify-between text-xs font-medium text-gray-500">
                            <span>Subtotal</span>
                            <span>{{ number_format($totalPrice) }} RWF</span>
                        </div>
                        <div class="flex justify-between text-xs font-medium text-gray-500">
                            <span>Shipping</span>
                            <span class="text-green-600 font-bold">Free</span>
                        </div>
                        <div class="border-t border-gray-50 pt-2 flex justify-between items-baseline">
                            <span class="text-sm font-bold text-gray-900">Total Price</span>
                            <span class="text-base font-black text-teal-600">{{ number_format($totalPrice) }} RWF</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePaymentFields(method) {
        const momoContainer = document.getElementById('momo-phone-container');
        const paymentPhoneInput = document.getElementById('payment_phone');
        const momoLabel = document.getElementById('momo-label');
        const cashLabel = document.getElementById('cash-label');

        if (method === 'momo') {
            momoContainer.classList.remove('hidden');
            paymentPhoneInput.setAttribute('required', 'required');
            
            momoLabel.classList.remove('border-gray-200');
            momoLabel.classList.add('border-teal-500');
            
            cashLabel.classList.remove('border-teal-500');
            cashLabel.classList.add('border-gray-200');
        } else {
            momoContainer.classList.add('hidden');
            paymentPhoneInput.removeAttribute('required');
            
            cashLabel.classList.remove('border-gray-200');
            cashLabel.classList.add('border-teal-500');
            
            momoLabel.classList.remove('border-teal-500');
            momoLabel.classList.add('border-gray-200');
        }
    }

    // Run onload to match default form states
    document.addEventListener('DOMContentLoaded', () => {
        const payMomo = document.getElementById('pay-momo');
        if (payMomo && payMomo.checked) {
            togglePaymentFields('momo');
        } else {
            togglePaymentFields('cash');
        }
    });
</script>
@endsection
