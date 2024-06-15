<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminSis
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$this->permiso()) {
            return redirect('dashboard')->with('mensaje', 'No tiene permiso para entrar aquí');
        }
        return $next($request);
    }

    private function permiso()
    {
        return in_array('Super Administrador',session('roles'));

    }
}
