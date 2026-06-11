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
     * 1. MENAMPILKAN HALAMAN KERANJANG
     */
    public function index()
    {
        $user = session('user');
        $userId = $user['id'] ?? $user['user_id'] ?? null;

        if (!$userId) return redirect('/login')->with('error', 'Silakan login.');

        $items = Cart::with('product')->where('user_id', $userId)->get();
        $total = $items->sum(fn($item) => $item->unit_price * $item->qty);

        // Ambil ID item yang baru dimasukkan lewat "Beli Sekarang" jika ada
        $buyNowId = session('buy_now_id');

        return view('cart.index', compact('items', 'total', 'buyNowId'));
    }

    /**
     * 2. MENAMBAH KE KERANJANG & BELI SEKARANG
     */
    public function add(Request $request)
    {
        $user = session('user');
        $userId = $user['id'] ?? $user['user_id'] ?? null;

        if (!$userId) return redirect('/login')->with('error', 'Silakan login.');

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
            $cartId = $existingCart->id;
        } else {
            $newCart = Cart::create([
                'user_id'    => $userId,
                'product_id' => $request->product_id,
                'grade'      => $request->grade,
                'qty'        => $request->qty,
                'unit_price' => $request->unit_price,
            ]);
            $cartId = $newCart->id;
        }

        // Cek jika request datang dari tombol "Beli Sekarang"
        if ($request->input('buy_now') == 1) {
            // Simpan ID keranjang ke dalam session flash untuk dibaca di halaman keranjang
            return redirect()->route('cart')->with('buy_now_id', $cartId);
        }

        return redirect()->back()->with('success', 'Produk berhasil dimasukkan ke keranjang!');
    }

    /**
     * 3. CHECKOUT PRODUK TERPILIH
     */
    public function checkout(Request $request) 
    {
        $user = session('user');
        $userId = $user['id'] ?? $user['user_id'] ?? null;

        $selectedItems = $request->input('selected_items', []);

        if (empty($selectedItems)) {
            return back()->with('error', 'Pilih minimal satu produk untuk di-checkout!');
        }

        $items = Cart::with('product')
                    ->where('user_id', $userId)
                    ->whereIn('id', $selectedItems)
                    ->get();

        $order = Order::create(['user_id' => $userId, 'status' => 'diterima']);
        
        foreach ($items as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'grade'      => $item->grade,
                'price'      => $item->unit_price,
                'qty'        => $item->qty,
            ]);
            
            Product::where('product_id', $item->product_id)
                   ->decrement('stock_' . $item->grade, $item->qty);
        }

        Cart::where('user_id', $userId)->whereIn('id', $selectedItems)->delete();

        return redirect('/orders/' . $order->id . '/status')->with('success', 'Checkout berhasil!');
    }

    /**
     * 4. STATUS TRACKING
     */
    public function showStatus($id)
    {
        $order = Order::findOrFail($id);
        return view('order-status', compact('order'));
    }

    /**
     * 5. MENGHAPUS ITEM DARI KERANJANG
     */
    public function remove($id)
    {
        $user = session('user');
        $userId = $user['id'] ?? $user['user_id'] ?? null;

        // Mencari item berdasarkan ID dan User ID agar aman
        $item = Cart::where('id', $id)->where('user_id', $userId)->first();

        if ($item) {
            $item->delete();
            return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
        }

        return redirect()->back()->with('error', 'Produk tidak ditemukan.');
    }
}