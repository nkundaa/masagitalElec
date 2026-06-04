import { useState, useRef, useEffect } from 'react';
import { ShoppingCart, User, Menu, X, Search, Zap, LogOut, ChevronDown, Radio, Cpu, Globe, Cog, Package, UserCircle, HelpCircle, Phone } from 'lucide-react';
import { useAuth } from '../context/AuthContext';
import { useCart } from '../context/CartContext';

interface NavbarProps {
  onNavigate: (page: string, data?: any) => void;
  currentPage: string;
}

export default function Navbar({ onNavigate, currentPage }: NavbarProps) {
  const { user, isAuthenticated, logout } = useAuth();
  const { totalItems } = useCart();
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
  const [userMenuOpen, setUserMenuOpen] = useState(false);
  const [catMenuOpen, setCatMenuOpen] = useState(false);
  const [searchQuery, setSearchQuery] = useState('');
  const catRef = useRef<HTMLDivElement>(null);
  const userRef = useRef<HTMLDivElement>(null);

  // Close dropdowns on outside click
  useEffect(() => {
    const handleClick = (e: MouseEvent) => {
      if (catRef.current && !catRef.current.contains(e.target as Node)) setCatMenuOpen(false);
      if (userRef.current && !userRef.current.contains(e.target as Node)) setUserMenuOpen(false);
    };
    document.addEventListener('mousedown', handleClick);
    return () => document.removeEventListener('mousedown', handleClick);
  }, []);

  const handleSearch = (e: React.FormEvent) => {
    e.preventDefault();
    if (searchQuery.trim()) {
      onNavigate('products', { search: searchQuery.trim() });
      setSearchQuery('');
      setMobileMenuOpen(false);
    }
  };

  const categoryItems = [
    { id: 'sensors', name: 'Sensors', icon: Radio, desc: 'Temperature, motion, distance' },
    { id: 'microcontrollers', name: 'Microcontrollers', icon: Cpu, desc: 'Arduino, ESP32, Pico' },
    { id: 'iot', name: 'IoT Systems', icon: Globe, desc: 'WiFi, LoRa, GSM modules' },
    { id: 'actuators', name: 'Actuators', icon: Cog, desc: 'Motors, servos, relays' },
  ];

  return (
    <nav className="bg-gray-900 text-white sticky top-0 z-50 shadow-lg border-b border-teal-500/20">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16">
          {/* Logo */}
          <button
            onClick={() => onNavigate('home')}
            className="flex items-center gap-2 hover:opacity-90 transition-opacity"
          >
            <div className="w-9 h-9 bg-gradient-to-br from-teal-400 to-cyan-500 rounded-lg flex items-center justify-center">
              <Zap className="w-5 h-5 text-white" />
            </div>
            <div className="hidden sm:block">
              <span className="text-lg font-bold bg-gradient-to-r from-teal-400 to-cyan-400 bg-clip-text text-transparent">
                Masagital
              </span>
              <span className="text-xs block text-gray-400 -mt-1 tracking-wider">ELECTRONICS</span>
            </div>
          </button>

          {/* Search Bar - Desktop */}
          <form onSubmit={handleSearch} className="hidden md:flex flex-1 max-w-lg mx-6">
            <div className="relative w-full">
              <input
                type="text"
                placeholder="Search sensors, microcontrollers, IoT..."
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                className="w-full bg-gray-800 border border-gray-700 rounded-full py-2 pl-4 pr-10 text-sm text-white placeholder-gray-400 focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-all"
              />
              <button type="submit" className="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-teal-400 transition-colors">
                <Search className="w-4 h-4" />
              </button>
            </div>
          </form>

          {/* Nav Links - Desktop */}
          <div className="hidden md:flex items-center gap-1">
            <button
              onClick={() => onNavigate('home')}
              className={`px-3 py-2 rounded-lg text-sm font-medium transition-colors ${currentPage === 'home' ? 'bg-teal-500/10 text-teal-400' : 'text-gray-300 hover:text-white hover:bg-gray-800'}`}
            >
              Home
            </button>

            {/* Categories Dropdown */}
            <div className="relative" ref={catRef}>
              <button
                onClick={() => setCatMenuOpen(!catMenuOpen)}
                className={`flex items-center gap-1 px-3 py-2 rounded-lg text-sm font-medium transition-colors ${currentPage === 'products' ? 'bg-teal-500/10 text-teal-400' : 'text-gray-300 hover:text-white hover:bg-gray-800'}`}
              >
                Products <ChevronDown className={`w-3 h-3 transition-transform ${catMenuOpen ? 'rotate-180' : ''}`} />
              </button>
              {catMenuOpen && (
                <div className="absolute left-0 mt-2 w-72 bg-gray-800 rounded-xl shadow-xl border border-gray-700 py-2 z-50">
                  <button
                    onClick={() => { onNavigate('products'); setCatMenuOpen(false); }}
                    className="w-full text-left px-4 py-3 text-sm text-teal-400 hover:bg-gray-700 transition-colors font-semibold border-b border-gray-700 mb-1"
                  >
                    🔧 All Products
                  </button>
                  {categoryItems.map(cat => (
                    <button
                      key={cat.id}
                      onClick={() => { onNavigate('products', { category: cat.id }); setCatMenuOpen(false); }}
                      className="w-full text-left px-4 py-3 text-sm text-gray-300 hover:text-white hover:bg-gray-700 transition-colors flex items-center gap-3"
                    >
                      <div className="w-8 h-8 bg-gray-700 rounded-lg flex items-center justify-center flex-shrink-0">
                        <cat.icon className="w-4 h-4 text-teal-400" />
                      </div>
                      <div>
                        <p className="font-medium">{cat.name}</p>
                        <p className="text-xs text-gray-500">{cat.desc}</p>
                      </div>
                    </button>
                  ))}
                </div>
              )}
            </div>

            <button
              onClick={() => onNavigate('contact')}
              className={`px-3 py-2 rounded-lg text-sm font-medium transition-colors ${currentPage === 'contact' ? 'bg-teal-500/10 text-teal-400' : 'text-gray-300 hover:text-white hover:bg-gray-800'}`}
            >
              Contact
            </button>

            <button
              onClick={() => onNavigate('faq')}
              className={`px-3 py-2 rounded-lg text-sm font-medium transition-colors ${currentPage === 'faq' ? 'bg-teal-500/10 text-teal-400' : 'text-gray-300 hover:text-white hover:bg-gray-800'}`}
            >
              FAQ
            </button>

            {/* Cart */}
            <button
              onClick={() => onNavigate('cart')}
              className="relative p-2 rounded-lg text-gray-300 hover:text-white hover:bg-gray-800 transition-colors ml-1"
            >
              <ShoppingCart className="w-5 h-5" />
              {totalItems > 0 && (
                <span className="absolute -top-1 -right-1 bg-teal-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center font-bold animate-pulse">
                  {totalItems}
                </span>
              )}
            </button>

            {/* User */}
            {isAuthenticated ? (
              <div className="relative ml-1" ref={userRef}>
                <button
                  onClick={() => setUserMenuOpen(!userMenuOpen)}
                  className="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-800 transition-colors"
                >
                  <div className="w-7 h-7 bg-gradient-to-br from-teal-400 to-cyan-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                    {user?.name.charAt(0).toUpperCase()}
                  </div>
                  <span className="hidden lg:inline">{user?.name.split(' ')[0]}</span>
                  <ChevronDown className={`w-3 h-3 transition-transform ${userMenuOpen ? 'rotate-180' : ''}`} />
                </button>
                {userMenuOpen && (
                  <div className="absolute right-0 mt-2 w-56 bg-gray-800 rounded-xl shadow-xl border border-gray-700 py-2 z-50">
                    <div className="px-4 py-2 border-b border-gray-700">
                      <p className="text-sm font-medium text-white">{user?.name}</p>
                      <p className="text-xs text-gray-400">{user?.email}</p>
                    </div>
                    <button
                      onClick={() => { onNavigate('profile'); setUserMenuOpen(false); }}
                      className="w-full text-left px-4 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-gray-700 transition-colors flex items-center gap-2"
                    >
                      <UserCircle className="w-4 h-4" /> My Profile
                    </button>
                    <button
                      onClick={() => { onNavigate('orders'); setUserMenuOpen(false); }}
                      className="w-full text-left px-4 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-gray-700 transition-colors flex items-center gap-2"
                    >
                      <Package className="w-4 h-4" /> My Orders
                    </button>
                    <button
                      onClick={() => { onNavigate('cart'); setUserMenuOpen(false); }}
                      className="w-full text-left px-4 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-gray-700 transition-colors flex items-center gap-2"
                    >
                      <ShoppingCart className="w-4 h-4" /> My Cart {totalItems > 0 && <span className="text-xs bg-teal-500 text-white px-1.5 rounded-full ml-auto">{totalItems}</span>}
                    </button>
                    <div className="border-t border-gray-700 mt-1 pt-1">
                      <button
                        onClick={() => { logout(); setUserMenuOpen(false); onNavigate('home'); }}
                        className="w-full text-left px-4 py-2.5 text-sm text-red-400 hover:text-red-300 hover:bg-gray-700 transition-colors flex items-center gap-2"
                      >
                        <LogOut className="w-4 h-4" /> Sign Out
                      </button>
                    </div>
                  </div>
                )}
              </div>
            ) : (
              <button
                onClick={() => onNavigate('login')}
                className="ml-2 flex items-center gap-2 bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white px-4 py-2 rounded-full text-sm font-medium transition-all shadow-lg shadow-teal-500/20"
              >
                <User className="w-4 h-4" />
                <span>Sign In</span>
              </button>
            )}
          </div>

          {/* Mobile buttons */}
          <div className="flex md:hidden items-center gap-2">
            <button
              onClick={() => onNavigate('cart')}
              className="relative p-2 text-gray-300 hover:text-white"
            >
              <ShoppingCart className="w-5 h-5" />
              {totalItems > 0 && (
                <span className="absolute -top-1 -right-1 bg-teal-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center font-bold">
                  {totalItems}
                </span>
              )}
            </button>
            <button
              onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
              className="p-2 text-gray-300 hover:text-white"
            >
              {mobileMenuOpen ? <X className="w-6 h-6" /> : <Menu className="w-6 h-6" />}
            </button>
          </div>
        </div>
      </div>

      {/* Mobile Menu */}
      {mobileMenuOpen && (
        <div className="md:hidden bg-gray-800 border-t border-gray-700 max-h-[calc(100vh-4rem)] overflow-y-auto">
          <div className="px-4 py-3">
            <form onSubmit={handleSearch} className="mb-3">
              <div className="relative">
                <input
                  type="text"
                  placeholder="Search products..."
                  value={searchQuery}
                  onChange={(e) => setSearchQuery(e.target.value)}
                  className="w-full bg-gray-700 border border-gray-600 rounded-full py-2 pl-4 pr-10 text-sm text-white placeholder-gray-400 focus:outline-none focus:border-teal-500"
                />
                <button type="submit" className="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                  <Search className="w-4 h-4" />
                </button>
              </div>
            </form>

            <button onClick={() => { onNavigate('home'); setMobileMenuOpen(false); }} className="block w-full text-left px-3 py-2.5 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700 font-medium">
              🏠 Home
            </button>
            <button onClick={() => { onNavigate('products'); setMobileMenuOpen(false); }} className="block w-full text-left px-3 py-2.5 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700 font-medium">
              🔧 All Products
            </button>

            {/* Mobile Categories */}
            <div className="pl-3 mb-1">
              {categoryItems.map(cat => (
                <button
                  key={cat.id}
                  onClick={() => { onNavigate('products', { category: cat.id }); setMobileMenuOpen(false); }}
                  className="block w-full text-left px-3 py-2 rounded-lg text-gray-400 hover:text-white hover:bg-gray-700 text-sm flex items-center gap-2"
                >
                  <cat.icon className="w-3.5 h-3.5 text-teal-400" />
                  {cat.name}
                </button>
              ))}
            </div>

            <button onClick={() => { onNavigate('contact'); setMobileMenuOpen(false); }} className="block w-full text-left px-3 py-2.5 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700 font-medium flex items-center gap-2">
              <Phone className="w-4 h-4 text-gray-400" /> Contact Us
            </button>
            <button onClick={() => { onNavigate('faq'); setMobileMenuOpen(false); }} className="block w-full text-left px-3 py-2.5 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700 font-medium flex items-center gap-2">
              <HelpCircle className="w-4 h-4 text-gray-400" /> FAQ
            </button>
            <button onClick={() => { onNavigate('shipping'); setMobileMenuOpen(false); }} className="block w-full text-left px-3 py-2.5 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700 font-medium flex items-center gap-2">
              <Package className="w-4 h-4 text-gray-400" /> Shipping Info
            </button>

            {isAuthenticated ? (
              <>
                <div className="border-t border-gray-700 mt-2 pt-2">
                  <button onClick={() => { onNavigate('profile'); setMobileMenuOpen(false); }} className="block w-full text-left px-3 py-2.5 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700 flex items-center gap-2">
                    <UserCircle className="w-4 h-4 text-gray-400" /> My Profile
                  </button>
                  <button onClick={() => { onNavigate('orders'); setMobileMenuOpen(false); }} className="block w-full text-left px-3 py-2.5 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700 flex items-center gap-2">
                    <Package className="w-4 h-4 text-gray-400" /> My Orders
                  </button>
                </div>
                <div className="border-t border-gray-700 mt-2 pt-2">
                  <p className="px-3 py-1 text-xs text-gray-500">Signed in as <span className="text-gray-300">{user?.name}</span></p>
                  <button onClick={() => { logout(); setMobileMenuOpen(false); onNavigate('home'); }} className="block w-full text-left px-3 py-2.5 rounded-lg text-red-400 hover:bg-gray-700 flex items-center gap-2">
                    <LogOut className="w-4 h-4" /> Sign Out
                  </button>
                </div>
              </>
            ) : (
              <div className="border-t border-gray-700 mt-2 pt-3">
                <button onClick={() => { onNavigate('login'); setMobileMenuOpen(false); }} className="block w-full px-3 py-2.5 rounded-xl bg-gradient-to-r from-teal-500 to-cyan-500 text-white font-medium text-center">
                  Sign In / Create Account
                </button>
              </div>
            )}
          </div>
        </div>
      )}
    </nav>
  );
}
