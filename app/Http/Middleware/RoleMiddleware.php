<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()){
            return redirect('/login');
        }

        $userRole = Auth::user()->role;

        if ($userRole !== $role) {
            abort(403, 'Akses ditolak! Anda tidak memiliki hak akses.');
        }
        return $next($request);
    }
}
