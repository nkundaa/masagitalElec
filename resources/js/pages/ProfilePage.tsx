import { useState } from 'react';
import { ArrowLeft, User, Mail, Phone, Shield, LogOut, Package, Settings, Edit3, Check } from 'lucide-react';
import { useAuth } from '../context/AuthContext';
import toast from 'react-hot-toast';

interface ProfilePageProps {
  onNavigate: (page: string, data?: any) => void;
}

export default function ProfilePage({ onNavigate }: ProfilePageProps) {
  const { user, logout } = useAuth();
  const [editing, setEditing] = useState(false);
  const [name, setName] = useState(user?.name || '');
  const [phone, setPhone] = useState(user?.phone || '');

  const allOrders = JSON.parse(localStorage.getItem('masagital_orders') || '[]');
  const orderCount = allOrders.filter((o: any) => o.userId === user?.id).length;
  const totalSpent = allOrders.filter((o: any) => o.userId === user?.id).reduce((sum: number, o: any) => sum + o.total, 0);

  const handleSave = () => {
    if (!name.trim()) {
      toast.error('Name cannot be empty');
      return;
    }
    // Update user in localStorage
    const users = JSON.parse(localStorage.getItem('masagital_users') || '[]');
    const idx = users.findIndex((u: any) => u.id === user?.id);
    if (idx !== -1) {
      users[idx].name = name;
      users[idx].phone = phone;
      localStorage.setItem('masagital_users', JSON.stringify(users));
    }
    const updatedUser = { ...user!, name, phone };
    localStorage.setItem('masagital_user', JSON.stringify(updatedUser));
    setEditing(false);
    toast.success('Profile updated!', {
      style: { background: '#1f2937', color: '#fff', borderRadius: '12px', border: '1px solid #374151' }
    });
    // Force page refresh to update context
    window.location.reload();
  };

  const formatPrice = (price: number) => price.toLocaleString('en-US') + ' RWF';

  return (
    <div className="min-h-screen bg-gray-50">
      <div className="bg-white border-b border-gray-100">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
          <button onClick={() => onNavigate('home')} className="flex items-center gap-2 text-gray-500 hover:text-teal-600 mb-4 transition-colors font-medium">
            <ArrowLeft className="w-4 h-4" /> Back to Home
          </button>
          <h1 className="text-3xl font-bold text-gray-900 mb-2">👤 My Profile</h1>
          <p className="text-gray-500">Manage your account settings</p>
        </div>
      </div>

      <div className="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {/* Profile Card */}
        <div className="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-6">
          <div className="bg-gradient-to-r from-teal-500 to-cyan-500 p-6 text-center">
            <div className="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-3 text-3xl font-bold text-teal-600 shadow-lg">
              {user?.name.charAt(0).toUpperCase()}
            </div>
            <h2 className="text-xl font-bold text-white">{user?.name}</h2>
            <p className="text-teal-100 text-sm">{user?.email}</p>
          </div>

          {/* Stats */}
          <div className="grid grid-cols-2 divide-x divide-gray-100 border-b border-gray-100">
            <button onClick={() => onNavigate('orders')} className="p-4 text-center hover:bg-gray-50 transition-colors">
              <p className="text-2xl font-bold text-gray-900">{orderCount}</p>
              <p className="text-xs text-gray-500 mt-1">Total Orders</p>
            </button>
            <div className="p-4 text-center">
              <p className="text-2xl font-bold text-gray-900">{formatPrice(totalSpent)}</p>
              <p className="text-xs text-gray-500 mt-1">Total Spent</p>
            </div>
          </div>

          {/* Profile Info */}
          <div className="p-6">
            <div className="flex items-center justify-between mb-4">
              <h3 className="font-semibold text-gray-900 flex items-center gap-2"><Settings className="w-4 h-4" /> Account Details</h3>
              {!editing ? (
                <button onClick={() => setEditing(true)} className="text-teal-600 text-sm font-medium flex items-center gap-1 hover:text-teal-700 transition-colors">
                  <Edit3 className="w-3.5 h-3.5" /> Edit
                </button>
              ) : (
                <button onClick={handleSave} className="text-green-600 text-sm font-medium flex items-center gap-1 hover:text-green-700 transition-colors">
                  <Check className="w-3.5 h-3.5" /> Save
                </button>
              )}
            </div>

            <div className="space-y-4">
              <div className="flex items-center gap-3">
                <div className="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center">
                  <User className="w-5 h-5 text-gray-500" />
                </div>
                {editing ? (
                  <input type="text" value={name} onChange={(e) => setName(e.target.value)} className="flex-1 px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" />
                ) : (
                  <div>
                    <p className="text-xs text-gray-400">Full Name</p>
                    <p className="text-sm font-medium text-gray-900">{user?.name}</p>
                  </div>
                )}
              </div>
              <div className="flex items-center gap-3">
                <div className="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center">
                  <Mail className="w-5 h-5 text-gray-500" />
                </div>
                <div>
                  <p className="text-xs text-gray-400">Email Address</p>
                  <p className="text-sm font-medium text-gray-900">{user?.email}</p>
                </div>
              </div>
              <div className="flex items-center gap-3">
                <div className="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center">
                  <Phone className="w-5 h-5 text-gray-500" />
                </div>
                {editing ? (
                  <input type="tel" value={phone} onChange={(e) => setPhone(e.target.value)} className="flex-1 px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" />
                ) : (
                  <div>
                    <p className="text-xs text-gray-400">Phone (MTN MoMo)</p>
                    <p className="text-sm font-medium text-gray-900">{user?.phone || 'Not set'}</p>
                  </div>
                )}
              </div>
            </div>
          </div>
        </div>

        {/* Quick Actions */}
        <div className="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
          <div className="p-4 border-b border-gray-100">
            <h3 className="font-semibold text-gray-900">Quick Actions</h3>
          </div>
          <button onClick={() => onNavigate('orders')} className="w-full flex items-center gap-3 px-6 py-4 text-left hover:bg-gray-50 transition-colors border-b border-gray-50">
            <Package className="w-5 h-5 text-teal-600" />
            <div className="flex-1">
              <p className="text-sm font-medium text-gray-900">My Orders</p>
              <p className="text-xs text-gray-500">View order history and tracking</p>
            </div>
          </button>
          <button onClick={() => onNavigate('products')} className="w-full flex items-center gap-3 px-6 py-4 text-left hover:bg-gray-50 transition-colors border-b border-gray-50">
            <Shield className="w-5 h-5 text-blue-600" />
            <div className="flex-1">
              <p className="text-sm font-medium text-gray-900">Browse Products</p>
              <p className="text-xs text-gray-500">Discover new components and sensors</p>
            </div>
          </button>
          <button onClick={() => onNavigate('contact')} className="w-full flex items-center gap-3 px-6 py-4 text-left hover:bg-gray-50 transition-colors border-b border-gray-50">
            <Mail className="w-5 h-5 text-purple-600" />
            <div className="flex-1">
              <p className="text-sm font-medium text-gray-900">Contact Support</p>
              <p className="text-xs text-gray-500">Get help with your account or orders</p>
            </div>
          </button>
          <button
            onClick={() => { logout(); onNavigate('home'); }}
            className="w-full flex items-center gap-3 px-6 py-4 text-left hover:bg-red-50 transition-colors"
          >
            <LogOut className="w-5 h-5 text-red-500" />
            <div className="flex-1">
              <p className="text-sm font-medium text-red-600">Sign Out</p>
              <p className="text-xs text-gray-500">Log out of your account</p>
            </div>
          </button>
        </div>
      </div>
    </div>
  );
}
