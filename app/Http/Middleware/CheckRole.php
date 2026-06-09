<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek mutlak: Kalau tidak ada session 'user', tendang ke login
        if (!$request->session()->has('user')) {
            return redirect('/login')->withErrors(['email' => 'Silahkan login terlebih dahulu.']);
        }

        $sessionUser = $request->session()->get('user');

        // 2. Ambil data ter-update dari database berdasarkan ID di session
        $userDb = User::find($sessionUser['id'] ?? null);

        // Kalau usernya tiba-tiba tidak ada di DB, paksa logout
        if (!$userDb) {
            $request->session()->forget('user');
            return redirect('/login');
        }

        // 3. JIKA RUTE MEMINTA ROLE SPESIFIK (Contoh: role:kasir atau role:admin)
        if (!empty($roles)) {
            // Cek apakah role si user ada di dalam daftar yang diizinkan rute
            if (!in_array($userDb->role, $roles)) {
                abort(403, 'AKES DITOLAK! ANDA TIDAK MEMILIKI IZIN UNTUK HALAMAN INI.');
            }
        }

        // Kalau lolos semua pengecekan, lanjutkan ke halaman yang dituju
        return $next($request);
    }
}