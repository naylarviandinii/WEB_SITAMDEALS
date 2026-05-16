<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request) {
    $search   = $request->get('search', '');
    $products = Product::when($search, fn($q) => $q->where('name', 'like', "%$search%"))
                       ->orderBy('name')->get();
    return view('products.index', compact('products', 'search'));
}

public function show($id) {
    $product = Product::findOrFail($id);
    return view('products.detail', compact('product'));
}
}
