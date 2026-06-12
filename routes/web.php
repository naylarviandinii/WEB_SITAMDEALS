<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    ProductController,
    CartController,
    OrderController,
    ProfileController,
    AdminProductController, // ← Sudah di-import
    KasirOrderController    // ← Sudah di-import
};

// Pastikan rute ini ada
Route::get('/invoice/{id}', [OrderController::class, 'downloadInvoice']);
Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/admin/orders/{id}/invoice', [KasirOrderController::class, 'invoice'])->name('orders.invoice');
Route::get('/orders/history', [OrderController::class, 'history']);
// ==========================================
// 1. AUTHENTICATION (Bisa diakses tanpa login)
// ==========================================
Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',    [AuthController::class, 'login']);
Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout',    [AuthController::class, 'logout'])->name('logout');


// ==========================================
// 2. PAGES UNTUK SEMUA ROLE (Wajib Login)
// ==========================================
// Kita gunakan middleware 'role' tanpa parameter, artinya asal sudah login (role apa saja) bisa masuk.
Route::middleware(['role'])->group(function () {

    // Beranda & Katalog Produk Umum
    Route::get('/',             [ProductController::class, 'home'])->name('home');
    Route::get('/products',      [ProductController::class, 'index'])->name('products');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.detail');

    // Keranjang Belanja
    Route::get('/cart',          [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add',     [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/{id}',  [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // Manajemen Order & Riwayat
    Route::get('/invoice/{id}',  [OrderController::class, 'invoice'])->name('invoice');
    Route::get('/history',       [OrderController::class, 'history'])->name('history');

    // Pengaturan Profil User
    Route::get('/profil',           [ProfileController::class, 'index'])->name('profil');
    Route::post('/profil',          [ProfileController::class, 'update']);
    Route::post('/profil/password', [ProfileController::class, 'updatePassword']);
    Route::get('/profil/delete',    [ProfileController::class, 'destroy']);


    // ==========================================
    // 3. KELOMPOK AKSES KHUSUS: KASIR
    // ==========================================
    Route::middleware(['role:kasir'])->group(function () {
        Route::get('/admin/orders', [KasirOrderController::class, 'index']);
        Route::patch('/admin/orders/{id}/update-status', [KasirOrderController::class, 'updateStatus']);
    });


    // ==========================================
    // 4. KELOMPOK AKSES KHUSUS: ADMIN
    // ==========================================
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard',       [AdminProductController::class, 'dashboard']);
        Route::get('/admin/products/create', [AdminProductController::class, 'create']);
        Route::post('/admin/products',        [AdminProductController::class, 'store']);
        Route::get('/admin/products/{id}/edit', [AdminProductController::class, 'edit']);
        Route::put('/admin/products/{id}',    [AdminProductController::class, 'update']);
        Route::delete('/admin/products/{id}', [AdminProductController::class, 'destroy']);
    });
    Route::get('/orders/{id}/status', [CartController::class, 'showStatus'])->name('orders.status');
    // Route::get('/orders/{id}/invoice-customer', [KasirOrderController::class, 'invoice'])->name('orders.invoice-customer');
});
