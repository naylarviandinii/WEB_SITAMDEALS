<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// TAMBAHKAN KETIGA BARIS DI BAWAH INI:
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Cart; // Pastikan Cart juga sudah di-import jika belum

class CartController extends Controller
{
    // ... isi kode controller Anda yang lain ...

    public function checkout() 
    {
        $user  = session('user');
        $items = Cart::with('product')->where('user_id', $user['user_id'])->get();
        if ($items->isEmpty()) return back()->with('error', 'Keranjang kosong!');

        // Sekarang Baris 50 tidak akan error lagi karena Order sudah di-import
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
            Product::where('product_id', $item->product_id)->decrement($col, $item->qty);
        }

        // Jangan lupa bersihkan keranjang setelah checkout sukses (opsional namun disarankan)
        Cart::where('user_id', $user['user_id'])->delete();

        return redirect()->route('products')->with('success', 'Checkout berhasil!');
    }
}