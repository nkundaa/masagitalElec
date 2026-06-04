import { useState } from 'react';
import { ArrowLeft, ChevronDown, Search, MessageSquare } from 'lucide-react';

interface FaqPageProps {
  onNavigate: (page: string, data?: any) => void;
}

const faqData = [
  {
    category: 'Orders & Payment',
    icon: '🛒',
    questions: [
      {
        q: 'How do I place an order?',
        a: 'Browse our products, add items to your cart, then proceed to checkout. Fill in your delivery details and pay using MTN Mobile Money. You\'ll receive a confirmation SMS once your order is placed.'
      },
      {
        q: 'What payment methods do you accept?',
        a: 'We currently accept MTN Mobile Money as our primary payment method. Simply enter your MoMo phone number and PIN during checkout. The payment is processed securely and instantly.'
      },
      {
        q: 'Can I cancel my order?',
        a: 'Yes, you can cancel your order within 2 hours of placing it by contacting us via WhatsApp or phone. Once the order has been dispatched, cancellation is no longer possible, but you can initiate a return.'
      },
      {
        q: 'Are prices inclusive of tax?',
        a: 'Yes, all prices displayed on our website are final prices inclusive of VAT. The price you see is the price you pay — no hidden fees.'
      },
    ]
  },
  {
    category: 'Shipping & Delivery',
    icon: '🚚',
    questions: [
      {
        q: 'How long does delivery take?',
        a: 'Delivery within Kigali takes 1-2 business days. Other provinces take 2-5 business days depending on your location. Orders placed before 2:00 PM are processed the same day.'
      },
      {
        q: 'Is delivery free?',
        a: 'Delivery within Kigali is completely FREE on all orders. For other cities and provinces, delivery fees range from 1,500 RWF to 2,500 RWF depending on the destination.'
      },
      {
        q: 'Can I track my order?',
        a: 'Yes! Once your order is shipped, you can track its status from the "My Orders" page in your account. You\'ll also receive SMS updates at each stage of delivery.'
      },
      {
        q: 'Do you deliver outside Rwanda?',
        a: 'Currently, we only deliver within Rwanda. We\'re working on expanding to East Africa soon. Stay tuned for updates!'
      },
    ]
  },
  {
    category: 'Products & Technical',
    icon: '🔧',
    questions: [
      {
        q: 'Are your products original/genuine?',
        a: 'Yes, all our products are 100% genuine and sourced from authorized distributors. Every component is tested before shipping to ensure quality and functionality.'
      },
      {
        q: 'Do you provide tutorials for products?',
        a: 'Absolutely! Every product page includes a detailed tutorial section with step-by-step wiring guides, code examples, and embedded YouTube video tutorials to help you get started.'
      },
      {
        q: 'I\'m a beginner. What should I start with?',
        a: 'We recommend starting with an Arduino Uno R3 board. It\'s the most beginner-friendly microcontroller with tons of tutorials available. Pair it with basic sensors like the DHT22 or HC-SR04 for your first project!'
      },
      {
        q: 'Do you offer bulk discounts for schools or institutions?',
        a: 'Yes! We offer special pricing for educational institutions, makerspaces, and bulk orders of 10+ units. Contact us via email or WhatsApp to discuss your needs.'
      },
    ]
  },
  {
    category: 'Returns & Warranty',
    icon: '🔄',
    questions: [
      {
        q: 'What is your return policy?',
        a: 'You can return products within 7 days of delivery if they are defective, damaged, or not as described. Items must be in original packaging. Refunds are processed via MTN Mobile Money within 2-3 business days.'
      },
      {
        q: 'Do products come with a warranty?',
        a: 'Yes, all products come with a minimum 30-day warranty against manufacturing defects. Some products have extended warranties — check the product page for details.'
      },
      {
        q: 'My component isn\'t working. What should I do?',
        a: 'First, double-check your wiring and code using our tutorials. If the issue persists, contact our tech support via WhatsApp with photos/videos of your setup. If the component is defective, we\'ll replace it.'
      },
    ]
  },
];

