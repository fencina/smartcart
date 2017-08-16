<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (!$request->user()->hasRole($role) && !$request->user()->isSuperAdmin()) {
            return redirect()->route('home')->withErrors('No tiene permisos para acceder a esta sección');
        }

        return $next($request);
    }
}
