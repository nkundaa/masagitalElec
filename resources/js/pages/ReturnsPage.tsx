import { ArrowLeft, RotateCcw, CheckCircle2, XCircle, AlertTriangle, Clock, Shield } from 'lucide-react';

interface ReturnsPageProps {
  onNavigate: (page: string, data?: any) => void;
}

export default function ReturnsPage({ onNavigate }: ReturnsPageProps) {
  return (
    <div className="min-h-screen bg-gray-50">
      <div className="bg-white border-b border-gray-100">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
          <button onClick={() => onNavigate('home')} className="flex items-center gap-2 text-gray-500 hover:text-teal-600 mb-4 transition-colors font-medium">
            <ArrowLeft className="w-4 h-4" /> Back to Home
          </button>
          <h1 className="text-3xl font-bold text-gray-900 mb-2">🔄 Returns & Refund Policy</h1>
          <p className="text-gray-500">Your satisfaction is our priority</p>
        </div>
      </div>

      <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {/* Highlights */}
        <div className="grid sm:grid-cols-3 gap-4 mb-12">
          {[
            { icon: Clock, title: '7-Day Returns', desc: 'From date of delivery', color: 'bg-blue-50 text-blue-600' },
            { icon: Shield, title: 'Quality Guaranteed', desc: 'All products tested', color: 'bg-green-50 text-green-600' },
            { icon: RotateCcw, title: 'Easy Process', desc: 'Simple return steps', color: 'bg-purple-50 text-purple-600' },
          ].map((item, i) => (
            <div key={i} className="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm text-center">
              <div className={`w-12 h-12 ${item.color} rounded-xl flex items-center justify-center mx-auto mb-3`}>
                <item.icon className="w-6 h-6" />
              </div>
              <h3 className="font-semibold text-gray-900 mb-1">{item.title}</h3>
              <p className="text-sm text-gray-500">{item.desc}</p>
            </div>
          ))}
        </div>

        {/* Return Policy */}
        <div className="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-sm mb-8">
          <h2 className="text-xl font-bold text-gray-900 mb-6">Return Policy</h2>
          <div className="prose prose-gray max-w-none">
            <p className="text-gray-600 leading-relaxed mb-4">
              At Masagital Electronics, we want you to be completely satisfied with your purchase. If something isn't right, we're here to help. You may return most items within <strong>7 days of delivery</strong> for a full refund or exchange.
            </p>
          </div>

          <h3 className="font-semibold text-gray-900 mt-6 mb-4 flex items-center gap-2">
            <CheckCircle2 className="w-5 h-5 text-green-500" /> Eligible for Return
          </h3>
          <ul className="space-y-2 mb-6">
            {[
              'Defective or damaged products on arrival',
              'Wrong item received (different from what you ordered)',
              'Product not matching the description on the website',
              'Dead on arrival (DOA) components',
              'Unopened items in original packaging',
            ].map((item, i) => (
              <li key={i} className="flex items-start gap-2 text-sm text-gray-600">
                <CheckCircle2 className="w-4 h-4 text-green-500 mt-0.5 flex-shrink-0" />
                {item}
              </li>
            ))}
          </ul>

          <h3 className="font-semibold text-gray-900 mb-4 flex items-center gap-2">
            <XCircle className="w-5 h-5 text-red-500" /> Not Eligible for Return
          </h3>
          <ul className="space-y-2">
            {[
              'Products damaged due to misuse, improper wiring, or negligence',
              'Components that have been soldered or physically modified',
              'Items returned after 7 days from delivery date',
              'Products without original packaging or missing accessories',
              'Software or downloadable products',
            ].map((item, i) => (
              <li key={i} className="flex items-start gap-2 text-sm text-gray-600">
                <XCircle className="w-4 h-4 text-red-400 mt-0.5 flex-shrink-0" />
                {item}
              </li>
            ))}
          </ul>
        </div>

        {/* Return Process */}
        <div className="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-sm mb-8">
          <h2 className="text-xl font-bold text-gray-900 mb-6">How to Return an Item</h2>
          <div className="space-y-4">
            {[
              { step: 1, title: 'Contact Us', desc: 'Send us a message via WhatsApp, email, or the contact form with your order number and reason for return.' },
              { step: 2, title: 'Get Approval', desc: 'Our team will review your request and send you a return approval within 24 hours.' },
              { step: 3, title: 'Pack the Item', desc: 'Place the item in its original packaging with all accessories included.' },
              { step: 4, title: 'Ship or Drop Off', desc: 'Ship the item to our Kigali office or drop it off in person. We\'ll cover return shipping for defective items.' },
              { step: 5, title: 'Refund Processed', desc: 'Once we receive and inspect the item, your refund will be sent to your MTN Mobile Money within 2-3 business days.' },
            ].map(item => (
              <div key={item.step} className="flex gap-4">
                <div className="w-8 h-8 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0">{item.step}</div>
                <div>
                  <h4 className="font-semibold text-gray-900">{item.title}</h4>
                  <p className="text-sm text-gray-500">{item.desc}</p>
                </div>
              </div>
            ))}
          </div>
        </div>

        {/* Warning */}
        <div className="bg-yellow-50 border border-yellow-200 rounded-2xl p-6 mb-8">
          <h3 className="font-bold text-yellow-900 flex items-center gap-2 mb-3"><AlertTriangle className="w-5 h-5" /> Important</h3>
          <p className="text-sm text-yellow-800">
            All electronic components are tested before shipping. If you receive a defective product, please take a photo/video of the issue and include it when contacting us. This helps us process your return faster.
          </p>
        </div>

        <div className="text-center">
          <p className="text-gray-500 mb-4">Have questions about a return?</p>
          <button onClick={() => onNavigate('contact')} className="bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white px-8 py-3 rounded-full font-semibold transition-all shadow-lg shadow-teal-500/20 inline-flex items-center gap-2 active:scale-95">
            Contact Support
          </button>
        </div>
      </div>
    </div>
  );
}
