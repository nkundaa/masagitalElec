@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-950 text-white py-12 px-4 flex items-center justify-center">
    <div class="max-w-4xl w-full bg-gray-900/60 backdrop-blur-xl border border-gray-800 rounded-3xl p-6 md:p-10 shadow-2xl grid md:grid-cols-2 gap-8 md:gap-12 items-center">
        
        <!-- Left Column: Instructions and Status -->
        <div class="space-y-6">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-yellow-400 rounded-2xl flex items-center justify-center text-gray-950 font-bold shadow-lg shadow-yellow-400/20">
                    MTN
                </div>
                <div>
                    <h1 class="text-xl font-extrabold tracking-tight">Mobile Money Gateway</h1>
                    <p class="text-xs text-gray-400 font-medium">Order Reference: {{ $order->id }}</p>
                </div>
            </div>

            <div class="space-y-4">
                <h2 class="text-2xl font-black text-white leading-tight">
                    Authorizing Payment...
                </h2>
                
                <!-- Status Logs (Interactive transitions) -->
                <div class="space-y-3 text-sm">
                    <div class="flex items-center gap-2 text-teal-400" id="status-1">
                        <i data-lucide="check-circle-2" class="w-4 h-4 flex-shrink-0"></i>
                        <span class="font-semibold">Order created successfully.</span>
                    </div>
                    <div class="flex items-center gap-2 text-teal-400" id="status-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4 flex-shrink-0"></i>
                        <span class="font-semibold">Initiated secure USSD connection.</span>
                    </div>
                    <div class="flex items-center gap-2 text-yellow-400" id="status-3">
                        <div class="w-4 h-4 flex items-center justify-center flex-shrink-0" id="status-spinner-container">
                            <svg class="animate-spin h-3.5 w-3.5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-teal-400 hidden" id="status-check-3"></i>
                        <span class="font-semibold" id="status-text-3">Sending USSD Push to +250 {{ $order->payment_phone }}...</span>
                    </div>
                </div>
            </div>

            <!-- Warning Notice -->
            <div class="bg-gray-800/40 border border-gray-700/50 rounded-2xl p-4 text-xs text-gray-300 leading-relaxed font-medium">
                ⚠️ <span class="text-white font-bold">Do not refresh this page.</span> We have requested an MTN Mobile Money authorization prompt on the device corresponding to the phone number entered. Enter your PIN on the device screen (simulated on the right) to complete the transaction.
            </div>

            <div class="pt-4 border-t border-gray-800 flex justify-between text-sm font-semibold">
                <span class="text-gray-400">Total Bill Amount</span>
                <span class="text-yellow-400 text-lg">{{ number_format($order->total) }} RWF</span>
            </div>
        </div>

        <!-- Right Column: Interactive Phone Mockup -->
        <div class="flex justify-center">
            <!-- Smartphone frame mockup -->
            <div class="w-72 h-[500px] bg-gray-800 rounded-[3rem] border-4 border-gray-700 shadow-2xl p-3 relative flex flex-col items-center justify-between overflow-hidden">
                <!-- Notch Speaker -->
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-28 h-5 bg-gray-800 rounded-b-2xl z-30 flex items-center justify-center">
                    <div class="w-12 h-1 bg-gray-700 rounded-full"></div>
                </div>

                <!-- Screen Contents -->
                <div class="w-full h-full bg-yellow-400/90 rounded-[2.2rem] p-4 flex flex-col justify-between items-center relative overflow-hidden text-gray-950 font-sans z-10">
                    
                    <!-- Top Phone Banner -->
                    <div class="w-full flex justify-between text-[10px] font-bold text-gray-800 pt-1">
                        <span>MTN RW 🇷🇼</span>
                        <span>12:00 PM</span>
                        <div class="flex items-center gap-1">
                            <i data-lucide="wifi" class="w-3 h-3"></i>
                            <i data-lucide="battery" class="w-3 h-3"></i>
                        </div>
                    </div>

                    <!-- Screen Area Dynamic Content -->
                    <div class="w-full flex-grow flex items-center justify-center px-2 py-4">
                        
                        <!-- Initial Network Waiting / Loading Screen -->
                        <div id="phone-loader" class="text-center space-y-3 flex flex-col items-center justify-center">
                            <div class="w-10 h-10 rounded-full border-4 border-gray-900/30 border-t-gray-950 animate-spin"></div>
                            <p class="text-xs font-bold text-gray-800">Waiting for USSD Prompt...</p>
                        </div>

                        <!-- USSD Prompt Window (Displays after mock timeout) -->
                        <div id="phone-ussd-popup" class="hidden w-full bg-white rounded-2xl p-4 shadow-xl border border-gray-100 flex flex-col justify-between space-y-4 animate-fade-in">
                            <div>
                                <h3 class="text-xs font-black text-gray-500 uppercase tracking-wider mb-2 border-b border-gray-100 pb-1">
                                    MTN Mobile Money
                                </h3>
                                <p class="text-xs font-semibold text-gray-800 leading-normal mb-1">
                                    Do you want to pay Masagital Electronics RWF {{ number_format($order->total) }}?
                                </p>
                                <p class="text-[10px] text-gray-500 font-bold mb-3">
                                    Enter your 5-digit MTN MoMo PIN to authorize:
                                </p>

                                <form action="{{ route('checkout.momo.approve', $order->id) }}" method="POST" id="momo-pin-form">
                                    @csrf
                                    <input
                                        type="password"
                                        name="pin"
                                        id="momo-pin"
                                        maxlength="5"
                                        pattern="\d{5}"
                                        required
                                        placeholder="•••••"
                                        class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl py-2 px-3 text-center text-lg font-black tracking-widest text-gray-900 focus:outline-none focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all"
                                    />
                                    <span class="text-[9px] text-red-500 font-bold hidden mt-1 text-center block" id="pin-error-helper">
                                        Please enter exactly 5 digits.
                                    </span>
                                </form>
                            </div>

                            <div class="flex gap-2">
                                <!-- Simulated cancel button -->
                                <form action="{{ route('checkout.momo.cancel', $order->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="w-full py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-xs rounded-xl transition-all text-center"
                                    >
                                        Cancel
                                    </button>
                                </form>

                                <!-- Simulated approve button -->
                                <button
                                    type="button"
                                    onclick="submitPinForm()"
                                    class="flex-1 py-2 bg-yellow-400 hover:bg-yellow-500 text-gray-950 font-black text-xs rounded-xl shadow-md transition-all text-center"
                                >
                                    Approve
                                </button>
                            </div>
                        </div>

                    </div>

                    <!-- Mock Bottom Navigation Indicator Bar -->
                    <div class="w-24 h-1 bg-gray-800 rounded-full mb-1"></div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function submitPinForm() {
        const pinInput = document.getElementById('momo-pin');
        const helper = document.getElementById('pin-error-helper');
        
        if (pinInput.value.length === 5 && /^\d+$/.test(pinInput.value)) {
            helper.classList.add('hidden');
            document.getElementById('momo-pin-form').submit();
        } else {
            helper.classList.remove('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Simulate network latency (2.5 seconds) before the USSD popup displays
        setTimeout(() => {
            const loader = document.getElementById('phone-loader');
            const ussdPopup = document.getElementById('phone-ussd-popup');
            
            if (loader && ussdPopup) {
                // Hide loader, show USSD popup
                loader.classList.add('hidden');
                ussdPopup.classList.remove('hidden');
                
                // Play a brief mock notify bell sound if supported, or vibrate
                if (window.navigator && window.navigator.vibrate) {
                    window.navigator.vibrate([100, 50, 100]);
                }

                // Update logs on the left column
                const checkSpinner = document.getElementById('status-spinner-container');
                const checkCheck = document.getElementById('status-check-3');
                const checkText = document.getElementById('status-text-3');
                const checkDiv = document.getElementById('status-3');

                if (checkSpinner && checkCheck) {
                    checkSpinner.classList.add('hidden');
                    checkCheck.classList.remove('hidden');
                    checkText.innerText = "USSD Prompt sent to phone +250 {{ $order->payment_phone }}.";
                    checkDiv.classList.remove('text-yellow-400');
                    checkDiv.classList.add('text-teal-400');
                }
            }
        }, 2500);
    });
</script>
@endsection
