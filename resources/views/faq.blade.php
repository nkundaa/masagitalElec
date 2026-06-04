@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-gray-500 hover:text-teal-600 mb-4 transition-colors font-medium text-sm">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Home
            </a>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">❓ Frequently Asked Questions</h1>
            <p class="text-gray-500">Find answers to common questions about our products and services</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- FAQ Search (local filtering in vanilla JS) -->
        <div class="relative mb-10">
            <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"></i>
            <input
                type="text"
                id="faq-search"
                placeholder="Search questions..."
                onkeyup="filterFaqs()"
                class="w-full pl-12 pr-4 py-4 bg-white border border-gray-200 rounded-2xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent shadow-sm text-lg"
            />
        </div>

        <div id="faq-categories-container" class="space-y-8">
            
            <!-- Category: Orders & Payment -->
            <div class="faq-category-block">
                <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <span>🛒</span> Orders & Payment
                </h2>
                <div class="space-y-2">
                    <div class="faq-item bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                        <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between px-6 py-4 text-left font-semibold text-gray-900">
                            <span>How do I place an order?</span>
                            <i data-lucide="chevron-down" class="w-5 h-5 text-gray-400 flex-shrink-0 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-sm text-gray-600 leading-relaxed border-t border-gray-50 pt-3">
                            Browse our products, add items to your cart, then proceed to checkout. Fill in your delivery details and pay using MTN Mobile Money. You'll receive a confirmation SMS once your order is placed.
                        </div>
                    </div>
                    <div class="faq-item bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                        <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between px-6 py-4 text-left font-semibold text-gray-900">
                            <span>What payment methods do you accept?</span>
                            <i data-lucide="chevron-down" class="w-5 h-5 text-gray-400 flex-shrink-0 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-sm text-gray-600 leading-relaxed border-t border-gray-50 pt-3">
                            We currently accept MTN Mobile Money as our primary payment method. Simply enter your MoMo phone number and PIN during checkout. The payment is processed securely and instantly.
                        </div>
                    </div>
                    <div class="faq-item bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                        <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between px-6 py-4 text-left font-semibold text-gray-900">
                            <span>Can I cancel my order?</span>
                            <i data-lucide="chevron-down" class="w-5 h-5 text-gray-400 flex-shrink-0 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-sm text-gray-600 leading-relaxed border-t border-gray-50 pt-3">
                            Yes, you can cancel your order within 2 hours of placing it by contacting us via WhatsApp or phone. Once the order has been dispatched, cancellation is no longer possible, but you can initiate a return.
                        </div>
                    </div>
                    <div class="faq-item bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                        <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between px-6 py-4 text-left font-semibold text-gray-900">
                            <span>Are prices inclusive of tax?</span>
                            <i data-lucide="chevron-down" class="w-5 h-5 text-gray-400 flex-shrink-0 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-sm text-gray-600 leading-relaxed border-t border-gray-50 pt-3">
                            Yes, all prices displayed on our website are final prices inclusive of VAT. The price you see is the price you pay — no hidden fees.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category: Shipping & Delivery -->
            <div class="faq-category-block">
                <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <span>🚚</span> Shipping & Delivery
                </h2>
                <div class="space-y-2">
                    <div class="faq-item bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                        <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between px-6 py-4 text-left font-semibold text-gray-900">
                            <span>How long does delivery take?</span>
                            <i data-lucide="chevron-down" class="w-5 h-5 text-gray-400 flex-shrink-0 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-sm text-gray-600 leading-relaxed border-t border-gray-50 pt-3">
                            Delivery within Kigali takes 1-2 business days. Other provinces take 2-5 business days depending on your location. Orders placed before 2:00 PM are processed the same day.
                        </div>
                    </div>
                    <div class="faq-item bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                        <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between px-6 py-4 text-left font-semibold text-gray-900">
                            <span>Is delivery free?</span>
                            <i data-lucide="chevron-down" class="w-5 h-5 text-gray-400 flex-shrink-0 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-sm text-gray-600 leading-relaxed border-t border-gray-50 pt-3">
                            Delivery within Kigali is completely FREE on all orders. For other cities and provinces, delivery fees range from 1,500 RWF to 2,500 RWF depending on the destination.
                        </div>
                    </div>
                    <div class="faq-item bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                        <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between px-6 py-4 text-left font-semibold text-gray-900">
                            <span>Can I track my order?</span>
                            <i data-lucide="chevron-down" class="w-5 h-5 text-gray-400 flex-shrink-0 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-sm text-gray-600 leading-relaxed border-t border-gray-50 pt-3">
                            Yes! Once your order is shipped, you can track its status from the "My Orders" page in your account. You'll also receive SMS updates at each stage of delivery.
                        </div>
                    </div>
                    <div class="faq-item bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                        <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between px-6 py-4 text-left font-semibold text-gray-900">
                            <span>Do you deliver outside Rwanda?</span>
                            <i data-lucide="chevron-down" class="w-5 h-5 text-gray-400 flex-shrink-0 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-sm text-gray-600 leading-relaxed border-t border-gray-50 pt-3">
                            Currently, we only deliver within Rwanda. We're working on expanding to East Africa soon. Stay tuned for updates!
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category: Products & Technical -->
            <div class="faq-category-block">
                <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <span>🔧</span> Products & Technical
                </h2>
                <div class="space-y-2">
                    <div class="faq-item bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                        <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between px-6 py-4 text-left font-semibold text-gray-900">
                            <span>Are your products original/genuine?</span>
                            <i data-lucide="chevron-down" class="w-5 h-5 text-gray-400 flex-shrink-0 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-sm text-gray-600 leading-relaxed border-t border-gray-50 pt-3">
                            Yes, all our products are 100% genuine and sourced from authorized distributors. Every component is tested before shipping to ensure quality and functionality.
                        </div>
                    </div>
                    <div class="faq-item bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                        <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between px-6 py-4 text-left font-semibold text-gray-900">
                            <span>Do you provide tutorials for products?</span>
                            <i data-lucide="chevron-down" class="w-5 h-5 text-gray-400 flex-shrink-0 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-sm text-gray-600 leading-relaxed border-t border-gray-50 pt-3">
                            Absolutely! Every product page includes a detailed tutorial section with step-by-step wiring guides, code examples, and embedded YouTube video tutorials to help you get started.
                        </div>
                    </div>
                    <div class="faq-item bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                        <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between px-6 py-4 text-left font-semibold text-gray-900">
                            <span>I'm a beginner. What should I start with?</span>
                            <i data-lucide="chevron-down" class="w-5 h-5 text-gray-400 flex-shrink-0 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-sm text-gray-600 leading-relaxed border-t border-gray-50 pt-3">
                            We recommend starting with an Arduino Uno R3 board. It's the most beginner-friendly microcontroller with tons of tutorials available. Pair it with basic sensors like the DHT22 or HC-SR04 for your first project!
                        </div>
                    </div>
                    <div class="faq-item bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                        <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between px-6 py-4 text-left font-semibold text-gray-900">
                            <span>Do you offer bulk discounts for schools or institutions?</span>
                            <i data-lucide="chevron-down" class="w-5 h-5 text-gray-400 flex-shrink-0 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-sm text-gray-600 leading-relaxed border-t border-gray-50 pt-3">
                            Yes! We offer special pricing for educational institutions, makerspaces, and bulk orders of 10+ units. Contact us via email or WhatsApp to discuss your needs.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category: Returns & Warranty -->
            <div class="faq-category-block">
                <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <span>🔄</span> Returns & Warranty
                </h2>
                <div class="space-y-2">
                    <div class="faq-item bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                        <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between px-6 py-4 text-left font-semibold text-gray-900">
                            <span>What is your return policy?</span>
                            <i data-lucide="chevron-down" class="w-5 h-5 text-gray-400 flex-shrink-0 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-sm text-gray-600 leading-relaxed border-t border-gray-50 pt-3">
                            You can return products within 7 days of delivery if they are defective, damaged, or not as described. Items must be in original packaging. Refunds are processed via MTN Mobile Money within 2-3 business days.
                        </div>
                    </div>
                    <div class="faq-item bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                        <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between px-6 py-4 text-left font-semibold text-gray-900">
                            <span>Do products come with a warranty?</span>
                            <i data-lucide="chevron-down" class="w-5 h-5 text-gray-400 flex-shrink-0 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-sm text-gray-600 leading-relaxed border-t border-gray-50 pt-3">
                            Yes, all products come with a minimum 30-day warranty against manufacturing defects. Some products have extended warranties — check the product page for details.
                        </div>
                    </div>
                    <div class="faq-item bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                        <button onclick="toggleFaq(this)" class="w-full flex items-center justify-between px-6 py-4 text-left font-semibold text-gray-900">
                            <span>My component isn't working. What should I do?</span>
                            <i data-lucide="chevron-down" class="w-5 h-5 text-gray-400 flex-shrink-0 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4 text-sm text-gray-600 leading-relaxed border-t border-gray-50 pt-3">
                            First, double-check your wiring and code using our tutorials. If the issue persists, contact our tech support via WhatsApp with photos/videos of your setup. If the component is defective, we'll replace it.
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- No Matching Results Message -->
        <div id="faq-empty-state" class="hidden text-center py-12">
            <div class="text-5xl mb-4">🤔</div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">No matching questions found</h3>
            <p class="text-gray-500 mb-6">Try a different search term or browse the categories below.</p>
            <button onclick="clearFaqSearch()" class="text-teal-600 font-medium hover:underline">Clear search</button>
        </div>

        <!-- Call-to-action assistance container -->
        <div class="mt-12 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-2xl p-8 text-center text-white shadow-xl">
            <h3 class="text-xl font-bold mb-2">Still have questions?</h3>
            <p class="text-teal-100 mb-6 font-medium text-sm">Our support team is always online to help you with technical or sales inquiries.</p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('contact.index') }}" class="bg-white text-teal-600 px-6 py-3 rounded-xl font-bold hover:bg-teal-50 transition-colors inline-flex items-center gap-2 justify-center shadow-md active:scale-95 text-sm">
                    <i data-lucide="message-square" class="w-4 h-4"></i> Contact Us
                </a>
                <a href="https://wa.me/250780000000" target="_blank" rel="noopener noreferrer" class="bg-green-500 text-white px-6 py-3 rounded-xl font-bold hover:bg-green-600 transition-colors inline-flex items-center gap-2 justify-center shadow-md active:scale-95 text-sm">
                    <i data-lucide="message-square" class="w-4 h-4"></i> WhatsApp Chat
                </a>
            </div>
        </div>

    </div>
