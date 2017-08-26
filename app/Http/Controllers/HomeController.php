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

        $sesudah=Carbon::now()->addDays(10);
        $pemesanan=Pemesanan::whereBetween('tanggal',[Carbon::now(),$sesudah])->orderBy('tanggal', 'asc')->get();

        // dd($pemesanan);

        $data = Penjualan::getJumlahPenjualan();
        $tahun = Penjualan::getTahun();

        $thn=\Route::current()->parameter('tahun');
        if($thn){
            $th=DB::SELECT('select MONTH(tgl) as bulan, sum(total) as total_penjualan FROM penjualan WHERE YEAR(tgl)='.$thn.' group by bulan order by MONTH(tgl)');
            $thpemesanan=DB::SELECT('select MONTH(tanggal) as bulan, sum(total) as total_pemesanan FROM pemesanan WHERE YEAR(tanggal)='.$thn.' group by bulan order by MONTH(tanggal)');
        }else{

            $th=DB::SELECT('select MONTH(tgl) as bulan, sum(total) as total_penjualan FROM penjualan WHERE YEAR(tgl)=YEAR(curdate()) group by bulan order by MONTH(tgl)');
            $thpemesanan=DB::SELECT('select MONTH(tanggal) as bulan, sum(total) as total_pemesanan FROM pemesanan WHERE YEAR(tanggal)=YEAR(curdate()) group by bulan order by MONTH(tanggal)');
        }

        $index = 0;
        $laporan = array();
        for($i = 1; $i <= 12; $i++){
            if($index < count($th)){
                if($i == $th[$index]->bulan){
                    $laporan[$i]['total_penjualan']=$th[$index]->total_penjualan;
                    $index++;
                }else{
                    $laporan[$i]['total_penjualan']=0;
                }
            }else{
                $laporan[$i]['total_penjualan']=0;
            }
            $laporan[$i]['bulan'] = $i;
        }

        $index = 0;
        $laporanpemesanan = array();
        for($i = 1; $i <= 12; $i++){
            if($index < count($thpemesanan)){
                if($i == $thpemesanan[$index]->bulan){
                    $laporanpemesanan[$i]['total_pemesanan']=$thpemesanan[$index]->total_pemesanan;
                    $index++;
                }else{
                    $laporanpemesanan[$i]['total_pemesanan']=0;
                }
            }else{
                $laporanpemesanan[$i]['total_pemesanan']=0;
            }
            $laporanpemesanan[$i]['bulan'] = $i;
        }

        $jumlahpermintaan = Pembelian::where('status', '=', 'menunggu')->count();
        $totalstokbahan = count(DB::select("select * from bahan_baku where stok < stok_min"));
        $totalstokes = IceCream::where('stok', '<', '100')->count();
        return view('admin.beranda')->with('jumlahpermintaan', $jumlahpermintaan)->with('totalstokbahan', $totalstokbahan)->with('totalstokes', $totalstokes)->with('data', $data)->with('tahun', $tahun)->with('pemesanan', $pemesanan)->with('laporan', $laporan)->with('laporanpemesanan', $laporanpemesanan);
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
