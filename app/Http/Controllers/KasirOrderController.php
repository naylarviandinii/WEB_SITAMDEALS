<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Pastikan kamu sudah punya model Order/Pembelian

class KasirOrderController extends Controller
{
    // app/Http/Controllers/KasirOrderController.php
public function index()
{
    // Mengambil semua order beserta itemsnya
    $orders = Order::with('items')->get();
    return view('admin.orders.index', compact('orders'));
}

public function invoice($id)
{
    // Mengambil order beserta items dan produknya
    $order = Order::with('items.product')->findOrFail($id);
    return view('orders.invoice', compact('order'));
}

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