import { ShoppingCart, Star, Eye } from 'lucide-react';
import type { Product } from '../data/products';
import { useCart } from '../context/CartContext';
import toast from 'react-hot-toast';

interface ProductCardProps {
  product: Product;
  onViewProduct: (product: Product) => void;
}

export default function ProductCard({ product, onViewProduct }: ProductCardProps) {
  const { addToCart } = useCart();

  const handleAddToCart = (e: React.MouseEvent) => {
    e.stopPropagation();
    addToCart(product);
    toast.success(`${product.name} added to cart!`, {
      icon: '🛒',
      style: { background: '#1f2937', color: '#fff', borderRadius: '12px', border: '1px solid #374151' }
    });
  };

  const formatPrice = (price: number) => {
    return price.toLocaleString('en-US') + ' RWF';
  };

  const discount = product.originalPrice
    ? Math.round(((product.originalPrice - product.price) / product.originalPrice) * 100)
    : 0;

  return (
    <div
      className="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 cursor-pointer flex flex-col"
      onClick={() => onViewProduct(product)}
    >
      {/* Image Container */}
      <div className="relative overflow-hidden bg-gray-50 aspect-[4/3]">
        <img
          src={product.image}
          alt={product.name}
          className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
        />
        {/* Overlay on hover */}
        <div className="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300 flex items-center justify-center">
          <div className="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <div className="bg-white/90 backdrop-blur-sm rounded-full p-3 shadow-lg">
              <Eye className="w-5 h-5 text-gray-700" />
            </div>
          </div>
        </div>
        {/* Badge */}
        {product.badge && (
          <span className="absolute top-3 left-3 bg-gradient-to-r from-teal-500 to-cyan-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
            {product.badge}
          </span>
        )}
        {/* Discount */}
        {discount > 0 && (
          <span className="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
            -{discount}%
          </span>
        )}
        {/* Category pill */}
        <span className="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm text-gray-700 text-xs font-medium px-3 py-1 rounded-full capitalize">
          {product.category === 'iot' ? 'IoT System' : product.category.slice(0, -1)}
        </span>
      </div>

      {/* Content */}
      <div className="p-4 flex flex-col flex-1">
        <h3 className="font-semibold text-gray-900 text-sm leading-tight line-clamp-2 mb-1 group-hover:text-teal-600 transition-colors">
          {product.name}
        </h3>
        <p className="text-xs text-gray-500 line-clamp-2 mb-3 flex-1">
          {product.shortDescription}
        </p>

        {/* Rating */}
        <div className="flex items-center gap-1 mb-3">
          <div className="flex items-center">
            {Array.from({ length: 5 }).map((_, i) => (
              <Star
                key={i}
                className={`w-3.5 h-3.5 ${i < Math.floor(product.rating) ? 'text-amber-400 fill-amber-400' : 'text-gray-200 fill-gray-200'}`}
              />
            ))}
          </div>
          <span className="text-xs text-gray-500">({product.reviews})</span>
        </div>

        {/* Price & Action */}
        <div className="flex items-end justify-between mt-auto">
          <div>
            <p className="text-lg font-bold text-gray-900">{formatPrice(product.price)}</p>
            {product.originalPrice && (
              <p className="text-xs text-gray-400 line-through">{formatPrice(product.originalPrice)}</p>
            )}
          </div>
          <button
            onClick={handleAddToCart}
            className="bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white p-2.5 rounded-xl transition-all shadow-md hover:shadow-lg active:scale-95"
            title="Add to Cart"
          >
            <ShoppingCart className="w-4 h-4" />
          </button>
        </div>
      </div>
    </div>
  );
}
