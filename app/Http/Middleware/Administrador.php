<?php

namespace App\Http\Middleware;

use Closure;

class Administrador
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
      if ($request->user()->admin()) {
        return $next($request);
      }else{
        //el parametro de abort puede ser una vista almacenada en views/erros Metemos la vista de acceso denegado
        abort(503);
      }
    }
}
