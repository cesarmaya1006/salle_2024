<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminEmp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$this->permiso()) {
            return redirect('dashboard')->with('mensaje', 'Su rol aignado no le permite el ingreso a esta parte del sistema');
        }
        return $next($request);
    }

    private function permiso()
    {
        return in_array('Super Administrador',session('roles')) || in_array('Administrador Empresa',session('roles'));

    }
}
