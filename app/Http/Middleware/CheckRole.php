<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión para acceder a esta sección.');
        }

        $user = Auth::user();
        
        if (!$user || $user->rol !== $role) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        return $next($request);
    }
}
