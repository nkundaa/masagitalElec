import { useState } from 'react';
import { ArrowLeft, Phone, Mail, MapPin, Clock, Send, MessageSquare, CheckCircle2 } from 'lucide-react';
import toast from 'react-hot-toast';

interface ContactPageProps {
  onNavigate: (page: string, data?: any) => void;
}

export default function ContactPage({ onNavigate }: ContactPageProps) {
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [subject, setSubject] = useState('');
  const [message, setMessage] = useState('');
  const [submitted, setSubmitted] = useState(false);

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (!name || !email || !message) {
      toast.error('Please fill in all required fields');
      return;
    }
    setSubmitted(true);
    toast.success('Message sent successfully! We\'ll get back to you soon.', {
      icon: '✉️',
      style: { background: '#1f2937', color: '#fff', borderRadius: '12px', border: '1px solid #374151' }
    });
  };

  return (
    <div className="min-h-screen bg-gray-50">
      <div className="bg-white border-b border-gray-100">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
          <button onClick={() => onNavigate('home')} className="flex items-center gap-2 text-gray-500 hover:text-teal-600 mb-4 transition-colors font-medium">
            <ArrowLeft className="w-4 h-4" /> Back to Home
          </button>
          <h1 className="text-3xl font-bold text-gray-900 mb-2">📞 Contact Us</h1>
          <p className="text-gray-500">We're here to help with any questions about our products</p>
        </div>
      </div>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div className="grid md:grid-cols-3 gap-8">
          {/* Contact Info */}
          <div className="space-y-6">
            <div className="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
              <h3 className="font-bold text-gray-900 mb-4">Get in Touch</h3>
              <div className="space-y-4">
                <a href="tel:+250780000000" className="flex items-center gap-3 text-gray-600 hover:text-teal-600 transition-colors group">
                  <div className="w-10 h-10 bg-teal-50 group-hover:bg-teal-100 rounded-xl flex items-center justify-center transition-colors">
                    <Phone className="w-5 h-5 text-teal-600" />
                  </div>
                  <div>
                    <p className="text-sm font-medium text-gray-900">Phone</p>
                    <p className="text-sm">+250 780 000 000</p>
                  </div>
                </a>
                <a href="https://wa.me/250780000000" target="_blank" rel="noopener noreferrer" className="flex items-center gap-3 text-gray-600 hover:text-green-600 transition-colors group">
                  <div className="w-10 h-10 bg-green-50 group-hover:bg-green-100 rounded-xl flex items-center justify-center transition-colors">
                    <MessageSquare className="w-5 h-5 text-green-600" />
                  </div>
                  <div>
                    <p className="text-sm font-medium text-gray-900">WhatsApp</p>
                    <p className="text-sm">+250 780 000 000</p>
                  </div>
                </a>
                <a href="mailto:info@masagital.rw" className="flex items-center gap-3 text-gray-600 hover:text-teal-600 transition-colors group">
                  <div className="w-10 h-10 bg-blue-50 group-hover:bg-blue-100 rounded-xl flex items-center justify-center transition-colors">
                    <Mail className="w-5 h-5 text-blue-600" />
                  </div>
                  <div>
                    <p className="text-sm font-medium text-gray-900">Email</p>
                    <p className="text-sm">info@masagital.rw</p>
                  </div>
                </a>
                <div className="flex items-center gap-3 text-gray-600">
                  <div className="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center">
                    <MapPin className="w-5 h-5 text-purple-600" />
                  </div>
                  <div>
                    <p className="text-sm font-medium text-gray-900">Location</p>
                    <p className="text-sm">KG 123 St, Kigali, Rwanda</p>
                  </div>
                </div>
                <div className="flex items-center gap-3 text-gray-600">
                  <div className="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center">
                    <Clock className="w-5 h-5 text-orange-600" />
                  </div>
                  <div>
                    <p className="text-sm font-medium text-gray-900">Business Hours</p>
                    <p className="text-sm">Mon – Sat: 8:00 AM – 6:00 PM</p>
                    <p className="text-sm">Sunday: Closed</p>
                  </div>
                </div>
              </div>
            </div>

            <div className="bg-gradient-to-br from-teal-500 to-cyan-600 rounded-2xl p-6 text-white">
              <h3 className="font-bold mb-2">Need Urgent Help?</h3>
              <p className="text-sm text-teal-100 mb-4">Call us directly or send a WhatsApp message for immediate assistance with your order.</p>
              <a href="https://wa.me/250780000000" target="_blank" rel="noopener noreferrer" className="inline-flex items-center gap-2 bg-white text-teal-600 px-4 py-2 rounded-xl text-sm font-semibold hover:bg-teal-50 transition-colors">
                <MessageSquare className="w-4 h-4" /> Chat on WhatsApp
              </a>
            </div>
          </div>

          {/* Contact Form */}
          <div className="md:col-span-2">
            {submitted ? (
              <div className="bg-white rounded-2xl border border-gray-100 p-12 shadow-sm text-center">
                <div className="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                  <CheckCircle2 className="w-8 h-8 text-green-500" />
                </div>
                <h3 className="text-xl font-bold text-gray-900 mb-2">Message Sent!</h3>
                <p className="text-gray-500 mb-6">Thank you for reaching out. Our team will respond within 24 hours.</p>
                <button onClick={() => setSubmitted(false)} className="text-teal-600 font-medium hover:underline">Send another message</button>
              </div>
            ) : (
              <form onSubmit={handleSubmit} className="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-sm">
                <h3 className="text-xl font-bold text-gray-900 mb-6">Send us a Message</h3>
                <div className="grid sm:grid-cols-2 gap-4 mb-4">
                  <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1.5">Your Name *</label>
                    <input type="text" value={name} onChange={(e) => setName(e.target.value)} placeholder="John Doe" className="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" />
                  </div>
                  <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1.5">Email Address *</label>
                    <input type="email" value={email} onChange={(e) => setEmail(e.target.value)} placeholder="your@email.com" className="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" />
                  </div>
                </div>
                <div className="mb-4">
                  <label className="block text-sm font-medium text-gray-700 mb-1.5">Subject</label>
                  <select value={subject} onChange={(e) => setSubject(e.target.value)} className="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent cursor-pointer">
                    <option value="">Select a topic</option>
                    <option>Order Inquiry</option>
                    <option>Product Question</option>
                    <option>Shipping & Delivery</option>
                    <option>Returns & Refunds</option>
                    <option>Technical Support</option>
                    <option>Bulk Order / Partnership</option>
                    <option>Other</option>
                  </select>
                </div>
                <div className="mb-6">
                  <label className="block text-sm font-medium text-gray-700 mb-1.5">Message *</label>
                  <textarea value={message} onChange={(e) => setMessage(e.target.value)} rows={5} placeholder="Tell us how we can help..." className="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent resize-none" />
                </div>
                <button type="submit" className="w-full sm:w-auto bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white px-8 py-3.5 rounded-xl font-semibold transition-all shadow-lg shadow-teal-500/20 inline-flex items-center gap-2 active:scale-95">
                  <Send className="w-4 h-4" /> Send Message
                </button>
              </form>
            )}
          </div>
        </div>
      </div>
    </div>
  );
}
