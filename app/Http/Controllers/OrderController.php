<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function invoice($id) {
    $user  = session('user');
    $order = Order::with(['items.product'])
                  ->where('id', $id)
                  ->where('user_id', $user['user_id'])
                  ->firstOrFail();
    $total = $order->items->sum(fn($i) => $i->price * $i->qty);
    return view('orders.invoice', compact('order', 'total'));
}

// RIWAYAT TRANSAKSI
public function history() {
    $user   = session('user');
    $orders = Order::with('items.product')
                   ->where('user_id', $user['user_id'])
                   ->latest()
                   ->get();
    return view('orders.history', compact('orders'));
}
}
