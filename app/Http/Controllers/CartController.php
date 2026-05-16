<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
    $user  = session('user');
    $items = Cart::with('product')->where('user_id', $user['user_id'])->get();
    $total = $items->sum(fn($i) => $i->unit_price * $i->qty);
    return view('cart.index', compact('items', 'total'));
}

public function add(Request $request) {
    $user = session('user');
    // Cek apakah sudah ada item sama di cart
    $existing = Cart::where([
        'user_id'    => $user['user_id'],
        'product_id' => $request->product_id,
        'grade'      => $request->grade,
    ])->first();

    if ($existing) {
        $existing->update(['qty' => $existing->qty + $request->qty]);
    } else {
        Cart::create([
            'user_id'    => $user['user_id'],
            'product_id' => $request->product_id,
            'grade'      => $request->grade,
            'qty'        => $request->qty,
            'unit_price' => $request->unit_price,
        ]);
    }
    return redirect('/cart')->with('success', 'Produk ditambahkan ke keranjang!');
}

public function remove($id) {
    Cart::where('id', $id)->where('user_id', session('user')['user_id'])->delete();
    return back()->with('success', 'Item dihapus dari keranjang');
}

public function checkout() {
    $user  = session('user');
    $items = Cart::with('product')->where('user_id', $user['user_id'])->get();
    if ($items->isEmpty()) return back()->with('error', 'Keranjang kosong!');

    $order = Order::create(['user_id' => $user['user_id'], 'status' => 'pending']);
    foreach ($items as $item) {
        OrderItem::create([
            'order_id'   => $order->id,
            'product_id' => $item->product_id,
            'grade'      => $item->grade,
            'price'      => $item->unit_price,
            'qty'        => $item->qty,
        ]);
        // Kurangi stok
        $col = 'stock_' . $item->grade;
        Product::where('product_id', $item->product_id)
               ->where($col, '>=', $item->qty)
               ->decrement($col, $item->qty);
    }
    // Kosongkan keranjang
    Cart::where('user_id', $user['user_id'])->delete();
    return redirect('/invoice/' . $order->id);
}
}
