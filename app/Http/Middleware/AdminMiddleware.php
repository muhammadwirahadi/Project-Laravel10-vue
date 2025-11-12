<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Pastikan user sudah login dan role_id = 1
        if (!Auth::check() || Auth::user()->role_id !== 1) {
            // Kalau bukan admin, arahkan ke halaman utama
            return redirect('/');
        }

        return $next($request);
    }
}
