<?php

namespace App\Http\Middleware;

use Closure;

class CourtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->user()->role == 'empleado')
            return $next($request);

        return redirect('/');
    }
}
