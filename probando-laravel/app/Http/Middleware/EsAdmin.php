<?php

namespace App\Http\Middleware;

use Closure;

class EsAdmin
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
        //si el parametro 'admin' no esta, redirecciona a peras
        if (is_null($request->route('admin'))) {
            return redirect('fruteria/peras');
        } else {
            # code...
        }        

        return $next($request);
    }
}
