<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Konversi role ke integer
        $requiredRole = (int)$role;
        $userRole = Auth::user()->role;

        if ($userRole !== $requiredRole) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akses ditolak. Role tidak sesuai.');
        }

        return $next($request);
    }
}
