<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(auth()->user()->level=="manager"){
                return redirect("/manager/beranda");
            }
            elseif(auth()->user()->level=="keuangan"){
                return redirect("/keuangan/beranda");
            }
            elseif(auth()->user()->level=="produksi"){
                return redirect("/produksi/beranda");
            }
            elseif (auth()->user()->level=="pengadaan") {
                return redirect("/pengadaan/beranda");
            }
        }

        return $next($request);
    }
}
