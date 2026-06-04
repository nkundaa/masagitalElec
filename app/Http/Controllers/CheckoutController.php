<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to proceed to checkout.');
        }

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        return view('checkout', compact('cart', 'totalPrice'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to proceed.');
        }

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $request->validate([
            'delivery_address' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|string|in:momo,cash',
            'payment_phone' => 'required_if:payment_method,momo|nullable|string|max:20',
        ]);

        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        $orderId = 'MSG-' . strtoupper(Str::random(8));

        return DB::transaction(function () use ($request, $orderId, $totalPrice, $cart) {
            $order = Order::create([
                'id' => $orderId,
                'user_id' => Auth::id(),
                'total' => $totalPrice,
                'status' => $request->payment_method === 'momo' ? 'pending_payment' : 'confirmed',
                'payment_method' => $request->payment_method,
                'payment_phone' => $request->payment_method === 'momo' ? $request->payment_phone : null,
                'delivery_address' => $request->delivery_address,
                'phone' => $request->phone
            ]);

            foreach ($cart as $id => $item) {
                OrderItem::create([
                    'order_id' => $orderId,
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }

            if ($request->payment_method === 'momo') {
                // Redirect to interactive MoMo USSD payment simulator screen
                return redirect()->route('checkout.momo', ['order_id' => $orderId]);
            } else {
                // Clear cart for Cash/On-delivery payments immediately
                session()->forget('cart');
                return redirect()->route('orders.index')->with('success', 'Order placed successfully! We will contact you for delivery.');
            }
        });
    }

    public function momoGateway($orderId)
    {
        $order = Order::with('items')->findOrFail($orderId);

        // Ensure order is actually pending payment and belongs to the user
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($order->status !== 'pending_payment') {
            return redirect()->route('orders.index')->with('info', 'This order does not require payment.');
        }

        return view('checkout.momo', compact('order'));
    }

    public function momoApprove(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'pin' => 'required|numeric|digits:5' // Rwanda MTN MoMo uses 5-digit PIN
        ]);

        $order->status = 'paid';
        $order->save();

        // Clear the cart on successful payment
        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Mobile Money payment approved successfully! Your order ' . $orderId . ' is now paid and confirmed.');
    }

    public function momoCancel($orderId)
    {
        $order = Order::findOrFail($orderId);

        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->status = 'cancelled';
        $order->save();

        return redirect()->route('cart.index')->with('error', 'Mobile Money payment was cancelled. Your order has been marked as cancelled.');
    }
}
