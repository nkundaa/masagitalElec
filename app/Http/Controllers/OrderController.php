<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        if (!$userId) {
            return response()->json([], 401);
        }

        $orders = Order::where('user_id', $userId)
            ->with('items')
            ->orderBy('created_at', 'desc')
            ->get();

        $formattedOrders = $orders->map(function ($order) {
            return [
                'id' => $order->id,
                'userId' => (string)$order->user_id,
                'items' => $order->items->map(function ($item) {
                    return [
                        'name' => $item->name,
                        'quantity' => $item->quantity,
                        'price' => $item->price
                    ];
                })->toArray(),
                'total' => $order->total,
                'status' => $order->status,
                'paymentMethod' => $order->payment_method,
                'deliveryAddress' => $order->delivery_address,
                'phone' => $order->phone,
                'date' => $order->created_at->toIso8601String()
            ];
        });

        return response()->json($formattedOrders);
    }

    public function store(Request $request)
    {
        $userId = Auth::id();
        if (!$userId) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product.name' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.product.price' => 'required|integer',
            'total' => 'required|integer',
            'paymentMethod' => 'required|string',
            'deliveryAddress' => 'required|string',
            'phone' => 'required|string',
        ]);

        return DB::transaction(function () use ($request, $userId) {
            $orderId = 'MSG-' . strtoupper(Str::random(8));

            $order = Order::create([
                'id' => $orderId,
                'user_id' => $userId,
                'total' => $request->total,
                'status' => 'confirmed',
                'payment_method' => $request->paymentMethod,
                'delivery_address' => $request->deliveryAddress,
                'phone' => $request->phone
            ]);

            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id' => $orderId,
                    'name' => $item['product']['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['product']['price']
                ]);
            }

            return response()->json([
                'id' => $order->id,
                'userId' => (string)$order->user_id,
                'total' => $order->total,
                'status' => $order->status,
                'paymentMethod' => $order->payment_method,
                'deliveryAddress' => $order->delivery_address,
                'phone' => $order->phone,
                'date' => $order->created_at->toIso8601String()
            ], 201);
        });
    }
}
