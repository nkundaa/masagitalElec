import { ArrowLeft, Package, CheckCircle2, Clock, Truck, RotateCcw, ShoppingBag, HelpCircle } from 'lucide-react';
import { useAuth } from '../context/AuthContext';
import { useCart } from '../context/CartContext';
import { products } from '../data/products';
import toast from 'react-hot-toast';

interface OrdersPageProps {
  onNavigate: (page: string, data?: any) => void;
}

interface Order {
  id: string;
  userId: string;
  items: { name: string; quantity: number; price: number }[];
  total: number;
  status: string;
  paymentMethod: string;
  deliveryAddress: string;
  phone: string;
  date: string;
}

export default function OrdersPage({ onNavigate }: OrdersPageProps) {
  const { user } = useAuth();
  const { addToCart } = useCart();
  const allOrders: Order[] = JSON.parse(localStorage.getItem('masagital_orders') || '[]');
  const orders = allOrders.filter(o => o.userId === user?.id).reverse();

  const formatPrice = (price: number) => price.toLocaleString('en-US') + ' RWF';

  const statusInfo: Record<string, { icon: any; color: string; label: string }> = {
    confirmed: { icon: CheckCircle2, color: 'text-green-600 bg-green-50', label: 'Confirmed' },
    processing: { icon: Clock, color: 'text-yellow-600 bg-yellow-50', label: 'Processing' },
    shipped: { icon: Truck, color: 'text-blue-600 bg-blue-50', label: 'Shipped' },
    delivered: { icon: Package, color: 'text-teal-600 bg-teal-50', label: 'Delivered' },
  };

  const handleReorder = (order: Order) => {
    let addedCount = 0;
    order.items.forEach(item => {
      const product = products.find(p => p.name === item.name);
      if (product) {
        for (let i = 0; i < item.quantity; i++) {
          addToCart(product);
        }
        addedCount += item.quantity;
      }
    });
    if (addedCount > 0) {
      toast.success(`${addedCount} item(s) added to cart!`, {
        icon: '🛒',
        style: { background: '#1f2937', color: '#fff', borderRadius: '12px', border: '1px solid #374151' }
      });
      onNavigate('cart');
    } else {
      toast.error('Could not find those products to reorder');
    }
  };

  const handleClickItem = (itemName: string) => {
    const product = products.find(p => p.name === itemName);
    if (product) {
      onNavigate('product-detail', { product });
    }
  };

  return (
    <div className="min-h-screen bg-gray-50">
      <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <button
          onClick={() => onNavigate('home')}
          className="flex items-center gap-2 text-gray-500 hover:text-teal-600 mb-6 transition-colors font-medium"
        >
          <ArrowLeft className="w-4 h-4" /> Back to Home
        </button>

        <div className="flex items-center justify-between mb-8">
          <h1 className="text-3xl font-bold text-gray-900">📦 My Orders</h1>
          {orders.length > 0 && (
            <button
              onClick={() => onNavigate('products')}
              className="text-teal-600 hover:text-teal-700 text-sm font-medium flex items-center gap-1 transition-colors"
            >
              <ShoppingBag className="w-4 h-4" /> Shop More
            </button>
          )}
        </div>

        {orders.length === 0 ? (
          <div className="text-center py-20">
            <div className="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
              <Package className="w-10 h-10 text-gray-300" />
            </div>
            <h2 className="text-xl font-bold text-gray-900 mb-2">No orders yet</h2>
            <p className="text-gray-500 mb-6">Start shopping to see your orders here!</p>
            <button
              onClick={() => onNavigate('products')}
              className="bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white px-6 py-3 rounded-full font-semibold transition-all shadow-lg shadow-teal-500/20 inline-flex items-center gap-2"
            >
              <ShoppingBag className="w-4 h-4" /> Browse Products
            </button>
          </div>
        ) : (
          <div className="space-y-4">
            {orders.map(order => {
              const status = statusInfo[order.status] || statusInfo.confirmed;
              const StatusIcon = status.icon;
              return (
                <div key={order.id} className="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                  <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
                    <div>
                      <div className="flex items-center gap-3 mb-1">
                        <h3 className="font-bold text-gray-900">{order.id}</h3>
                        <span className={`inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold ${status.color}`}>
                          <StatusIcon className="w-3 h-3" />
                          {status.label}
                        </span>
                      </div>
                      <p className="text-sm text-gray-500">
                        {new Date(order.date).toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}
                      </p>
                    </div>
                    <div className="text-right">
                      <p className="text-xl font-bold text-gray-900">{formatPrice(order.total)}</p>
                      <p className="text-xs text-gray-500">📱 {order.paymentMethod}</p>
                    </div>
                  </div>

                  <div className="border-t border-gray-100 pt-4">
                    <div className="space-y-2">
                      {order.items.map((item, i) => {
                        const foundProduct = products.find(p => p.name === item.name);
                        return (
                          <div key={i} className="flex justify-between text-sm items-center">
                            <button
                              onClick={() => handleClickItem(item.name)}
                              className={`text-left ${foundProduct ? 'text-teal-600 hover:text-teal-700 hover:underline cursor-pointer' : 'text-gray-600 cursor-default'}`}
                              disabled={!foundProduct}
                            >
                              {item.name} × {item.quantity}
                            </button>
                            <span className="text-gray-700 font-medium">{formatPrice(item.price * item.quantity)}</span>
                          </div>
                        );
                      })}
                    </div>
                    <div className="mt-3 pt-3 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                      <div className="flex items-center gap-2 text-sm text-gray-500">
                        <Truck className="w-4 h-4" />
                        <span>Delivering to: {order.deliveryAddress}</span>
                      </div>
                      <div className="flex gap-2">
                        <button
                          onClick={() => handleReorder(order)}
                          className="text-xs font-medium text-teal-600 hover:text-teal-700 bg-teal-50 hover:bg-teal-100 px-3 py-1.5 rounded-lg transition-colors flex items-center gap-1"
                        >
                          <RotateCcw className="w-3 h-3" /> Reorder
                        </button>
                        <button
                          onClick={() => onNavigate('contact')}
                          className="text-xs font-medium text-gray-500 hover:text-gray-700 bg-gray-50 hover:bg-gray-100 px-3 py-1.5 rounded-lg transition-colors flex items-center gap-1"
                        >
                          <HelpCircle className="w-3 h-3" /> Help
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              );
            })}
          </div>
        )}
      </div>
    </div>
  );
}
