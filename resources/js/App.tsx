import { useState, useEffect, useCallback } from 'react';
import { Toaster } from 'react-hot-toast';
import { AuthProvider } from './context/AuthContext';
import { CartProvider } from './context/CartContext';
import Navbar from './components/Navbar';
import HomePage from './pages/HomePage';
import ProductsPage from './pages/ProductsPage';
import ProductDetailPage from './pages/ProductDetailPage';
import CartPage from './pages/CartPage';
import LoginPage from './pages/LoginPage';
import CheckoutPage from './pages/CheckoutPage';
import OrdersPage from './pages/OrdersPage';
import ContactPage from './pages/ContactPage';
import ShippingPage from './pages/ShippingPage';
import ReturnsPage from './pages/ReturnsPage';
import FaqPage from './pages/FaqPage';
import ProfilePage from './pages/ProfilePage';
import type { Product } from './data/products';

interface PageState {
  page: string;
  data?: any;
}

function AppContent() {
  const [history, setHistory] = useState<PageState[]>([{ page: 'home' }]);
  const [historyIndex, setHistoryIndex] = useState(0);

  const currentPage = history[historyIndex];

  const navigate = useCallback((page: string, data?: any) => {
    const newState = { page, data };
    setHistory(prev => {
      // Remove any forward history
      const newHistory = prev.slice(0, historyIndex + 1);
      newHistory.push(newState);
      return newHistory;
    });
    setHistoryIndex(prev => prev + 1);
    window.history.pushState({ index: historyIndex + 1 }, '', '');
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }, [historyIndex]);

  useEffect(() => {
    // Push initial state
    window.history.replaceState({ index: 0 }, '', '');

    const handlePopState = (e: PopStateEvent) => {
      const stateIndex = e.state?.index;
      if (stateIndex !== undefined && stateIndex >= 0 && stateIndex < history.length) {
        setHistoryIndex(stateIndex);
        window.scrollTo({ top: 0, behavior: 'smooth' });
      } else {
        // Fallback: go back one step if possible
        setHistoryIndex(prev => Math.max(0, prev - 1));
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }
    };

    window.addEventListener('popstate', handlePopState);
    return () => window.removeEventListener('popstate', handlePopState);
  }, [history.length]);

  const renderPage = () => {
    switch (currentPage.page) {
      case 'home':
        return <HomePage onNavigate={navigate} />;
      case 'products':
        return (
          <ProductsPage
            onNavigate={navigate}
            initialCategory={currentPage.data?.category}
            initialSearch={currentPage.data?.search}
          />
        );
      case 'product-detail':
        return (
          <ProductDetailPage
            product={currentPage.data?.product as Product}
            onNavigate={navigate}
          />
        );
      case 'cart':
        return <CartPage onNavigate={navigate} />;
      case 'login':
        return <LoginPage onNavigate={navigate} />;
      case 'checkout':
        return <CheckoutPage onNavigate={navigate} />;
      case 'orders':
        return <OrdersPage onNavigate={navigate} />;
      case 'contact':
        return <ContactPage onNavigate={navigate} />;
      case 'shipping':
        return <ShippingPage onNavigate={navigate} />;
      case 'returns':
        return <ReturnsPage onNavigate={navigate} />;
      case 'faq':
        return <FaqPage onNavigate={navigate} />;
      case 'profile':
        return <ProfilePage onNavigate={navigate} />;
      default:
        return <HomePage onNavigate={navigate} />;
    }
  };

  const showNavbar = !['login'].includes(currentPage.page);

  return (
    <div className="min-h-screen bg-gray-50">
      {showNavbar && <Navbar onNavigate={navigate} currentPage={currentPage.page} />}
      {renderPage()}
      <Toaster
        position="top-right"
        toastOptions={{
          duration: 3000,
          style: {
            background: '#1f2937',
            color: '#fff',
            borderRadius: '12px',
            border: '1px solid #374151',
          },
        }}
      />
    </div>
  );
}

export default function App() {
  return (
    <AuthProvider>
      <CartProvider>
        <AppContent />
      </CartProvider>
    </AuthProvider>
  );
}
