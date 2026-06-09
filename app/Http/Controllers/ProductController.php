<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request) 
    {
        $search   = $request->get('search', '');
        $category = $request->get('category', ''); // Menangkap input kategori dari URL

        $products = Product::query()
            // Jika ada pencarian kata kunci nama produk
            ->when($search, fn($q) => $q->where('name', 'like', "%$search%"))
            // JIKA ADA FILTER KATEGORI YANG DIKLIK
            ->when($category, fn($q) => $q->where('category', $category))
            ->orderBy('name')
            ->get();

        // Mengirimkan data produk, keyword search, dan nama kategori ke view katalog
        return view('products.index', compact('products', 'search', 'category'));
    }

    public function home()
    {
        // Mengambil semua data produk dari database untuk halaman utama
        $products = Product::all(); 

        // Mengirim variabel $products ke file view 'home.blade.php'
        return view('home', compact('products')); 
    }

    public function show($id) 
    {
        $product = Product::findOrFail($id);
        return view('products.detail', compact('product'));
    }
}