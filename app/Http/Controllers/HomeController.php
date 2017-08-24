<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Pembelian;
use App\Pemesanan;
use App\Penjualan;
use App\Bahan;
use App\IceCream;
use Carbon\Carbon;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index_manager()
    {
        //$data = Penjualan::get();

        $sesudah=Carbon::now()->addDays(3);
        $pemesanan=Pemesanan::whereBetween('tanggal',[Carbon::now(),$sesudah])->get();

        $data = Penjualan::getJumlahPenjualan();
        $tahun = Penjualan::getTahun();

        $thn=\Route::current()->parameter('tahun');
        if($thn){
            $th=DB::SELECT('select MONTHNAME(tgl) as bulan, sum(total) as total_penjualan FROM penjualan WHERE YEAR(tgl)='.$thn.' group by bulan ASc');
        }else{

            $th=DB::SELECT('select MONTHNAME(tgl) as bulan, sum(total) as total_penjualan FROM penjualan WHERE YEAR(tgl)=YEAR(curdate()) group by bulan ASC');
        }

        $jumlahpermintaan = Pembelian::where('status', '=', 'menunggu')->count();
        $totalstokbahan = count(DB::select("select * from bahan_baku where stok < stok_min"));
        $totalstokes = IceCream::where('stok', '<', '100')->count();
        // dd($datapengadaan);
        return view('admin.beranda')->with('jumlahpermintaan', $jumlahpermintaan)->with('totalstokbahan', $totalstokbahan)->with('totalstokes', $totalstokes)->with('data', $data)->with('tahun', $tahun)->with('pemesanan', $pemesanan)->with('th', $th);
    }

    public function stokBahan(){

        $data = DB::select("select * from bahan_baku where stok < stok_min");
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
