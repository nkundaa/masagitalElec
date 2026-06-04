@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-gray-500 hover:text-teal-600 mb-4 transition-colors font-medium text-sm">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Home
            </a>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">🔄 Returns & Refund Policy</h1>
            <p class="text-gray-500">Your satisfaction is our priority</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Highlights -->
        <div class="grid sm:grid-cols-3 gap-4 mb-12">
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm text-center">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i data-lucide="clock" class="w-6 h-6"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">7-Day Returns</h3>
                <p class="text-sm text-gray-500">From date of delivery</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm text-center">
                <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i data-lucide="shield" class="w-6 h-6"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">Quality Guaranteed</h3>
                <p class="text-sm text-gray-500">All products tested</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm text-center">
                <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i data-lucide="rotate-ccw" class="w-6 h-6"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">Easy Process</h3>
                <p class="text-sm text-gray-500">Simple return steps</p>
            </div>
        </div>

        <!-- Return Policy -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-sm mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Return Policy</h2>
            <div class="prose prose-gray max-w-none">
                <p class="text-gray-600 leading-relaxed mb-4 text-sm font-medium">
                    At Masagital Electronics, we want you to be completely satisfied with your purchase. If something isn't right, we're here to help. You may return most items within <strong>7 days of delivery</strong> for a full refund or exchange.
                </p>
            </div>

            <h3 class="font-bold text-gray-900 mt-6 mb-4 flex items-center gap-2 text-sm uppercase tracking-wider text-green-700">
                <i data-lucide="check-circle" class="w-5 h-5 text-green-500 flex-shrink-0"></i> Eligible for Return
            </h3>
            <ul class="space-y-2 mb-6">
                <li class="flex items-start gap-2 text-sm text-gray-600 font-semibold">
                    <i data-lucide="check-circle" class="w-4 h-4 text-green-500 mt-0.5 flex-shrink-0"></i>
                    Defective or damaged products on arrival
                </li>
                <li class="flex items-start gap-2 text-sm text-gray-600 font-semibold">
                    <i data-lucide="check-circle" class="w-4 h-4 text-green-500 mt-0.5 flex-shrink-0"></i>
                    Wrong item received (different from what you ordered)
                </li>
                <li class="flex items-start gap-2 text-sm text-gray-600 font-semibold">
                    <i data-lucide="check-circle" class="w-4 h-4 text-green-500 mt-0.5 flex-shrink-0"></i>
                    Product not matching the description on the website
                </li>
                <li class="flex items-start gap-2 text-sm text-gray-600 font-semibold">
                    <i data-lucide="check-circle" class="w-4 h-4 text-green-500 mt-0.5 flex-shrink-0"></i>
                    Dead on arrival (DOA) components
                </li>
                <li class="flex items-start gap-2 text-sm text-gray-600 font-semibold">
                    <i data-lucide="check-circle" class="w-4 h-4 text-green-500 mt-0.5 flex-shrink-0"></i>
                    Unopened items in original packaging
                </li>
            </ul>

            <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2 text-sm uppercase tracking-wider text-red-700">
                <i data-lucide="x-circle" class="w-5 h-5 text-red-500 flex-shrink-0"></i> Not Eligible for Return
            </h3>
            <ul class="space-y-2">
                <li class="flex items-start gap-2 text-sm text-gray-600 font-semibold">
                    <i data-lucide="x-circle" class="w-4 h-4 text-red-400 mt-0.5 flex-shrink-0"></i>
                    Products damaged due to misuse, improper wiring, or negligence
                </li>
                <li class="flex items-start gap-2 text-sm text-gray-600 font-semibold">
                    <i data-lucide="x-circle" class="w-4 h-4 text-red-400 mt-0.5 flex-shrink-0"></i>
                    Components that have been soldered or physically modified
                </li>
                <li class="flex items-start gap-2 text-sm text-gray-600 font-semibold">
                    <i data-lucide="x-circle" class="w-4 h-4 text-red-400 mt-0.5 flex-shrink-0"></i>
                    Items returned after 7 days from delivery date
                </li>
                <li class="flex items-start gap-2 text-sm text-gray-600 font-semibold">
                    <i data-lucide="x-circle" class="w-4 h-4 text-red-400 mt-0.5 flex-shrink-0"></i>
                    Products without original packaging or missing accessories
                </li>
                <li class="flex items-start gap-2 text-sm text-gray-600 font-semibold">
                    <i data-lucide="x-circle" class="w-4 h-4 text-red-400 mt-0.5 flex-shrink-0"></i>
                    Software or downloadable products
                </li>
            </ul>
        </div>

        <!-- Return Process -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-sm mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6 font-bold">How to Return an Item</h2>
            <div class="space-y-4">
                <div class="flex gap-4">
                    <div class="w-8 h-8 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0">1</div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Contact Us</h4>
                        <p class="text-sm text-gray-500">Send us a message via WhatsApp, email, or the contact form with your order number and reason for return.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0">2</div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Get Approval</h4>
                        <p class="text-sm text-gray-500">Our team will review your request and send you a return approval within 24 hours.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0">3</div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Pack the Item</h4>
                        <p class="text-sm text-gray-500">Place the item in its original packaging with all accessories included.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0">4</div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Ship or Drop Off</h4>
                        <p class="text-sm text-gray-500">Ship the item to our Kigali office or drop it off in person. We'll cover return shipping for defective items.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0">5</div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Refund Processed</h4>
                        <p class="text-sm text-gray-500">Once we receive and inspect the item, your refund will be sent to your MTN Mobile Money within 2-3 business days.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Warning -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-6 mb-8 shadow-inner">
            <h3 class="font-bold text-yellow-900 flex items-center gap-2 mb-3"><i data-lucide="alert-triangle" class="w-5 h-5 text-yellow-800"></i> Important</h3>
            <p class="text-sm text-yellow-800 font-medium">
                All electronic components are tested before shipping. If you receive a defective product, please take a photo/video of the issue and include it when contacting us. This helps us process your return faster.
            </p>
        </div>

        <div class="text-center">
            <p class="text-gray-500 mb-4 font-semibold text-sm">Have questions about a return?</p>
            <a href="{{ route('contact.index') }}" class="bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white px-8 py-3 rounded-full font-bold transition-all shadow-lg shadow-teal-500/20 inline-flex items-center gap-2 active:scale-95 text-sm">
                Contact Support
            </a>
        </div>
    </div>
</div>
@endsection
