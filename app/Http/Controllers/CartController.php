<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * 1. MENAMPILKAN HALAMAN KERANJANG (Fungsi yang hilang)
     */
    public function index()
    {
        $user = session('user');
        
        // Antisipasi key session id / user_id
        $userId = isset($user['id']) ? $user['id'] : (isset($user['user_id']) ? $user['user_id'] : null);

        if (!$userId) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil semua item keranjang milik user beserta relasi produknya
        $items = Cart::with('product')->where('user_id', $userId)->get();

        // Hitung grand total belanjaan untuk dikirim ke view cart
        $total = $items->sum(function($item) {
            return $item->unit_price * $item->qty;
        });

        return view('cart.index', compact('items', 'total'));
    }

    /**
     * 2. MENAMBAH PRODUK KE KERANJANG
     */
    public function add(Request $request)
    {
        $user = session('user');
        $userId = isset($user['id']) ? $user['id'] : (isset($user['user_id']) ? $user['user_id'] : null);

        if (!$userId) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $request->validate([
            'product_id' => 'required',
            'grade'      => 'required|string',
            'qty'        => 'required|integer|min:1',
            'unit_price' => 'required|numeric',
        ]);

        $existingCart = Cart::where('user_id', $userId)
                            ->where('product_id', $request->product_id)
                            ->where('grade', $request->grade)
                            ->first();

        if ($existingCart) {
            $existingCart->qty += $request->qty;
            $existingCart->save();
        } else {
            Cart::create([
                'user_id'    => $userId,
                'product_id' => $request->product_id,
                'grade'      => $request->grade,
                'qty'        => $request->qty,
                'unit_price' => $request->unit_price,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil dimasukkan ke keranjang belanja!');
    }

    /**
     * 3. PROSES CHECKOUT PESANAN (MASUK KE KASIR)
     */
    public function checkout() 
    {
        $user = session('user');
        $userId = isset($user['id']) ? $user['id'] : (isset($user['user_id']) ? $user['user_id'] : null);

        if (!$userId) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $items = Cart::with('product')->where('user_id', $userId)->get();
        if ($items->isEmpty()) {
            return back()->with('error', 'Keranjang kosong!');
        }

        // Buat order baru dengan status awal pending
        $order = Order::create// Cari baris ini di fungsi checkout():
([
    'user_id' => $userId, 
    'status'  => 'diterima' 
]);
        
        foreach ($items as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'grade'      => $item->grade,
                'price'      => $item->unit_price,
                'qty'        => $item->qty,
            ]);
            
            // Potong stok gudang ritel sesuai grade
            $col = 'stock_' . $item->grade;
            Product::where('product_id', $item->product_id)->decrement($col, $item->qty);
        }

        // Kosongkan keranjang belanja
        Cart::where('user_id', $userId)->delete();

        // Oper langsung ke halaman tracking live progress
        return redirect('/orders/' . $order->id . '/status')->with('success', 'Checkout berhasil!');
    }

    /**
     * 4. LIVE TRACKING STATUS PELANGGAN
     */
    public function showStatus($id)
    {
        $order = Order::findOrFail($id);
        return view('order-status', compact('order'));
    }
}