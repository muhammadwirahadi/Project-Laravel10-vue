<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedByRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika user sudah login
        if (Auth::check()) {
            $user = Auth::user();

            // Jika admin (role_id = 1)
            if ($user->role_id == 1) {
                return redirect()->route('admin.dashboard');
            }

            // Jika user biasa (role_id = 2 atau null)
            return redirect()->route('welcome');
        }

        return $next($request);
    }
}
