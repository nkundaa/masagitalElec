import { ArrowRight, Cpu, Radio, Globe, Cog, Truck, Shield, Headphones, Star } from 'lucide-react';
import { useState, useEffect } from 'react';
import api from '../utils/api';
import ProductCard from '../components/ProductCard';
import { products, categories } from '../data/products';
import type { Product } from '../data/products';

interface HomePageProps {
  onNavigate: (page: string, data?: any) => void;
}

export default function HomePage({ onNavigate }: HomePageProps) {
  const [dbProducts, setDbProducts] = useState<Product[]>([]);

  useEffect(() => {
    api.get('/products')
      .then(res => {
        setDbProducts(res.data);
      })
      .catch(() => {
        setDbProducts(products);
      });
  }, []);

  const displayProducts = dbProducts.length > 0 ? dbProducts : products;
  const featuredProducts = displayProducts.filter(p => p.badge).slice(0, 4);
  const newArrivals = displayProducts.slice(0, 8);

  const handleViewProduct = (product: Product) => {
    onNavigate('product-detail', { product });
  };

  const categoryIcons: Record<string, any> = {
    sensors: Radio,
    microcontrollers: Cpu,
    iot: Globe,
    actuators: Cog,
  };

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Hero Section */}
      <section className="relative bg-gray-900 overflow-hidden">
        <div className="absolute inset-0">
          <img
            src="/images/hero-bg.jpg"
            alt="Electronics Workshop"
            className="w-full h-full object-cover opacity-30"
          />
          <div className="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-900/95 to-gray-900/70" />
        </div>
        <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 lg:py-36">
          <div className="max-w-2xl">
            <div className="inline-flex items-center gap-2 bg-teal-500/10 border border-teal-500/20 text-teal-400 px-4 py-1.5 rounded-full text-sm font-medium mb-6">
              <span className="w-2 h-2 bg-teal-400 rounded-full animate-pulse" />
              Rwanda's #1 Electronics Store
            </div>
            <h1 className="text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
              Build Your Next
              <span className="bg-gradient-to-r from-teal-400 to-cyan-400 bg-clip-text text-transparent"> Electronic </span>
              Project
            </h1>
            <p className="text-lg text-gray-300 mb-8 leading-relaxed">
              From sensors to microcontrollers, IoT systems to actuators — find everything you need
              with detailed tutorials, step-by-step guides, and fast delivery across Rwanda.
            </p>
            <div className="flex flex-wrap gap-4">
              <button
                onClick={() => onNavigate('products')}
                className="bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white px-8 py-3.5 rounded-full font-semibold text-base transition-all shadow-lg shadow-teal-500/25 flex items-center gap-2 active:scale-95"
              >
                Shop Now <ArrowRight className="w-5 h-5" />
              </button>
              <button
                onClick={() => onNavigate('products')}
                className="bg-white/10 hover:bg-white/20 text-white px-8 py-3.5 rounded-full font-semibold text-base transition-all backdrop-blur-sm border border-white/20"
              >
                Browse Categories
              </button>
            </div>
          </div>
        </div>
      </section>

      {/* Features Bar */}
      <section className="bg-white border-b border-gray-100">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
          <div className="grid grid-cols-2 md:grid-cols-4 gap-6">
            {[
              { icon: Truck, title: 'Fast Delivery', desc: 'Across Rwanda', page: 'shipping' },
              { icon: Shield, title: 'Quality Guaranteed', desc: 'Original components', page: 'returns' },
              { icon: Headphones, title: 'Tech Support', desc: 'Expert assistance', page: 'contact' },
              { icon: Star, title: 'Tutorials Included', desc: 'Learn as you build', page: 'products' },
            ].map((f, i) => (
              <button
                key={i}
                onClick={() => onNavigate(f.page)}
                className="flex items-center gap-3 text-left hover:bg-teal-50 rounded-xl p-2 -m-2 transition-colors group"
              >
                <div className="w-10 h-10 bg-teal-50 group-hover:bg-teal-100 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors">
                  <f.icon className="w-5 h-5 text-teal-600" />
                </div>
                <div>
                  <p className="font-semibold text-gray-900 text-sm">{f.title}</p>
                  <p className="text-xs text-gray-500">{f.desc}</p>
                </div>
              </button>
            ))}
          </div>
        </div>
      </section>

      {/* Categories */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div className="text-center mb-10">
          <h2 className="text-3xl font-bold text-gray-900 mb-3">Shop by Category</h2>
          <p className="text-gray-500 max-w-lg mx-auto">
            Explore our wide range of electronic components organized by category
          </p>
        </div>
        <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
          {categories.filter(c => c.id !== 'all').map((cat) => {
            const Icon = categoryIcons[cat.id] || Cpu;
            const colors: Record<string, string> = {
              sensors: 'from-blue-500 to-indigo-600',
              microcontrollers: 'from-teal-500 to-cyan-600',
              iot: 'from-purple-500 to-pink-600',
              actuators: 'from-orange-500 to-red-600',
            };
            return (
              <button
                key={cat.id}
                onClick={() => onNavigate('products', { category: cat.id })}
                className="group relative bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all border border-gray-100 overflow-hidden text-left"
              >
                <div className={`absolute top-0 right-0 w-24 h-24 bg-gradient-to-br ${colors[cat.id]} opacity-5 rounded-bl-full group-hover:opacity-10 transition-opacity`} />
                <div className={`w-12 h-12 bg-gradient-to-br ${colors[cat.id]} rounded-xl flex items-center justify-center mb-4 shadow-lg`}>
                  <Icon className="w-6 h-6 text-white" />
                </div>
                <h3 className="font-semibold text-gray-900 mb-1">{cat.name}</h3>
                <p className="text-sm text-gray-500">{cat.count} products</p>
                <ArrowRight className="w-4 h-4 text-gray-300 group-hover:text-teal-500 absolute bottom-6 right-6 transition-colors" />
              </button>
            );
          })}
        </div>
      </section>

      {/* Featured Products */}
      <section className="bg-white py-16">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex items-center justify-between mb-10">
            <div>
              <h2 className="text-3xl font-bold text-gray-900 mb-2">Featured Products</h2>
              <p className="text-gray-500">Our most popular electronic components</p>
            </div>
            <button
              onClick={() => onNavigate('products')}
              className="hidden sm:flex items-center gap-2 text-teal-600 hover:text-teal-700 font-medium transition-colors"
            >
              View All <ArrowRight className="w-4 h-4" />
            </button>
          </div>
          <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            {featuredProducts.map(product => (
              <ProductCard key={product.id} product={product} onViewProduct={handleViewProduct} />
            ))}
          </div>
          <div className="text-center mt-8 sm:hidden">
            <button
              onClick={() => onNavigate('products')}
              className="text-teal-600 font-medium flex items-center gap-2 mx-auto"
            >
              View All Products <ArrowRight className="w-4 h-4" />
            </button>
          </div>
        </div>
      </section>

      {/* All Products Preview */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div className="flex items-center justify-between mb-10">
          <div>
            <h2 className="text-3xl font-bold text-gray-900 mb-2">All Products</h2>
            <p className="text-gray-500">Browse our complete collection</p>
          </div>
          <button
            onClick={() => onNavigate('products')}
            className="hidden sm:flex items-center gap-2 text-teal-600 hover:text-teal-700 font-medium transition-colors"
          >
            See All <ArrowRight className="w-4 h-4" />
          </button>
        </div>
        <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
          {newArrivals.map(product => (
            <ProductCard key={product.id} product={product} onViewProduct={handleViewProduct} />
          ))}
        </div>
        <div className="text-center mt-10">
          <button
            onClick={() => onNavigate('products')}
            className="bg-gray-900 hover:bg-gray-800 text-white px-8 py-3 rounded-full font-semibold transition-all inline-flex items-center gap-2"
          >
            View All {displayProducts.length} Products <ArrowRight className="w-4 h-4" />
          </button>
        </div>
      </section>

      {/* MTN Mobile Money Banner */}
      <section className="bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-400 py-12">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex flex-col md:flex-row items-center justify-between gap-6">
            <div className="text-center md:text-left">
              <h3 className="text-2xl font-bold text-gray-900 mb-2">Pay with MTN Mobile Money 📱</h3>
              <p className="text-gray-800">
                Fast, secure, and convenient payment. Simply dial *182# to complete your purchase.
              </p>
            </div>
            <button
              onClick={() => onNavigate('products')}
              className="bg-gray-900 hover:bg-gray-800 text-white px-8 py-3 rounded-full font-semibold transition-all flex items-center gap-2 whitespace-nowrap"
            >
              Start Shopping <ArrowRight className="w-5 h-5" />
            </button>
          </div>
        </div>
      </section>

      {/* Footer */}
      <footer className="bg-gray-900 text-gray-400 py-16">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-2 md:grid-cols-4 gap-8 mb-12">
            <div className="col-span-2 md:col-span-1">
              <button onClick={() => onNavigate('home')} className="flex items-center gap-2 mb-4 hover:opacity-80 transition-opacity">
                <div className="w-8 h-8 bg-gradient-to-br from-teal-400 to-cyan-500 rounded-lg flex items-center justify-center">
                  <Cpu className="w-4 h-4 text-white" />
                </div>
                <span className="text-lg font-bold text-white">Masagital</span>
              </button>
              <p className="text-sm leading-relaxed mb-4">
                Your trusted source for electronic components, microcontrollers, and IoT solutions in Rwanda.
              </p>
              <a href="https://wa.me/250780000000" target="_blank" rel="noopener noreferrer" className="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-xs px-3 py-2 rounded-lg transition-colors font-medium">
                💬 Chat on WhatsApp
              </a>
            </div>
            <div>
              <h4 className="font-semibold text-white mb-4">Categories</h4>
              <ul className="space-y-2 text-sm">
                <li><button onClick={() => onNavigate('products', { category: 'sensors' })} className="hover:text-teal-400 transition-colors">📡 Sensors</button></li>
                <li><button onClick={() => onNavigate('products', { category: 'microcontrollers' })} className="hover:text-teal-400 transition-colors">🔌 Microcontrollers</button></li>
                <li><button onClick={() => onNavigate('products', { category: 'iot' })} className="hover:text-teal-400 transition-colors">🌐 IoT Systems</button></li>
                <li><button onClick={() => onNavigate('products', { category: 'actuators' })} className="hover:text-teal-400 transition-colors">⚙️ Actuators</button></li>
                <li><button onClick={() => onNavigate('products')} className="hover:text-teal-400 transition-colors">🔧 All Products</button></li>
              </ul>
            </div>
            <div>
              <h4 className="font-semibold text-white mb-4">Support</h4>
              <ul className="space-y-2 text-sm">
                <li><button onClick={() => onNavigate('contact')} className="hover:text-teal-400 transition-colors">📞 Contact Us</button></li>
                <li><button onClick={() => onNavigate('shipping')} className="hover:text-teal-400 transition-colors">🚚 Shipping Info</button></li>
                <li><button onClick={() => onNavigate('returns')} className="hover:text-teal-400 transition-colors">🔄 Returns</button></li>
                <li><button onClick={() => onNavigate('faq')} className="hover:text-teal-400 transition-colors">❓ FAQ</button></li>
              </ul>
            </div>
            <div>
              <h4 className="font-semibold text-white mb-4">Contact</h4>
              <ul className="space-y-2 text-sm">
                <li>
                  <a href="https://maps.google.com/?q=Kigali,Rwanda" target="_blank" rel="noopener noreferrer" className="hover:text-teal-400 transition-colors">
                    📍 Kigali, Rwanda
                  </a>
                </li>
                <li>
                  <a href="tel:+250780000000" className="hover:text-teal-400 transition-colors">
                    📞 +250 780 000 000
                  </a>
                </li>
                <li>
                  <a href="mailto:info@masagital.rw" className="hover:text-teal-400 transition-colors">
                    📧 info@masagital.rw
                  </a>
                </li>
                <li>⏰ Mon – Sat: 8AM – 6PM</li>
              </ul>
            </div>
          </div>
          <div className="border-t border-gray-800 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p className="text-sm">© {new Date().getFullYear()} Masagital Electronics. All rights reserved.</p>
            <div className="flex items-center gap-4 text-sm">
              <button onClick={() => onNavigate('faq')} className="hover:text-teal-400 transition-colors">Privacy Policy</button>
              <span className="text-gray-700">•</span>
              <button onClick={() => onNavigate('faq')} className="hover:text-teal-400 transition-colors">Terms of Service</button>
              <span className="text-gray-700">•</span>
              <button onClick={() => onNavigate('returns')} className="hover:text-teal-400 transition-colors">Refund Policy</button>
            </div>
          </div>
        </div>
      </footer>
    </div>
  );
}
