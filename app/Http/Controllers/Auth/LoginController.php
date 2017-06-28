<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/manager/beranda';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        if(auth()->user()->level=="manager"){
            return "/manager/beranda";
        }
        elseif(auth()->user()->level=="keuangan"){
            return "/keuangan/beranda";
        }
        elseif(auth()->user()->level=="produksi"){
            return "/produksi/beranda";
        }
        elseif (auth()->user()->level=="pengadaan") {
            return "/pengadaan/beranda";
        }
    }
}
