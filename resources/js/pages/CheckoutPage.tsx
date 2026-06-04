import { useState } from 'react';
import { ArrowLeft, Phone, MapPin, User, CheckCircle2, Loader2, Shield } from 'lucide-react';
import { useCart } from '../context/CartContext';
import { useAuth } from '../context/AuthContext';
import toast from 'react-hot-toast';

interface CheckoutPageProps {
  onNavigate: (page: string, data?: any) => void;
}

export default function CheckoutPage({ onNavigate }: CheckoutPageProps) {
  const { items, totalPrice, clearCart } = useCart();
  const { user } = useAuth();
  const [step, setStep] = useState<'details' | 'payment' | 'success'>('details');
  const [loading, setLoading] = useState(false);

  // Form
  const [fullName, setFullName] = useState(user?.name || '');
  const [phone, setPhone] = useState(user?.phone || '');
  const [address, setAddress] = useState('');
  const [city, setCity] = useState('Kigali');
  const [district, setDistrict] = useState('');
  const [momoPhone, setMomoPhone] = useState(user?.phone || '');
  const [momoPin, setMomoPin] = useState('');

  const formatPrice = (price: number) => price.toLocaleString('en-US') + ' RWF';

  const handleSubmitDetails = (e: React.FormEvent) => {
    e.preventDefault();
    if (!fullName || !phone || !address || !district) {
      toast.error('Please fill in all delivery details');
      return;
    }
    setStep('payment');
  };

  const handlePayment = async (e: React.FormEvent) => {
    e.preventDefault();
    if (!momoPhone || !momoPin) {
      toast.error('Please enter your MTN Mobile Money details');
      return;
    }
    if (momoPin.length < 4) {
      toast.error('Please enter a valid MoMo PIN');
      return;
    }

    setLoading(true);
    // Simulate payment processing
    await new Promise(resolve => setTimeout(resolve, 3000));

    // Save order
    const orders = JSON.parse(localStorage.getItem('masagital_orders') || '[]');
    const order = {
      id: 'ORD-' + Date.now(),
      userId: user?.id,
      items: items.map(i => ({ name: i.product.name, quantity: i.quantity, price: i.product.price })),
      total: totalPrice,
      status: 'confirmed',
      paymentMethod: 'MTN Mobile Money',
      deliveryAddress: `${address}, ${district}, ${city}`,
      phone,
      date: new Date().toISOString(),
    };
    orders.push(order);
    localStorage.setItem('masagital_orders', JSON.stringify(orders));

    clearCart();
    setLoading(false);
    setStep('success');
    toast.success('Payment successful! 🎉', {
      style: { background: '#1f2937', color: '#fff', borderRadius: '12px', border: '1px solid #374151' }
    });
  };

  if (step === 'success') {
    return (
      <div className="min-h-screen bg-gray-50 flex items-center justify-center px-4">
        <div className="text-center max-w-md">
          <div className="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <CheckCircle2 className="w-10 h-10 text-green-500" />
          </div>
          <h2 className="text-3xl font-bold text-gray-900 mb-3">Order Confirmed! 🎉</h2>
          <p className="text-gray-500 mb-2">
            Your payment via MTN Mobile Money has been processed successfully.
          </p>
          <p className="text-sm text-gray-400 mb-8">
            You'll receive an SMS confirmation on {phone}. Your order will be delivered within 2-3 business days.
          </p>
          <div className="flex flex-col sm:flex-row gap-3 justify-center">
            <button
              onClick={() => onNavigate('orders')}
              className="bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white px-6 py-3 rounded-xl font-semibold transition-all shadow-lg shadow-teal-500/20"
            >
              📦 View My Orders
            </button>
            <button
              onClick={() => onNavigate('products')}
              className="bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-6 py-3 rounded-xl font-semibold transition-all"
            >
              Continue Shopping
            </button>
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className="min-h-screen bg-gray-50">
      <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <button
          onClick={() => onNavigate('cart')}
          className="flex items-center gap-2 text-gray-500 hover:text-teal-600 mb-6 transition-colors font-medium"
        >
          <ArrowLeft className="w-4 h-4" /> Back to Cart
        </button>

        <h1 className="text-3xl font-bold text-gray-900 mb-8">Checkout</h1>

        {/* Progress Steps */}
        <div className="flex items-center justify-center mb-10">
          <div className="flex items-center gap-4">
            <div className={`flex items-center gap-2 ${step === 'details' ? 'text-teal-600' : 'text-green-600'}`}>
              <div className={`w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold ${
                step === 'details' ? 'bg-teal-100 text-teal-600' : 'bg-green-100 text-green-600'
              }`}>
                {step === 'payment' ? <CheckCircle2 className="w-5 h-5" /> : '1'}
              </div>
              <span className="text-sm font-medium hidden sm:inline">Delivery Details</span>
            </div>
            <div className="w-12 h-0.5 bg-gray-200">
              <div className={`h-full transition-all ${step === 'payment' ? 'bg-teal-500 w-full' : 'w-0'}`} />
            </div>
            <div className={`flex items-center gap-2 ${step === 'payment' ? 'text-teal-600' : 'text-gray-400'}`}>
              <div className={`w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold ${
                step === 'payment' ? 'bg-teal-100 text-teal-600' : 'bg-gray-100 text-gray-400'
              }`}>
                2
              </div>
              <span className="text-sm font-medium hidden sm:inline">Payment</span>
            </div>
          </div>
        </div>

        <div className="grid lg:grid-cols-3 gap-8">
          {/* Form */}
          <div className="lg:col-span-2">
            {step === 'details' && (
              <form onSubmit={handleSubmitDetails} className="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-sm">
                <h2 className="text-xl font-bold text-gray-900 mb-6">📍 Delivery Information</h2>
                <div className="grid sm:grid-cols-2 gap-4">
                  <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1.5">Full Name</label>
                    <div className="relative">
                      <User className="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" />
                      <input
                        type="text"
                        value={fullName}
                        onChange={(e) => setFullName(e.target.value)}
                        placeholder="Your full name"
                        className="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                      />
                    </div>
                  </div>
                  <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1.5">Phone Number</label>
                    <div className="relative">
                      <Phone className="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" />
                      <input
                        type="tel"
                        value={phone}
                        onChange={(e) => setPhone(e.target.value)}
                        placeholder="078X XXX XXX"
                        className="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                      />
                    </div>
                  </div>
                  <div className="sm:col-span-2">
                    <label className="block text-sm font-medium text-gray-700 mb-1.5">Delivery Address</label>
                    <div className="relative">
                      <MapPin className="absolute left-3.5 top-3 w-4 h-4 text-gray-400" />
                      <input
                        type="text"
                        value={address}
                        onChange={(e) => setAddress(e.target.value)}
                        placeholder="Street address, house number"
                        className="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                      />
                    </div>
                  </div>
                  <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1.5">City</label>
                    <select
                      value={city}
                      onChange={(e) => setCity(e.target.value)}
                      className="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent cursor-pointer"
                    >
                      <option>Kigali</option>
                      <option>Butare (Huye)</option>
                      <option>Gisenyi (Rubavu)</option>
                      <option>Musanze</option>
                      <option>Ruhengeri</option>
                      <option>Muhanga</option>
                      <option>Nyagatare</option>
                    </select>
                  </div>
                  <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1.5">District</label>
                    <input
                      type="text"
                      value={district}
                      onChange={(e) => setDistrict(e.target.value)}
                      placeholder="e.g., Gasabo, Kicukiro"
                      className="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                    />
                  </div>
                </div>

                <button
                  type="submit"
                  className="mt-6 w-full bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white py-3.5 rounded-xl font-semibold transition-all shadow-lg shadow-teal-500/20 active:scale-95"
                >
                  Continue to Payment →
                </button>
              </form>
            )}

            {step === 'payment' && (
              <form onSubmit={handlePayment} className="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-sm">
                <h2 className="text-xl font-bold text-gray-900 mb-2">📱 MTN Mobile Money Payment</h2>
                <p className="text-gray-500 text-sm mb-6">Enter your MTN MoMo details to complete the payment</p>

                {/* MoMo Banner */}
                <div className="bg-gradient-to-r from-yellow-400 to-yellow-500 rounded-2xl p-6 mb-6 text-center">
                  <div className="text-4xl mb-2">📱</div>
                  <h3 className="text-xl font-bold text-gray-900">MTN Mobile Money</h3>
                  <p className="text-gray-800 text-sm mt-1">Safe & Instant Payment</p>
                  <p className="text-2xl font-bold text-gray-900 mt-3">{formatPrice(totalPrice)}</p>
                </div>

                <div className="space-y-4">
                  <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1.5">MoMo Phone Number</label>
                    <div className="relative">
                      <Phone className="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" />
                      <input
                        type="tel"
                        value={momoPhone}
                        onChange={(e) => setMomoPhone(e.target.value)}
                        placeholder="078X XXX XXX"
                        className="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                      />
                    </div>
                  </div>
                  <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1.5">MoMo PIN</label>
                    <input
                      type="password"
                      value={momoPin}
                      onChange={(e) => setMomoPin(e.target.value)}
                      placeholder="Enter your MoMo PIN"
                      maxLength={6}
                      className="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent tracking-widest text-center text-lg font-mono"
                    />
                  </div>
                </div>

                <div className="flex items-center gap-2 mt-4 mb-6 p-3 bg-green-50 border border-green-200 rounded-xl">
                  <Shield className="w-5 h-5 text-green-600 flex-shrink-0" />
                  <p className="text-xs text-green-700">Your payment is secured with 256-bit encryption. We never store your MoMo PIN.</p>
                </div>

                <div className="flex gap-3">
                  <button
                    type="button"
                    onClick={() => setStep('details')}
                    className="px-6 py-3.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-semibold transition-all"
                  >
                    ← Back
                  </button>
                  <button
                    type="submit"
                    disabled={loading}
                    className="flex-1 bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600 text-gray-900 py-3.5 rounded-xl font-bold transition-all shadow-lg shadow-yellow-500/20 disabled:opacity-50 flex items-center justify-center gap-2 active:scale-95"
                  >
                    {loading ? (
                      <>
                        <Loader2 className="w-5 h-5 animate-spin" /> Processing Payment...
                      </>
                    ) : (
                      <>Pay {formatPrice(totalPrice)} via MoMo</>
                    )}
                  </button>
                </div>

                <p className="text-xs text-gray-400 text-center mt-4">
                  You will receive a confirmation prompt on your phone. Dial *182# to approve.
                </p>
              </form>
            )}
          </div>

          {/* Order Summary Sidebar */}
          <div>
            <div className="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm sticky top-24">
              <h3 className="text-lg font-bold text-gray-900 mb-4">Order Summary</h3>
              <div className="space-y-3 mb-4 max-h-64 overflow-y-auto">
                {items.map(item => (
                  <button
                    key={item.product.id}
                    onClick={() => onNavigate('product-detail', { product: item.product })}
                    className="flex gap-3 items-center w-full text-left hover:bg-gray-50 rounded-lg p-1 -m-1 transition-colors"
                  >
                    <img src={item.product.image} alt={item.product.name} className="w-12 h-12 rounded-lg object-cover" />
                    <div className="flex-1 min-w-0">
                      <p className="text-sm font-medium text-gray-900 truncate hover:text-teal-600 transition-colors">{item.product.name}</p>
                      <p className="text-xs text-gray-500">Qty: {item.quantity}</p>
                    </div>
                    <span className="text-sm font-semibold text-gray-700 whitespace-nowrap">{formatPrice(item.product.price * item.quantity)}</span>
                  </button>
                ))}
              </div>
              <div className="border-t border-gray-100 pt-4">
                <div className="flex justify-between text-sm mb-2">
                  <span className="text-gray-500">Subtotal</span>
                  <span className="text-gray-700">{formatPrice(totalPrice)}</span>
                </div>
                <div className="flex justify-between text-sm mb-3">
                  <span className="text-gray-500">Delivery</span>
                  <span className="text-green-600 font-medium">Free</span>
                </div>
                <div className="border-t border-gray-100 pt-3">
                  <div className="flex justify-between">
                    <span className="font-bold text-gray-900">Total</span>
                    <span className="font-bold text-gray-900 text-lg">{formatPrice(totalPrice)}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
