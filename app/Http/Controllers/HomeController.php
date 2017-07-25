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
        $totalstokbahan = Bahan::where('stok', '<', 'stok_min')->count();
        $totalstokes = IceCream::where('stok', '<', '100')->count();
        // dd($datapengadaan);
        return view('admin.beranda')->with('jumlahpermintaan', $jumlahpermintaan)->with('totalstokbahan', $totalstokbahan)->with('totalstokes', $totalstokes);
    }

    public function stokBahan(){

        $data = Bahan::where('stok', '<', '30')->get();
        return view('admin.stokBahan')->with('data', $data);
    }

    public function stokIce(){
        $data = IceCream::where('stok', '<', '100')->get();
        return view('admin.stokIce')->with('data', $data);
    }

    public function index_keuangan()
    {
        return view('keuangan.beranda');
    }

    public function index_pengadaan()
    {
        return view('pengadaan.beranda');
    }

    public function index_produksi()
    {
        return view('produksi.beranda');
    }
}