export default function FaqPage({ onNavigate }: FaqPageProps) {
  const [openItems, setOpenItems] = useState<Set<string>>(new Set());
  const [searchQuery, setSearchQuery] = useState('');

  const toggleItem = (key: string) => {
    setOpenItems(prev => {
      const next = new Set(prev);
      if (next.has(key)) next.delete(key);
      else next.add(key);
      return next;
    });
  };

  const filteredFaqs = searchQuery
    ? faqData.map(cat => ({
        ...cat,
        questions: cat.questions.filter(
          q => q.q.toLowerCase().includes(searchQuery.toLowerCase()) || q.a.toLowerCase().includes(searchQuery.toLowerCase())
        )
      })).filter(cat => cat.questions.length > 0)
    : faqData;

  return (
    <div className="min-h-screen bg-gray-50">
      <div className="bg-white border-b border-gray-100">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
          <button onClick={() => onNavigate('home')} className="flex items-center gap-2 text-gray-500 hover:text-teal-600 mb-4 transition-colors font-medium">
            <ArrowLeft className="w-4 h-4" /> Back to Home
          </button>
          <h1 className="text-3xl font-bold text-gray-900 mb-2">❓ Frequently Asked Questions</h1>
          <p className="text-gray-500">Find answers to common questions about our products and services</p>
        </div>
      </div>

      <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {/* Search */}
        <div className="relative mb-10">
          <Search className="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" />
          <input
            type="text"
            placeholder="Search questions..."
            value={searchQuery}
            onChange={(e) => setSearchQuery(e.target.value)}
            className="w-full pl-12 pr-4 py-4 bg-white border border-gray-200 rounded-2xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent shadow-sm text-lg"
          />
        </div>

        {filteredFaqs.length === 0 ? (
          <div className="text-center py-12">
            <div className="text-5xl mb-4">🤔</div>
            <h3 className="text-lg font-semibold text-gray-900 mb-2">No matching questions found</h3>
            <p className="text-gray-500 mb-6">Try a different search term or browse all categories below</p>
            <button onClick={() => setSearchQuery('')} className="text-teal-600 font-medium hover:underline">Clear search</button>
          </div>
        ) : (
          <div className="space-y-8">
            {filteredFaqs.map((cat) => (
              <div key={cat.category}>
                <h2 className="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                  <span>{cat.icon}</span> {cat.category}
                </h2>
                <div className="space-y-2">
                  {cat.questions.map((item, qi) => {
                    const key = `${cat.category}-${qi}`;
                    const isOpen = openItems.has(key);
                    return (
                      <div key={key} className="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                        <button
                          onClick={() => toggleItem(key)}
                          className="w-full flex items-center justify-between px-6 py-4 text-left"
                        >
                          <span className="font-medium text-gray-900 pr-4">{item.q}</span>
                          <ChevronDown className={`w-5 h-5 text-gray-400 flex-shrink-0 transition-transform ${isOpen ? 'rotate-180' : ''}`} />
                        </button>
                        {isOpen && (
                          <div className="px-6 pb-4 text-sm text-gray-600 leading-relaxed border-t border-gray-50 pt-3">
                            {item.a}
                          </div>
                        )}
                      </div>
                    );
                  })}
                </div>
              </div>
            ))}
          </div>
        )}

        {/* Still need help */}
        <div className="mt-12 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-2xl p-8 text-center text-white">
          <h3 className="text-xl font-bold mb-2">Still have questions?</h3>
          <p className="text-teal-100 mb-6">Our support team is always happy to help.</p>
          <div className="flex flex-col sm:flex-row gap-3 justify-center">
            <button onClick={() => onNavigate('contact')} className="bg-white text-teal-600 px-6 py-3 rounded-xl font-semibold hover:bg-teal-50 transition-colors inline-flex items-center gap-2 justify-center">
              <MessageSquare className="w-4 h-4" /> Contact Us
            </button>
            <a href="https://wa.me/250780000000" target="_blank" rel="noopener noreferrer" className="bg-green-500 text-white px-6 py-3 rounded-xl font-semibold hover:bg-green-600 transition-colors inline-flex items-center gap-2 justify-center">
              <MessageSquare className="w-4 h-4" /> WhatsApp
            </a>
          </div>
        </div>
      </div>
    </div>
  );
}
