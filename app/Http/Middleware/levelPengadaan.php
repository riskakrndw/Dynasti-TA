<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class levelPengadaan
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
        if(Auth::user()){
            if(Auth::user()->level != "pengadaan"){
                return redirect ('/forbidden');
            }
        }

        return $next($request);
    }
}