</div>

<script>
    function toggleFaq(btn) {
        const answer = btn.nextElementSibling;
        const icon = btn.querySelector('[data-lucide="chevron-down"]');
        
        answer.classList.toggle('hidden');
        if (icon) {
            icon.classList.toggle('rotate-180');
        }
    }

    function filterFaqs() {
        const query = document.getElementById('faq-search').value.toLowerCase().trim();
        const categories = document.querySelectorAll('.faq-category-block');
        let totalVisibleQuestions = 0;

        categories.forEach(block => {
            const items = block.querySelectorAll('.faq-item');
            let blockVisibleQuestions = 0;

            items.forEach(item => {
                const questionText = item.querySelector('button span').innerText.toLowerCase();
                const answerText = item.querySelector('.faq-answer').innerText.toLowerCase();

                if (questionText.includes(query) || answerText.includes(query)) {
                    item.classList.remove('hidden');
                    blockVisibleQuestions++;
                    totalVisibleQuestions++;
                } else {
                    item.classList.add('hidden');
                }
            });

            if (blockVisibleQuestions > 0) {
                block.classList.remove('hidden');
            } else {
                block.classList.add('hidden');
            }
        });

        const emptyState = document.getElementById('faq-empty-state');
        if (totalVisibleQuestions === 0) {
            emptyState.classList.remove('hidden');
        } else {
            emptyState.classList.add('hidden');
        }
    }

    function clearFaqSearch() {
        document.getElementById('faq-search').value = '';
        filterFaqs();
    }
</script>
@endsection
