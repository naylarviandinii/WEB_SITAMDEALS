<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Model Order/Pembelian SiTamDeals

class KasirOrderController extends Controller
{
    // MENAMPILKAN DAFTAR SEMUA PESANAN
    public function index()
    {
        // Mengambil semua order beserta itemsnya
        $orders = Order::with('items')->get();
        return view('admin.orders.index', compact('orders'));
    }

    // MENAMPILKAN INVOICE PESANAN (KASIR/ADMIN)
    public function invoice($id)
    {
        // 1. Mengambil order beserta items dan produk terkait
        $order = Order::with('items.product')->findOrFail($id);
        
        // 2. Hitung total belanja dari seluruh item di dalam order ini
        // Mengalikan harga dengan kuantitas (qty) untuk setiap baris produk
        $total = $order->items->sum(fn($item) => $item->price * $item->qty);
        
        // 3. Kirim variabel $order dan $total dengan aman ke file blade invoice
        return view('orders.invoice', compact('order', 'total'));
    }

    // MEMPERBARUI STATUS PESANAN
    public function updateStatus(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        
        // Cukup update status langsung ke nilai yang diklik
        // Tanpa if/else yang mengecek status sebelumnya
        $order->status = $request->status; 
        $order->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }
}