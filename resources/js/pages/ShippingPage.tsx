import { ArrowLeft, Truck, Clock, MapPin, Package, CheckCircle2, AlertCircle } from 'lucide-react';

interface ShippingPageProps {
  onNavigate: (page: string, data?: any) => void;
}

export default function ShippingPage({ onNavigate }: ShippingPageProps) {
  const zones = [
    { city: 'Kigali (All districts)', time: '1 – 2 business days', cost: 'FREE', highlight: true },
    { city: 'Butare (Huye)', time: '2 – 3 business days', cost: '1,500 RWF', highlight: false },
    { city: 'Musanze', time: '2 – 3 business days', cost: '1,500 RWF', highlight: false },
    { city: 'Rubavu (Gisenyi)', time: '3 – 4 business days', cost: '2,000 RWF', highlight: false },
    { city: 'Muhanga', time: '2 – 3 business days', cost: '1,500 RWF', highlight: false },
    { city: 'Nyagatare', time: '3 – 4 business days', cost: '2,000 RWF', highlight: false },
    { city: 'Other provinces', time: '3 – 5 business days', cost: '2,500 RWF', highlight: false },
  ];

  return (
    <div className="min-h-screen bg-gray-50">
      <div className="bg-white border-b border-gray-100">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
          <button onClick={() => onNavigate('home')} className="flex items-center gap-2 text-gray-500 hover:text-teal-600 mb-4 transition-colors font-medium">
            <ArrowLeft className="w-4 h-4" /> Back to Home
          </button>
          <h1 className="text-3xl font-bold text-gray-900 mb-2">🚚 Shipping Information</h1>
          <p className="text-gray-500">Everything you need to know about our delivery service</p>
        </div>
      </div>

      <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {/* Highlights */}
        <div className="grid sm:grid-cols-3 gap-4 mb-12">
          {[
            { icon: Truck, title: 'Free Delivery in Kigali', desc: 'On all orders', color: 'bg-teal-50 text-teal-600' },
            { icon: Clock, title: 'Fast Processing', desc: 'Orders ship within 24hrs', color: 'bg-blue-50 text-blue-600' },
            { icon: Package, title: 'Safe Packaging', desc: 'Anti-static protection', color: 'bg-purple-50 text-purple-600' },
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

        {/* Shipping Zones Table */}
        <div className="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-8">
          <div className="p-6 border-b border-gray-100">
            <h2 className="text-xl font-bold text-gray-900 flex items-center gap-2"><MapPin className="w-5 h-5 text-teal-600" /> Delivery Zones & Rates</h2>
          </div>
          <div className="overflow-x-auto">
            <table className="w-full">
              <thead>
                <tr className="bg-gray-50">
                  <th className="text-left px-6 py-3 text-sm font-semibold text-gray-700">Destination</th>
                  <th className="text-left px-6 py-3 text-sm font-semibold text-gray-700">Delivery Time</th>
                  <th className="text-left px-6 py-3 text-sm font-semibold text-gray-700">Cost</th>
                </tr>
              </thead>
              <tbody>
                {zones.map((zone, i) => (
                  <tr key={i} className={`border-t border-gray-50 ${zone.highlight ? 'bg-teal-50/50' : ''}`}>
                    <td className="px-6 py-4 text-sm text-gray-900 font-medium">{zone.city}</td>
                    <td className="px-6 py-4 text-sm text-gray-600">{zone.time}</td>
                    <td className="px-6 py-4 text-sm font-semibold">
                      {zone.cost === 'FREE' ? (
                        <span className="text-green-600 bg-green-50 px-3 py-1 rounded-full text-xs font-bold">FREE</span>
                      ) : (
                        <span className="text-gray-900">{zone.cost}</span>
                      )}
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>

        {/* How It Works */}
        <div className="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-sm mb-8">
          <h2 className="text-xl font-bold text-gray-900 mb-6">How Delivery Works</h2>
          <div className="space-y-4">
            {[
              { step: 1, title: 'Place Your Order', desc: 'Add items to cart and complete checkout with MTN Mobile Money.' },
              { step: 2, title: 'Order Confirmation', desc: 'You\'ll receive an SMS and email confirming your order within minutes.' },
              { step: 3, title: 'Processing & Packing', desc: 'We carefully pack your electronics with anti-static bags and bubble wrap.' },
              { step: 4, title: 'Shipping', desc: 'Your package is picked up by our delivery partner and dispatched.' },
              { step: 5, title: 'Delivery', desc: 'The rider calls you before arrival. Sign to confirm receipt.' },
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

        {/* Important Notes */}
        <div className="bg-yellow-50 border border-yellow-200 rounded-2xl p-6">
          <h3 className="font-bold text-yellow-900 flex items-center gap-2 mb-3"><AlertCircle className="w-5 h-5" /> Important Notes</h3>
          <ul className="space-y-2 text-sm text-yellow-800">
            <li className="flex items-start gap-2"><CheckCircle2 className="w-4 h-4 mt-0.5 flex-shrink-0" /> Delivery times are estimates and may vary due to weather or road conditions.</li>
            <li className="flex items-start gap-2"><CheckCircle2 className="w-4 h-4 mt-0.5 flex-shrink-0" /> Orders placed after 2:00 PM will be processed the next business day.</li>
            <li className="flex items-start gap-2"><CheckCircle2 className="w-4 h-4 mt-0.5 flex-shrink-0" /> Free delivery in Kigali applies to all orders regardless of amount.</li>
            <li className="flex items-start gap-2"><CheckCircle2 className="w-4 h-4 mt-0.5 flex-shrink-0" /> You can track your order status from the "My Orders" page.</li>
          </ul>
        </div>

        <div className="text-center mt-10">
          <button onClick={() => onNavigate('products')} className="bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white px-8 py-3 rounded-full font-semibold transition-all shadow-lg shadow-teal-500/20 inline-flex items-center gap-2 active:scale-95">
            Start Shopping <Truck className="w-4 h-4" />
          </button>
        </div>
      </div>
    </div>
  );
}
