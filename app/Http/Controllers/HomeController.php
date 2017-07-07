<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Pembelian;
use App\Bahan;
use App\IceCream;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index_manager()
    {
        $jumlahpermintaan = Pembelian::where('status', '=', 'menunggu')->count();
        // dd($datapengadaan);
        return view('admin.beranda')->with('jumlahpermintaan', $jumlahpermintaan);
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
