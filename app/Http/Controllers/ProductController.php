<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request) 
    {
        $search   = $request->get('search', '');
        $category = $request->get('category', ''); 

        $products = Product::query()
            ->when($search, fn($q) => $q->where('name', 'like', "%$search%"))
            ->when($category, fn($q) => $q->where('category', $category))
            ->orderBy('name')
            ->get();

        return view('products.index', compact('products', 'search', 'category'));
    }

    public function home()
    {
        $products = Product::latest()->take(3)->get();
        return view('home', compact('products'));
    }

    public function show($id) 
    {
        $product = Product::findOrFail($id);
        return view('products.detail', compact('product'));
    }

    public function update(Request $request, $id)
    {
        // 1. Validasi data yang masuk
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock_A' => 'required|integer|min:0',
            'stock_B' => 'required|integer|min:0',
            'stock_C' => 'required|integer|min:0',
        ]);

        // 2. Cari produknya (Otomatis mencari berdasarkan 'product_id' karena sudah di-set di Model)
        $product = Product::findOrFail($id);

        // 3. Update datanya menggunakan mass assignment yang lebih ringkas
        $product->update([
            'name'        => $request->name,
            'price'       => $request->price,
            'description' => $request->description,
            'stock_A'     => $request->stock_A,
            'stock_B'     => $request->stock_B,
            'stock_C'     => $request->stock_C,
        ]);

        return redirect('/admin/products')->with('success', 'Produk berhasil diperbarui!');
    }
}