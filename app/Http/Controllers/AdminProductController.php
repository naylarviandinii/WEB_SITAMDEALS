<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 
use Illuminate\Support\Facades\Storage;

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
        // 1. Validasi semua inputan termasuk kolom baru dan file gambar
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|in:Minuman,Kebutuhan Pokok,Makanan,Bumbu Dapur,Kebutuhan Bayi,Perawatan Tubuh',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Batas 2MB
            'stock_A'     => 'required|integer|min:0',
            'stock_B'     => 'required|integer|min:0',
            'stock_C'     => 'required|integer|min:0',
        ]);

        // 2. Proses upload gambar dan ambil nama asli filenya
        $imageName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName(); // Mengambil nama file asli pilihan user
            
            // Simpan file fisik gambar ke folder public/images
            $file->move(public_path('images'), $imageName);
        }

        // 3. Simpan data lengkap ke database
        Product::create([
            'name'        => $request->name,
            'category'    => $request->category,
            'price'       => $request->price,
            'description' => $request->description,
            'image'       => $imageName, // Menyimpan nama file gambar
            'stock_A'     => $request->stock_A,
            'stock_B'     => $request->stock_B,
            'stock_C'     => $request->stock_C,
        ]);

        return redirect('/admin/dashboard')->with('success', 'Produk baru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // 1. Validasi untuk update data
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|in:Minuman,Kebutuhan Pokok,Makanan,Bumbu Dapur,Kebutuhan Bayi,Perawatan Tubuh',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Boleh kosong saat edit jika tidak ganti gambar
            'stock_A'     => 'required|integer|min:0',
            'stock_B'     => 'required|integer|min:0',
            'stock_C'     => 'required|integer|min:0',
        ]);

        // Datanya kita kumpulkan dulu di array
        $dataToUpdate = [
            'name'        => $request->name,
            'category'    => $request->category,
            'price'       => $request->price,
            'description' => $request->description,
            'stock_A'     => $request->stock_A,
            'stock_B'     => $request->stock_B,
            'stock_C'     => $request->stock_C,
        ];

        // 2. Jika user mengunggah gambar baru saat update
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName();
            
            // Pindahkan file baru ke public/images
            $file->move(public_path('images'), $imageName);
            
            // Masukkan nama gambar baru ke antrean update
            $dataToUpdate['image'] = $imageName;
        }

        // 3. Eksekusi update datanya ke database
        $product->update($dataToUpdate);

        return redirect('/admin/dashboard')->with('success', 'Produk ' . $product->name . ' berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/admin/dashboard')->with('success', 'Produk berhasil dihapus!');
    }
}