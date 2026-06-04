import { useState, useRef } from 'react';
import { ArrowLeft, ShoppingCart, Star, Play, CheckCircle, ChevronRight, Minus, Plus, Package, Truck, Shield, BookOpen } from 'lucide-react';
import type { Product } from '../data/products';
import { useCart } from '../context/CartContext';
import { products } from '../data/products';
import ProductCard from '../components/ProductCard';
import toast from 'react-hot-toast';

interface ProductDetailPageProps {
  product: Product;
  onNavigate: (page: string, data?: any) => void;
}

export default function ProductDetailPage({ product, onNavigate }: ProductDetailPageProps) {
  const { addToCart } = useCart();
  const [quantity, setQuantity] = useState(1);
  const [activeTab, setActiveTab] = useState<'description' | 'howItWorks' | 'specs' | 'tutorial'>('description');
  const tabsRef = useRef<HTMLDivElement>(null);

  const handleAddToCart = () => {
    for (let i = 0; i < quantity; i++) {
      addToCart(product);
    }
    toast.success(`${quantity}x ${product.name} added to cart!`, {
      icon: '🛒',
      style: { background: '#1f2937', color: '#fff', borderRadius: '12px', border: '1px solid #374151' }
    });
  };

  const handleBuyNow = () => {
    for (let i = 0; i < quantity; i++) {
      addToCart(product);
    }
    onNavigate('cart');
  };

  const switchTab = (tab: 'description' | 'howItWorks' | 'specs' | 'tutorial') => {
    setActiveTab(tab);
    // Scroll to tabs section
    setTimeout(() => {
      tabsRef.current?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }, 50);
  };

  const formatPrice = (price: number) => price.toLocaleString('en-US') + ' RWF';

  // Related products (same category, excluding current)
  const relatedProducts = products
    .filter(p => p.category === product.category && p.id !== product.id)
    .slice(0, 4);

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Breadcrumb */}
      <div className="bg-white border-b border-gray-100">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
          <div className="flex items-center gap-2 text-sm text-gray-500">
            <button onClick={() => onNavigate('home')} className="hover:text-teal-600 transition-colors">Home</button>
            <ChevronRight className="w-3 h-3" />
            <button onClick={() => onNavigate('products')} className="hover:text-teal-600 transition-colors">Products</button>
            <ChevronRight className="w-3 h-3" />
            <button onClick={() => onNavigate('products', { category: product.category })} className="hover:text-teal-600 transition-colors capitalize">
              {product.category === 'iot' ? 'IoT Systems' : product.category}
            </button>
            <ChevronRight className="w-3 h-3" />
            <span className="text-gray-900 font-medium truncate max-w-[200px]">{product.name}</span>
          </div>
        </div>
      </div>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <button
          onClick={() => onNavigate('products', { category: product.category })}
          className="flex items-center gap-2 text-gray-500 hover:text-teal-600 mb-6 transition-colors font-medium"
        >
          <ArrowLeft className="w-4 h-4" /> Back to Products
        </button>

        {/* Product Main Section */}
        <div className="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
          <div className="grid md:grid-cols-2 gap-0">
            {/* Image */}
            <div className="relative bg-gray-50 aspect-square md:aspect-auto">
              <img
                src={product.image}
                alt={product.name}
                className="w-full h-full object-cover"
              />
              {product.badge && (
                <span className="absolute top-4 left-4 bg-gradient-to-r from-teal-500 to-cyan-500 text-white text-sm font-bold px-4 py-1.5 rounded-full shadow-lg">
                  {product.badge}
                </span>
              )}
            </div>

            {/* Details */}
            <div className="p-6 sm:p-8 flex flex-col">
              <div className="flex-1">
                <button
                  onClick={() => onNavigate('products', { category: product.category })}
                  className="text-xs uppercase tracking-wider font-semibold text-teal-600 bg-teal-50 px-3 py-1 rounded-full hover:bg-teal-100 transition-colors"
                >
                  {product.category === 'iot' ? 'IoT System' : product.category}
                </button>
                <h1 className="text-2xl sm:text-3xl font-bold text-gray-900 mt-3 mb-2">{product.name}</h1>

                {/* Rating */}
                <div className="flex items-center gap-2 mb-4">
                  <div className="flex items-center">
                    {Array.from({ length: 5 }).map((_, i) => (
                      <Star
                        key={i}
                        className={`w-4 h-4 ${i < Math.floor(product.rating) ? 'text-amber-400 fill-amber-400' : 'text-gray-200 fill-gray-200'}`}
                      />
                    ))}
                  </div>
                  <span className="text-sm text-gray-500">{product.rating} ({product.reviews} reviews)</span>
                </div>

                <p className="text-gray-600 leading-relaxed mb-6">{product.shortDescription}</p>

                {/* Price */}
                <div className="mb-6">
                  <div className="flex items-baseline gap-3">
                    <span className="text-3xl font-bold text-gray-900">{formatPrice(product.price)}</span>
                    {product.originalPrice && (
                      <span className="text-lg text-gray-400 line-through">{formatPrice(product.originalPrice)}</span>
                    )}
                  </div>
                  {product.originalPrice && (
                    <p className="text-sm text-green-600 font-medium mt-1">
                      Save {formatPrice(product.originalPrice - product.price)} ({Math.round(((product.originalPrice - product.price) / product.originalPrice) * 100)}% off)
                    </p>
                  )}
                </div>

                {/* Stock Status */}
                <div className="flex items-center gap-2 mb-6">
                  <div className={`w-2.5 h-2.5 rounded-full ${product.inStock ? 'bg-green-500' : 'bg-red-500'}`} />
                  <span className={`text-sm font-medium ${product.inStock ? 'text-green-600' : 'text-red-600'}`}>
                    {product.inStock ? 'In Stock — Ready to Ship' : 'Out of Stock'}
                  </span>
                </div>

                {/* Quick features — all clickable */}
                <div className="grid grid-cols-3 gap-3 mb-6">
                  <button
                    onClick={() => onNavigate('shipping')}
                    className="text-center p-3 bg-gray-50 rounded-xl hover:bg-teal-50 transition-colors group"
                  >
                    <Truck className="w-5 h-5 text-teal-600 mx-auto mb-1" />
                    <span className="text-xs text-gray-600 font-medium group-hover:text-teal-700">Fast Delivery</span>
                  </button>
                  <button
                    onClick={() => onNavigate('returns')}
                    className="text-center p-3 bg-gray-50 rounded-xl hover:bg-teal-50 transition-colors group"
                  >
                    <Shield className="w-5 h-5 text-teal-600 mx-auto mb-1" />
                    <span className="text-xs text-gray-600 font-medium group-hover:text-teal-700">Warranty</span>
                  </button>
                  <button
                    onClick={() => switchTab('tutorial')}
                    className="text-center p-3 bg-gray-50 rounded-xl hover:bg-teal-50 transition-colors group"
                  >
                    <BookOpen className="w-5 h-5 text-teal-600 mx-auto mb-1" />
                    <span className="text-xs text-gray-600 font-medium group-hover:text-teal-700">Tutorial</span>
                  </button>
                </div>
              </div>

              {/* Quantity & Actions */}
              <div>
                <div className="flex items-center gap-4 mb-4">
                  <span className="text-sm font-medium text-gray-700">Quantity:</span>
                  <div className="flex items-center border border-gray-200 rounded-xl overflow-hidden">
                    <button
                      onClick={() => setQuantity(Math.max(1, quantity - 1))}
                      className="px-3 py-2 text-gray-500 hover:bg-gray-50 transition-colors"
                    >
                      <Minus className="w-4 h-4" />
                    </button>
                    <span className="px-4 py-2 text-gray-900 font-semibold min-w-[40px] text-center">{quantity}</span>
                    <button
                      onClick={() => setQuantity(quantity + 1)}
                      className="px-3 py-2 text-gray-500 hover:bg-gray-50 transition-colors"
                    >
                      <Plus className="w-4 h-4" />
                    </button>
                  </div>
                  <span className="text-sm text-gray-500">Total: <span className="font-semibold text-gray-900">{formatPrice(product.price * quantity)}</span></span>
                </div>

                <div className="flex gap-3">
                  <button
                    onClick={handleAddToCart}
                    className="flex-1 flex items-center justify-center gap-2 bg-white border-2 border-teal-500 text-teal-600 hover:bg-teal-50 py-3.5 rounded-xl font-semibold transition-all active:scale-95"
                  >
                    <ShoppingCart className="w-5 h-5" /> Add to Cart
                  </button>
                  <button
                    onClick={handleBuyNow}
                    className="flex-1 flex items-center justify-center gap-2 bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white py-3.5 rounded-xl font-semibold transition-all shadow-lg shadow-teal-500/20 active:scale-95"
                  >
                    <Package className="w-5 h-5" /> Buy Now
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* Tabs Section */}
        <div ref={tabsRef} className="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8 scroll-mt-20">
          {/* Tab Navigation */}
          <div className="border-b border-gray-100 overflow-x-auto">
            <div className="flex min-w-max">
              {([
                { key: 'description', label: 'Description', icon: '📝' },
                { key: 'howItWorks', label: 'How It Works', icon: '🔧' },
                { key: 'specs', label: 'Specifications', icon: '📋' },
                { key: 'tutorial', label: 'Video Tutorial', icon: '🎥' },
              ] as const).map(tab => (
                <button
                  key={tab.key}
                  onClick={() => setActiveTab(tab.key)}
                  className={`px-6 py-4 text-sm font-medium border-b-2 transition-all whitespace-nowrap ${
                    activeTab === tab.key
                      ? 'border-teal-500 text-teal-600 bg-teal-50/50'
                      : 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50'
                  }`}
                >
                  <span className="mr-2">{tab.icon}</span>
                  {tab.label}
                </button>
              ))}
            </div>
          </div>

          {/* Tab Content */}
          <div className="p-6 sm:p-8">
            {activeTab === 'description' && (
              <div>
                <h3 className="text-xl font-bold text-gray-900 mb-4">Product Description</h3>
                <p className="text-gray-600 leading-relaxed text-base">{product.description}</p>
                <button
                  onClick={() => switchTab('howItWorks')}
                  className="mt-6 bg-teal-50 border border-teal-100 rounded-xl p-4 w-full text-left hover:bg-teal-100 transition-colors group"
                >
                  <p className="text-sm text-teal-800">
                    <span className="font-semibold">💡 Pro Tip:</span> Check the{' '}
                    <span className="font-semibold underline group-hover:text-teal-900">"How It Works"</span>{' '}
                    tab for a complete step-by-step wiring and coding guide!
                  </p>
                </button>
              </div>
            )}

            {activeTab === 'howItWorks' && (
              <div>
                <h3 className="text-xl font-bold text-gray-900 mb-6">Step-by-Step Guide</h3>
                <div className="space-y-4">
                  {product.howItWorks.map((step, index) => (
                    <div key={index} className="flex gap-4 items-start">
                      <div className="w-8 h-8 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0 shadow-md">
                        {index + 1}
                      </div>
                      <div className="flex-1 pt-1">
                        <p className="text-gray-700 leading-relaxed">{step}</p>
                      </div>
                    </div>
                  ))}
                </div>
                <div className="mt-8 flex flex-col sm:flex-row gap-3">
                  <button
                    onClick={() => switchTab('tutorial')}
                    className="flex-1 bg-teal-50 border border-teal-200 rounded-xl p-4 text-left hover:bg-teal-100 transition-colors"
                  >
                    <p className="text-sm text-teal-800">
                      <span className="font-semibold">🎥 Watch Video:</span> See this guide in action in the Video Tutorial tab
                    </p>
                  </button>
                  <button
                    onClick={() => switchTab('specs')}
                    className="flex-1 bg-blue-50 border border-blue-200 rounded-xl p-4 text-left hover:bg-blue-100 transition-colors"
                  >
                    <p className="text-sm text-blue-800">
                      <span className="font-semibold">📋 Specs:</span> Check the full technical specifications
                    </p>
                  </button>
                </div>
                <div className="mt-4 bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                  <p className="text-sm text-yellow-800">
                    <span className="font-semibold">⚠️ Safety Note:</span> Always double-check your wiring before powering on. Incorrect connections may damage your components.
                  </p>
                </div>
              </div>
            )}

            {activeTab === 'specs' && (
              <div>
                <h3 className="text-xl font-bold text-gray-900 mb-6">Technical Specifications</h3>
                <div className="grid gap-3">
                  {product.specifications.map((spec, index) => (
                    <div key={index} className={`flex items-start gap-3 p-3 rounded-xl ${index % 2 === 0 ? 'bg-gray-50' : ''}`}>
                      <CheckCircle className="w-5 h-5 text-teal-500 flex-shrink-0 mt-0.5" />
                      <span className="text-gray-700">{spec}</span>
                    </div>
                  ))}
                </div>
              </div>
            )}

            {activeTab === 'tutorial' && (
              <div>
                <h3 className="text-xl font-bold text-gray-900 mb-2">{product.tutorialTitle}</h3>
                <p className="text-gray-500 mb-6">Watch this detailed video tutorial to learn how to use this component in your projects.</p>
                <div className="relative rounded-2xl overflow-hidden bg-black aspect-video shadow-xl">
                  <iframe
                    src={`https://www.youtube.com/embed/${product.youtubeVideoId}`}
                    title={product.tutorialTitle}
                    className="absolute inset-0 w-full h-full"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowFullScreen
                  />
                </div>
                <div className="mt-6 flex flex-wrap gap-3">
                  <a
                    href={`https://www.youtube.com/watch?v=${product.youtubeVideoId}`}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-xl font-medium transition-colors"
                  >
                    <Play className="w-4 h-4" /> Watch on YouTube
                  </a>
                  <button
                    onClick={() => switchTab('howItWorks')}
                    className="inline-flex items-center gap-2 bg-teal-50 text-teal-700 border border-teal-200 hover:bg-teal-100 px-5 py-2.5 rounded-xl font-medium transition-colors"
                  >
                    <BookOpen className="w-4 h-4" /> View Step-by-Step Guide
                  </button>
                </div>
              </div>
            )}
          </div>
        </div>

        {/* Related Products */}
        {relatedProducts.length > 0 && (
          <div className="mb-8">
            <div className="flex items-center justify-between mb-6">
              <h2 className="text-xl font-bold text-gray-900">Related Products</h2>
              <button
                onClick={() => onNavigate('products', { category: product.category })}
                className="text-teal-600 hover:text-teal-700 text-sm font-medium transition-colors flex items-center gap-1"
              >
                View All <ChevronRight className="w-3 h-3" />
              </button>
            </div>
            <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
              {relatedProducts.map(p => (
                <ProductCard key={p.id} product={p} onViewProduct={(prod) => onNavigate('product-detail', { product: prod })} />
              ))}
            </div>
          </div>
        )}
      </div>
    </div>
  );
}
