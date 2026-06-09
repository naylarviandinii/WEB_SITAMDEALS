<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Pastikan kamu sudah punya model Product

class AdminProductController extends Controller
{
    // Menampilkan halaman dashboard utama Admin
    public function dashboard()
    {
        // 1. Ambil semua produk dan hitung total stoknya langsung dari database
        $allProducts = Product::selectRaw('*, (stock_A + stock_B + stock_C) as total_stok')->get();

        // 2. Ambil produk yang hasil penjumlahan ketiga stoknya kurang dari atau sama dengan 10
        $limitProducts = Product::where('stock_A', '<=', 10)
                                ->orWhere('stock_B', '<=', 10)
                                ->orWhere('stock_C', '<=', 10)
                                ->get();
        return view('admin.dashboard', compact('allProducts', 'limitProducts'));
    }

    // Prosedur Tambah, Edit, Hapus (CRUD) Produk
    public function create()
{
    return view('admin.create');
}

public function store(Request $request)
{
    $request->validate([
        'name'    => 'required|string|max:255',
        'price'   => 'required|numeric|min:0',
        'stock_A' => 'required|integer|min:0',
        'stock_B' => 'required|integer|min:0',
        'stock_C' => 'required|integer|min:0',
    ]);

    Product::create([
        'name'    => $request->name,
        'price'   => $request->price,
        'stock_A' => $request->stock_A,
        'stock_B' => $request->stock_B,
        'stock_C' => $request->stock_C,
    ]);

    return redirect('/admin/dashboard')->with('success', 'Produk baru berhasil ditambahkan!');
}

public function edit($id)
    {
        // Pastikan mencari berdasarkan primary key asli kamu
        $product = Product::findOrFail($id);
        return view('admin.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        // 1. Validasi input sesuai dengan kolom database asli
        $request->validate([
            'name'    => 'required|string|max:255',
            'price'   => 'required|numeric|min:0',
            'stock_A' => 'required|integer|min:0',
            'stock_B' => 'required|integer|min:0',
            'stock_C' => 'required|integer|min:0',
        ]);

        // 2. Cari produknya
        $product = Product::findOrFail($id);

        // 3. Update datanya ke database
        $product->update([
            'name'    => $request->name,
            'price'   => $request->price,
            'stock_A' => $request->stock_A,
            'stock_B' => $request->stock_B,
            'stock_C' => $request->stock_C,
        ]);

        // 4. Kembalikan ke dashboard dengan pesan sukses
        return redirect('/admin/dashboard')->with('success', 'Produk ' . $product->name . ' berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/admin/dashboard')->with('success', 'Produk berhasil dihapus!');
    }
}