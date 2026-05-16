<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
    public function handle(Request $request, Closure $next) {
    if (!session('user')) {
        return redirect('/login');
    }
    return $next($request);
}

}
