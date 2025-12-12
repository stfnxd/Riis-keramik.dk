<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();
        $categoryFilter = $request->get('category');

        $products = Product::when($categoryFilter, function ($query, $categoryFilter) {
                $query->whereHas('category', fn($q) => $q->where('slug', $categoryFilter));
            })
            ->latest()
            ->get();

        return view('shop.index', compact('products', 'categories', 'categoryFilter'));
    }

    public function show(Product $product)
    {
        return view('shop.show', compact('product'));
    }

public function gallery(Request $request)
{

    $categoryFilter = $request->get('category');


    $products = Product::when($categoryFilter, function ($query, $categoryFilter) {
            $query->whereHas('category', fn($q) => $q->where('slug', $categoryFilter));
        })
        ->where('gallery', true)  
        ->latest()
        ->get();

    $categories = Category::orderBy('name')->get();

    return view('gallery.index', compact('products', 'categories', 'categoryFilter'));
}
}