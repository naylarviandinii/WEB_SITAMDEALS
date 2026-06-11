<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf; // JANGAN SAMPAI BARIS INI TERHAPUS

class OrderController extends Controller
{
    // Halaman invoice langsung generate & stream sebagai PDF saat dibuka
    public function invoice($id) 
    {
        $user = session('user');
        
        // Ambil ID dengan aman menggunakan fallback selector seperti di fungsi history
        $userId = $user['id'] ?? $user['user_id'] ?? null;

        if (!$userId) {
            return redirect('/login');
        }

        // Mengambil data order berdasarkan ID dan pastikan milik user yang sedang login
        $order = Order::with(['items.product'])
                      ->where('id', $id)
                      ->where('user_id', $userId)
                      ->firstOrFail();

        // Hitung total harga belanjaan
        $total = $order->items->sum(fn($i) => $i->price * $i->qty);

        // Memuat view invoice dan mengirim data order & total
        // Memanggil Facade Pdf yang sudah di-import dengan benar di atas
        $pdf = Pdf::loadView('orders.invoice', compact('order', 'total'));
        
        // Menampilkan langsung sebagai PDF di browser dengan nama file dinamis
        return $pdf->stream('Invoice_'.$order->id.'.pdf');
    }

    // RIWAYAT TRANSAKSI
    public function history()
    {
        $user = session('user');
        $userId = $user['id'] ?? $user['user_id'] ?? null;

        if (!$userId) {
            return redirect('/login');
        }

        // Mengambil semua order milik user yang sedang login
        $orders = Order::where('user_id', $userId)->orderBy('created_at', 'desc')->get();

        return view('orders.history', compact('orders'));
    }
}