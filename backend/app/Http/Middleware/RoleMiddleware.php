<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Verifica se o utilizador possui o perfil permitido.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Verifica se existe um utilizador autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Verifica o perfil
        if (Auth::user()->role !== $role) {

            abort(403, 'Acesso negado.');

        }

        return $next($request);
    }
}