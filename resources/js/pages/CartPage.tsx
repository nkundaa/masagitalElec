import { Trash2, Minus, Plus, ShoppingBag, ArrowLeft, ArrowRight } from 'lucide-react';
import { useCart } from '../context/CartContext';
import { useAuth } from '../context/AuthContext';

interface CartPageProps {
  onNavigate: (page: string, data?: any) => void;
}

export default function CartPage({ onNavigate }: CartPageProps) {
  const { items, removeFromCart, updateQuantity, totalPrice } = useCart();
  const { isAuthenticated } = useAuth();

  const formatPrice = (price: number) => price.toLocaleString('en-US') + ' RWF';

  if (items.length === 0) {
    return (
      <div className="min-h-screen bg-gray-50 flex items-center justify-center px-4">
        <div className="text-center">
          <div className="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <ShoppingBag className="w-12 h-12 text-gray-300" />
          </div>
          <h2 className="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
          <p className="text-gray-500 mb-8">Looks like you haven't added any products yet.</p>
          <button
            onClick={() => onNavigate('products')}
            className="bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white px-8 py-3 rounded-full font-semibold transition-all inline-flex items-center gap-2 shadow-lg shadow-teal-500/20"
          >
            <ShoppingBag className="w-5 h-5" /> Browse Products
          </button>
        </div>
      </div>
    );
  }

  return (
    <div className="min-h-screen bg-gray-50">
      <div className="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <button
          onClick={() => onNavigate('products')}
          className="flex items-center gap-2 text-gray-500 hover:text-teal-600 mb-6 transition-colors font-medium"
        >
          <ArrowLeft className="w-4 h-4" /> Continue Shopping
        </button>

        <h1 className="text-3xl font-bold text-gray-900 mb-8">Shopping Cart ({items.length} item{items.length !== 1 ? 's' : ''})</h1>

        <div className="grid lg:grid-cols-3 gap-8">
          {/* Cart Items */}
          <div className="lg:col-span-2 space-y-4">
            {items.map(item => (
              <div key={item.product.id} className="bg-white rounded-2xl border border-gray-100 p-4 sm:p-6 flex gap-4 shadow-sm">
                <img
                  src={item.product.image}
                  alt={item.product.name}
                  className="w-24 h-24 sm:w-28 sm:h-28 object-cover rounded-xl flex-shrink-0 cursor-pointer"
                  onClick={() => onNavigate('product-detail', { product: item.product })}
                />
                <div className="flex-1 min-w-0">
                  <h3
                    className="font-semibold text-gray-900 mb-1 cursor-pointer hover:text-teal-600 transition-colors line-clamp-2"
                    onClick={() => onNavigate('product-detail', { product: item.product })}
                  >
                    {item.product.name}
                  </h3>
                  <p className="text-xs text-gray-500 capitalize mb-3">
                    {item.product.category === 'iot' ? 'IoT System' : item.product.category}
                  </p>

                  <div className="flex items-center justify-between flex-wrap gap-3">
                    <div className="flex items-center border border-gray-200 rounded-xl overflow-hidden">
                      <button
                        onClick={() => updateQuantity(item.product.id, item.quantity - 1)}
                        className="px-3 py-1.5 text-gray-500 hover:bg-gray-50 transition-colors"
                      >
                        <Minus className="w-3 h-3" />
                      </button>
                      <span className="px-3 py-1.5 text-gray-900 font-semibold text-sm">{item.quantity}</span>
                      <button
                        onClick={() => updateQuantity(item.product.id, item.quantity + 1)}
                        className="px-3 py-1.5 text-gray-500 hover:bg-gray-50 transition-colors"
                      >
                        <Plus className="w-3 h-3" />
                      </button>
                    </div>

                    <div className="flex items-center gap-4">
                      <span className="font-bold text-gray-900">{formatPrice(item.product.price * item.quantity)}</span>
                      <button
                        onClick={() => removeFromCart(item.product.id)}
                        className="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all"
                        title="Remove item"
                      >
                        <Trash2 className="w-4 h-4" />
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            ))}
          </div>

          {/* Order Summary */}
          <div>
            <div className="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm sticky top-24">
              <h3 className="text-lg font-bold text-gray-900 mb-4">Order Summary</h3>

              <div className="space-y-3 mb-4">
                {items.map(item => (
                  <div key={item.product.id} className="flex justify-between text-sm">
                    <span className="text-gray-500 truncate mr-2">{item.product.name} × {item.quantity}</span>
                    <span className="text-gray-700 font-medium whitespace-nowrap">{formatPrice(item.product.price * item.quantity)}</span>
                  </div>
                ))}
              </div>

              <div className="border-t border-gray-100 pt-4 mb-4">
                <div className="flex justify-between text-sm mb-2">
                  <span className="text-gray-500">Subtotal</span>
                  <span className="text-gray-700 font-medium">{formatPrice(totalPrice)}</span>
                </div>
                <div className="flex justify-between text-sm mb-2">
                  <span className="text-gray-500">Delivery</span>
                  <span className="text-green-600 font-medium">Free</span>
                </div>
              </div>

              <div className="border-t border-gray-100 pt-4 mb-6">
                <div className="flex justify-between">
                  <span className="text-lg font-bold text-gray-900">Total</span>
                  <span className="text-lg font-bold text-gray-900">{formatPrice(totalPrice)}</span>
                </div>
              </div>

              <button
                onClick={() => {
                  if (!isAuthenticated) {
                    onNavigate('login');
                  } else {
                    onNavigate('checkout');
                  }
                }}
                className="w-full bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white py-3.5 rounded-xl font-semibold transition-all shadow-lg shadow-teal-500/20 flex items-center justify-center gap-2 active:scale-95"
              >
                Proceed to Checkout <ArrowRight className="w-5 h-5" />
              </button>

              <div className="mt-4 bg-yellow-50 border border-yellow-200 rounded-xl p-3">
                <p className="text-xs text-yellow-800 font-medium text-center">
                  📱 Pay securely with MTN Mobile Money
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
