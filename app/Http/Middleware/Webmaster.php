<?php

namespace App\Http\Middleware;

use Closure;

class Webmaster
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
        if($request->user()->rol === "WEBMASTER"){
            return $next($request);
        }else{
            abort(403);
        }
    }
}
