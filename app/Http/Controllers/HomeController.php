<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();

        // Get featured products (those that have a badge, max 4)
        $featuredProducts = $products->filter(function ($p) {
            return !empty($p->badge);
        })->take(4);

        // Get new arrivals (first 8 products)
        $newArrivals = $products->take(8);

        // Category items metadata
        $categories = [
            [
                'id' => 'sensors',
                'name' => 'Sensors',
                'icon' => 'radio',
                'color' => 'from-blue-500 to-indigo-600',
                'count' => $products->where('category', 'sensors')->count()
            ],
            [
                'id' => 'microcontrollers',
                'name' => 'Microcontrollers',
                'icon' => 'cpu',
                'color' => 'from-teal-500 to-cyan-600',
                'count' => $products->where('category', 'microcontrollers')->count()
            ],
            [
                'id' => 'iot',
                'name' => 'IoT Systems',
                'icon' => 'globe',
                'color' => 'from-purple-500 to-pink-600',
                'count' => $products->where('category', 'iot')->count()
            ],
            [
                'id' => 'actuators',
                'name' => 'Actuators',
                'icon' => 'settings',
                'color' => 'from-orange-500 to-red-600',
                'count' => $products->where('category', 'actuators')->count()
            ],
        ];

        return view('home', compact('featuredProducts', 'newArrivals', 'categories', 'products'));
    }
}
