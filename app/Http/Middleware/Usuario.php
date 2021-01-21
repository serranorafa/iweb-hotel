<?php

namespace App\Http\Middleware;

use Closure;
use App\Reserva;

class Usuario
{
    /**
     * Comprueba que el usuario tiene acceso a la vista detalles reserva que quiere acceder.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Recepcionista y Webmaster pueden acceder a todas
        if ($request->user()->rol === "RECEPCIONISTA" || $request->user()->rol === "WEBMASTER") {
            return $next($request);
        }
        // Usuario solo a las suyas
        else if ($request->user()->rol === "CLIENTE") {
            $idUserReserva = Reserva::whereNotNull('usuario_id')
                        ->whereNotNull('id')
                        ->where('id', $request->route('id'))
                        ->pluck('usuario_id')->first();

            if ($request->user()->id == $idUserReserva) {
                return $next($request);
            }
        }
        abort(403);
    }
}
