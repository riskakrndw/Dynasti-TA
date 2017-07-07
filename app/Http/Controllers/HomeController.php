<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index_manager()
    {
        return view('admin.beranda');
    }

    public function index_keuangan()
    {
        return view('keuangan.beranda');
    }

    public function index_pengadaan()
    {
        return view('pengadaan.beranda');
    }
}
