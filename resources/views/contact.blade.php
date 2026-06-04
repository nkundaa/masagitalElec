@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Contact Us</h1>
        
        <div class="grid md:grid-cols-3 gap-8 items-start">
            
            <!-- Contact Info Panel (Col 1/3) -->
            <div class="bg-gray-900 text-white rounded-3xl p-6 shadow-sm space-y-6">
                <h2 class="text-lg font-bold border-b border-gray-800 pb-2">Get in Touch</h2>
                
                <div class="space-y-4 text-xs font-medium text-gray-300">
                    <div class="flex items-start gap-2.5">
                        <i data-lucide="map-pin" class="w-4 h-4 text-teal-400 mt-0.5 flex-shrink-0"></i>
                        <div>
                            <p class="font-bold text-white">Location</p>
                            <p>Kigali, Rwanda</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-2.5">
                        <i data-lucide="phone" class="w-4 h-4 text-teal-400 mt-0.5 flex-shrink-0"></i>
                        <div>
                            <p class="font-bold text-white">Phone</p>
                            <a href="tel:+250780000000" class="hover:text-teal-400 transition-colors">+250 780 000 000</a>
                        </div>
                    </div>

                    <div class="flex items-start gap-2.5">
                        <i data-lucide="mail" class="w-4 h-4 text-teal-400 mt-0.5 flex-shrink-0"></i>
                        <div>
                            <p class="font-bold text-white">Email Address</p>
                            <a href="mailto:info@masagital.rw" class="hover:text-teal-400 transition-colors">info@masagital.rw</a>
                        </div>
                    </div>

                    <div class="flex items-start gap-2.5">
                        <i data-lucide="clock" class="w-4 h-4 text-teal-400 mt-0.5 flex-shrink-0"></i>
                        <div>
                            <p class="font-bold text-white">Opening Hours</p>
                            <p>Mon – Sat: 8:00 AM – 6:00 PM</p>
                            <p>Sunday: Closed</p>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-800 pt-4 text-center">
                    <a
                        href="https://wa.me/250780000000"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-xl text-xs transition-colors inline-flex items-center justify-center gap-1.5"
                    >
                        💬 Chat on WhatsApp
                    </a>
                </div>
            </div>

            <!-- Form Panel (Col 2/3) -->
            <div class="md:col-span-2 bg-white rounded-3xl border border-gray-100 p-6 md:p-8 shadow-sm">
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <h2 class="text-lg font-bold text-gray-900 border-b border-gray-50 pb-2 mb-4">Send a Message</h2>
                    
                    <div>
                        <label for="name" class="block text-xs font-bold text-gray-700 uppercase mb-1">Your Name</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            required
                            value="{{ old('name', Auth::user()->name ?? '') }}"
                            placeholder="Kevine Keza"
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-medium"
                        />
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-bold text-gray-700 uppercase mb-1">Email Address</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            required
                            value="{{ old('email', Auth::user()->email ?? '') }}"
                            placeholder="kevine@example.com"
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-medium"
                        />
                    </div>

                    <div>
                        <label for="subject" class="block text-xs font-bold text-gray-700 uppercase mb-1">Subject</label>
                        <input
                            type="text"
                            name="subject"
                            id="subject"
                            value="{{ old('subject') }}"
                            placeholder="Technical inquiry on Arduino boards"
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-medium"
                        />
                    </div>

                    <div>
                        <label for="message" class="block text-xs font-bold text-gray-700 uppercase mb-1">Your Message</label>
                        <textarea
                            name="message"
                            id="message"
                            rows="4"
                            required
                            placeholder="Type your message details here..."
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-medium"
                        >{{ old('message') }}</textarea>
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white font-bold py-3.5 rounded-xl transition-all shadow-lg shadow-teal-500/20 active:scale-95 text-center text-sm flex items-center justify-center gap-2"
                    >
                        <i data-lucide="send" class="w-4 h-4"></i> Submit Message
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
