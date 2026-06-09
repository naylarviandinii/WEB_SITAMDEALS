<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()  
    { 
        return view('auth.login'); 
    }

    // Menampilkan halaman register
    public function showRegister() 
    { 
        return view('auth.register'); 
    }

   // Proses Login
    public function login(Request $request) 
    {
        // Jalankan validasi input terlebih dahulu
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Cek apakah user ada DAN password-nya cocok (menggunakan Hash::check)
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
        }

        // ====== KUNCI PERBAIKAN DI SINI ======
        // Jangan pakai toArray(), kita petakan manual komponennya ke session agar pasti terbaca
        session([
            'user' => [
                'id'    => $user->user_id,
                'name'  => $user->name,
                'email' => $user->email,
                'role'  => $user->role, // Dipaksa masuk ke session array
            ]
        ]);
        // =====================================

        // Pengalihan halaman berdasarkan role
        return match($user->role) {
            'admin'  => redirect('/admin/dashboard'),
            'kasir'  => redirect('/admin/orders'),
            default  => redirect('/'),
        };
    }

    // Proses Logout
    public function logout() 
    {
        session()->forget('user');
        return redirect('/login');
    }

    // Proses Register Akun Baru
    public function register(Request $request) 
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // Buat user baru dengan password yang di-hash aman
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password), // Di-hash di sini
            'role'     => 'pembeli',
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil!');
    }
}