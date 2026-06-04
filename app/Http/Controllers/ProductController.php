<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        $selectedCategory = $request->input('category', 'all');
        $searchQuery = $request->input('search', '');
        $sortBy = $request->input('sort', 'default');

        if ($selectedCategory !== 'all' && !empty($selectedCategory)) {
            $query->where('category', $selectedCategory);
        }

        if (!empty($searchQuery)) {
            $searchTerm = '%' . $searchQuery . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                  ->orWhere('description', 'like', $searchTerm)
                  ->orWhere('short_description', 'like', $searchTerm);
            });
        }

        // Apply sorting
        if ($sortBy === 'price-low') {
            $query->orderBy('price', 'asc');
        } elseif ($sortBy === 'price-high') {
            $query->orderBy('price', 'desc');
        } elseif ($sortBy === 'rating') {
            $query->orderBy('rating', 'desc');
        } elseif ($sortBy === 'name') {
            $query->orderBy('name', 'asc');
        }

        $products = $query->get();
        $allProducts = Product::all();

        // Compile categories and counts
        $categories = [
            ['id' => 'all', 'name' => 'All Products', 'icon' => '🔧', 'count' => $allProducts->count()],
            ['id' => 'sensors', 'name' => 'Sensors', 'icon' => '📡', 'count' => $allProducts->where('category', 'sensors')->count()],
            ['id' => 'microcontrollers', 'name' => 'Microcontrollers', 'icon' => '🔌', 'count' => $allProducts->where('category', 'microcontrollers')->count()],
            ['id' => 'iot', 'name' => 'IoT Systems', 'icon' => '🌐', 'count' => $allProducts->where('category', 'iot')->count()],
            ['id' => 'actuators', 'name' => 'Actuators', 'icon' => '⚙️', 'count' => $allProducts->where('category', 'actuators')->count()],
        ];

        return view('products.index', compact('products', 'selectedCategory', 'searchQuery', 'sortBy', 'categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        // Decode specifications and instructions
        $product->specifications = json_decode($product->specifications, true) ?? [];
        $product->how_it_works = json_decode($product->how_it_works, true) ?? [];

        // Get similar products in the same category
        $similarProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'similarProducts'));
    }
}
