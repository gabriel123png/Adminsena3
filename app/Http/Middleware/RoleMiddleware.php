<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (! $request->user() || $request->user()->role !== $role) {
            return redirect()
                ->route($request->user()?->role === 'aprendiz' ? 'apprentice.dashboard' : 'home')
                ->with('error', 'No tienes permisos para acceder a esa sección.');
        }

        return $next($request);
    }
}
