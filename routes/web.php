<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, ProductController, CartController, OrderController, ProfileController};

// Auth (tanpa middleware)
Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register',[AuthController::class, 'register']);
Route::get('/logout',   [AuthController::class, 'logout']);

// Pages (butuh login)
Route::middleware('auth.check')->group(function () {
    Route::get('/',          [ProductController::class, 'home'])->name('home');
    Route::get('/products',  [ProductController::class, 'index'])->name('products');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.detail');

    // Keranjang
    Route::get('/cart',            [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add',       [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/{id}',    [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout',  [CartController::class, 'checkout'])->name('cart.checkout');

    // Order
    Route::get('/invoice/{id}',    [OrderController::class, 'invoice'])->name('invoice');
    Route::get('/history',         [OrderController::class, 'history'])->name('history'); // ← RIWAYAT

    // Profil
    Route::get('/profil',          [ProfileController::class, 'index'])->name('profil');
    Route::post('/profil',         [ProfileController::class, 'update']);
    Route::post('/profil/password',[ProfileController::class, 'updatePassword']);
    Route::get('/profil/delete',   [ProfileController::class, 'destroy']);
});;
