<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    // Menampilkan halaman dashboard utama Admin ritel Tambah Jaya
    public function dashboard()
    {
        // 1. Ambil semua produk dan hitung total stoknya langsung dari database
        $allProducts = Product::selectRaw('*, (stock_A + stock_B + stock_C) as total_stok')->get();

        // 2. Ambil produk yang stok salah satu gudangnya menipis (<= 10) untuk peringatan restock
        $limitProducts = Product::where('stock_A', '<=', 10)
                                ->orWhere('stock_B', '<=', 10)
                                ->orWhere('stock_C', '<=', 10)
                                ->get();
                                
        return view('admin.dashboard', compact('allProducts', 'limitProducts'));
    }

    // Membuka form tambah produk baru
    public function create()
    {
        return view('admin.create');
    }

    // Menyimpan produk baru hasil kiriman form tambah
    public function store(Request $request)
    {
        // 1. Validasi semua inputan wajib untuk produk baru
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|in:Minuman,Kebutuhan Pokok,Makanan,Bumbu Dapur,Kebutuhan Bayi,Perawatan Tubuh',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Maksimal 2MB
            'stock_A'     => 'required|integer|min:0',
            'stock_B'     => 'required|integer|min:0',
            'stock_C'     => 'required|integer|min:0',
        ]);

        // 2. Proses upload gambar ke folder public/images
        $imageName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName(); // Ditambah timestamp unik agar tidak bentrok
            $file->move(public_path('images'), $imageName);
        }

        // 3. Simpan data lengkap ke database
        Product::create([
            'name'        => $request->name,
            'category'    => $request->category,
            'price'       => $request->price,
            'description' => $request->description,
            'image'       => $imageName,
            'stock_A'     => $request->stock_A,
            'stock_B'     => $request->stock_B,
            'stock_C'     => $request->stock_C,
        ]);

        return redirect('/admin/dashboard')->with('success', 'Produk baru berhasil ditambahkan!');
    }

    // Membuka form edit berdasarkan product_id kustom
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit', compact('product'));
    }

    // Memproses update data dari form edit
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // 1. Validasi inputan dari form edit
        $request->validate([
            'name'    => 'required|string|max:255',
            'price'   => 'required|numeric|min:0',
            'stock_A' => 'required|integer|min:0',
            'stock_B' => 'required|integer|min:0',
            'stock_C' => 'required|integer|min:0',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Boleh kosong jika tidak ganti gambar
        ]);

        // 2. Kumpulkan data dasar yang pasti berubah
        $dataToUpdate = [
            'name'        => $request->name,
            'price'       => $request->price,
            'stock_A'     => $request->stock_A,
            'stock_B'     => $request->stock_B,
            'stock_C'     => $request->stock_C,
            // Jika di form blade ada input category/description ambil dari request, kalau tersembunyi pakai data lama
            'category'    => $request->get('category', $product->category),
            'description' => $request->get('description', $product->description),
        ];

        // 3. Logika penanganan jika admin mengunggah file gambar baru
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            
            // Pindahkan file gambar baru ke public/images
            $file->move(public_path('images'), $imageName);
            
            // Hapus file fisik gambar lama dari server (jika ada file lamanya) agar memori tidak penuh
            if ($product->image && file_exists(public_path('images/' . $product->image))) {
                @unlink(public_path('images/' . $product->image));
            }
            
            // Masukkan nama gambar baru ke antrean update
            $dataToUpdate['image'] = $imageName;
        }

        // 4. Eksekusi pembaruan data ke MySQL
        $product->update($dataToUpdate);

        return redirect('/admin/dashboard')->with('success', 'Produk ' . $product->name . ' berhasil diperbarui!');
    }

    // Menghapus produk dari katalog ritel
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus file fisik gambar dari folder public/images sebelum datanya dihapus dari DB
        if ($product->image && file_exists(public_path('images/' . $product->image))) {
            @unlink(public_path('images/' . $product->image));
        }

        $product->delete();

        return redirect('/admin/dashboard')->with('success', 'Produk berhasil dihapus!');
    }
}