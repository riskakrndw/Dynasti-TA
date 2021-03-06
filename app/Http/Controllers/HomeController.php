<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Auth;

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
        // untuk informasi pemesanan
            $sesudah=Carbon::now()->addDays(5);
            $pemesanan=Pemesanan::whereBetween('tanggal',[Carbon::now(),$sesudah])->orderBy('tanggal', 'asc')->whereIn('status', ['menunggu', 'siap'])->get();
        // untuk informasi pemesanan
    
        // untuk informasi grafik transaksi  
            $data = Penjualan::getJumlahPenjualan();
            $tahun = Penjualan::getTahun();

            $thn=\Route::current()->parameter('tahun');
            if($thn){
                $th=DB::SELECT('select MONTH(tgl) as bulan, sum(total) as total_penjualan FROM penjualan WHERE YEAR(tgl)='.$thn.' group by bulan order by MONTH(tgl)');
                $thpemesanan=DB::SELECT('select MONTH(tanggal) as bulan, sum(total) as total_pemesanan FROM pemesanan WHERE YEAR(tanggal)='.$thn.' AND status = "selesai" group by bulan order by MONTH(tanggal)');
                $thpengadaan=DB::SELECT('select MONTH(tgl) as bulan, sum(total) as total_pengadaan FROM pembelian WHERE YEAR(tgl)='.$thn.' AND status in ("dibeli", "diterima") group by bulan order by MONTH(tgl)');
            }else{

                $th=DB::SELECT('select MONTH(tgl) as bulan, sum(total) as total_penjualan FROM penjualan WHERE YEAR(tgl)=YEAR(curdate()) group by bulan order by MONTH(tgl)');
                $thpemesanan=DB::SELECT('select MONTH(tanggal) as bulan, sum(total) as total_pemesanan FROM pemesanan WHERE YEAR(tanggal)=YEAR(curdate()) AND status = "selesai" group by bulan order by MONTH(tanggal)');
                $thpengadaan=DB::SELECT('select MONTH(tgl) as bulan, sum(total) as total_pengadaan FROM pembelian WHERE YEAR(tgl)=YEAR(curdate()) AND status in ("dibeli", "diterima") group by bulan order by MONTH(tgl)');
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
        // untuk informasi grafik transaksi

            $index = 0;
            $laporanpengadaan = array();
            for($i = 1; $i <= 12; $i++){
                if($index < count($thpengadaan)){
                    if($i == $thpengadaan[$index]->bulan){
                        $laporanpengadaan[$i]['total_pengadaan']=$thpengadaan[$index]->total_pengadaan;
                        $index++;
                    }else{
                        $laporanpengadaan[$i]['total_pengadaan']=0;
                    }
                }else{
                    $laporanpengadaan[$i]['total_pengadaan']=0;
                }
                $laporanpengadaan[$i]['bulan'] = $i;
            }

            $index = 0;
            $laporanuntungrugi = array();
            for($i = 1; $i <= 12; $i++){
                $laporanuntungrugi[$i]['bulan'] = $i;
                $laporanuntungrugi[$i]['total_untungrugi'] = $laporan[$i]['total_penjualan'] + $laporanpemesanan[$i]['total_pemesanan'] - $laporanpengadaan[$i]['total_pengadaan'];
            }
        

        // untuk info beranda
            $jumlahpermintaan = Pembelian::where('status', '=', 'menunggu')->count();
            $totalstokbahan = count(DB::select("select * from bahan_baku where stok < stok_min"));
            $totalstokes = count(DB::select("select * from ice_cream where stok < stok_min"));
        // untuk info beranda


        // info grafik es
            $laporanterlaris = DB::SELECT("select ice_cream.nama as nama, sum(jumlah) as Jumlah, month(penjualan.tgl) as bulan FROM ice_cream join detail_penjualan on detail_penjualan.id_es = ice_cream.id 
                join penjualan on penjualan.id = detail_penjualan.id_penjualan where month(penjualan.tgl)=".Carbon::now()->month." and year(penjualan.tgl) = ".Carbon::now()->year."
                GROUP BY nama, month(penjualan.tgl), year(penjualan.tgl) ORDER BY Jumlah desc LIMIT 10");

        // info grafik es

        return view('admin.beranda')->with('laporanuntungrugi', $laporanuntungrugi)->with('laporanterlaris', $laporanterlaris)->with('jumlahpermintaan', $jumlahpermintaan)->with('totalstokbahan', $totalstokbahan)->with('totalstokes', $totalstokes)->with('data', $data)->with('tahun', $tahun)->with('pemesanan', $pemesanan)->with('laporan', $laporan)->with('laporanpemesanan', $laporanpemesanan);
    }

    public function grafikuntung($tahun1)
    {
        if($tahun1){
            $th=DB::SELECT('select MONTH(tgl) as bulan, sum(total) as total_penjualan FROM penjualan WHERE YEAR(tgl)='.$tahun1.' group by bulan order by MONTH(tgl)');
            $thpemesanan=DB::SELECT('select MONTH(tanggal) as bulan, sum(total) as total_pemesanan FROM pemesanan WHERE YEAR(tanggal)='.$tahun1.' AND status = "selesai" group by bulan order by MONTH(tanggal)');
            $thpengadaan=DB::SELECT('select MONTH(tgl) as bulan, sum(total) as total_pengadaan FROM pembelian WHERE YEAR(tgl)='.$tahun1.' AND status in ("dibeli", "diterima") group by bulan order by MONTH(tgl)');
        }else{

            $th=DB::SELECT('select MONTH(tgl) as bulan, sum(total) as total_penjualan FROM penjualan WHERE YEAR(tgl)=YEAR(curdate()) group by bulan order by MONTH(tgl)');
            $thpemesanan=DB::SELECT('select MONTH(tanggal) as bulan, sum(total) as total_pemesanan FROM pemesanan WHERE YEAR(tanggal)=YEAR(curdate()) AND status = "selesai" group by bulan order by MONTH(tanggal)');
            $thpengadaan=DB::SELECT('select MONTH(tgl) as bulan, sum(total) as total_pengadaan FROM pembelian WHERE YEAR(tgl)=YEAR(curdate()) AND status in ("dibeli", "diterima") group by bulan order by MONTH(tgl)');
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
    // untuk informasi grafik transaksi

        $index = 0;
        $laporanpengadaan = array();
        for($i = 1; $i <= 12; $i++){
            if($index < count($thpengadaan)){
                if($i == $thpengadaan[$index]->bulan){
                    $laporanpengadaan[$i]['total_pengadaan']=$thpengadaan[$index]->total_pengadaan;
                    $index++;
                }else{
                    $laporanpengadaan[$i]['total_pengadaan']=0;
                }
            }else{
                $laporanpengadaan[$i]['total_pengadaan']=0;
            }
            $laporanpengadaan[$i]['bulan'] = $i;
        }

        $index = 0;
        $laporanuntungrugi = array();
        for($i = 1; $i <= 12; $i++){
            $laporanuntungrugi[] = $laporan[$i]['total_penjualan'] + $laporanpemesanan[$i]['total_pemesanan'] - $laporanpengadaan[$i]['total_pengadaan'];
        }

        return $laporanuntungrugi;
    }

    public function grafiktransaksi($tahun)
    {
        if($tahun){
            $th=DB::SELECT('select MONTH(tgl) as bulan, sum(total) as total_penjualan FROM penjualan WHERE YEAR(tgl)='.$tahun.' group by bulan order by MONTH(tgl)');
            $thpemesanan=DB::SELECT('select MONTH(tanggal) as bulan, sum(total) as total_pemesanan FROM pemesanan WHERE YEAR(tanggal)='.$tahun.' AND status = "selesai"  group by bulan order by MONTH(tanggal)');
        }else{
            $th=DB::SELECT('select MONTH(tgl) as bulan, sum(total) as total_penjualan FROM penjualan WHERE YEAR(tgl)=YEAR(curdate()) group by bulan order by MONTH(tgl)');
            $thpemesanan=DB::SELECT('select MONTH(tanggal) as bulan, sum(total) as total_pemesanan FROM pemesanan WHERE YEAR(tanggal)=YEAR(curdate()) AND status = "selesai" group by bulan order by MONTH(tanggal)');
        }

        $index = 0;
        $laporan = array();
        for($i = 1; $i <= 12; $i++){
            if($index < count($th)){
                if($i == $th[$index]->bulan){
                    $laporan[]=$th[$index]->total_penjualan;
                    $index++;
                }else{
                    $laporan[]=0;
                }
            }else{
                $laporan[]=0;
            }
        }

        $index = 0;
        $laporanpemesanan = array();
        for($i = 1; $i <= 12; $i++){
            if($index < count($thpemesanan)){
                if($i == $thpemesanan[$index]->bulan){
                    $laporanpemesanan[]=$thpemesanan[$index]->total_pemesanan;
                    $index++;
                }else{
                    $laporanpemesanan[]=0;
                }
            }else{
                $laporanpemesanan[]=0;
            }
        }
    // untuk informasi grafik transaksi
        $laporansemua[] = $laporan;
        $laporansemua[] = $laporanpemesanan; 
        return $laporansemua;
    }

    public function stokBahan(){

        

        if(Auth::user()->level == "manager"){
            $data = DB::select("select * from bahan_baku where stok < stok_min");
            return view('admin.stokBahan')->with('data', $data);
        } elseif (Auth::user()->level == "pengadaan"){
            $data = DB::select("select * from bahan_baku where stok < stok_min");
            return view('pengadaan.stokBahan')->with('data', $data);
        }
    }

    public function stokIce(){
        if(Auth::user()->level == "manager"){
            $data = DB::select("select * from ice_cream where stok < stok_min");
            return view('admin.stokIce')->with('data', $data);
        } elseif (Auth::user()->level == "pengadaan"){
            $data = DB::select("select * from ice_cream where stok < stok_min");
            return view('pengadaan.stokIce')->with('data', $data);
        }
    }

    public function index_keuangan()
    {
        // untuk informasi beranda
            $totalpengadaan = DB::table('pembelian')->where('status', '=', 'diterima')->whereMonth('tgl', '=', Carbon::now()->month)->sum('total');
            $totalpenjualan = DB::table('penjualan')->whereMonth('tgl', '=', Carbon::now()->month)->sum('total');
            // DB::SELECT('select sum(total) FROM penjualan group by bulan order by MONTH(tgl)')
            $jumlahpembelian = Pembelian::where('status', '=', 'disetujui')->count();
        // untuk informasi beranda 

        // untuk informasi grafik        
            $data = Penjualan::getJumlahPenjualan();
            $tahun = Penjualan::getTahun();

            $thn=\Route::current()->parameter('tahun');
            if($thn){
                $th=DB::SELECT('select MONTH(tgl) as bulan, sum(total) as total_penjualan FROM penjualan WHERE YEAR(tgl)='.$thn.' group by bulan order by MONTH(tgl)');
                $thpengadaan=DB::SELECT('select MONTH(tgl) as bulan, sum(total) as total_pengadaan FROM pembelian WHERE YEAR(tgl)='.$thn.' AND status = "diterima" group by bulan order by MONTH(tgl)');
            }else{
                $th=DB::SELECT('select MONTH(tgl) as bulan, sum(total) as total_penjualan FROM penjualan WHERE YEAR(tgl)=YEAR(curdate()) group by bulan order by MONTH(tgl)');
                $thpengadaan=DB::SELECT('select MONTH(tgl) as bulan, sum(total) as total_pengadaan FROM pembelian WHERE YEAR(tgl)=YEAR(curdate()) AND status = "diterima" group by bulan order by MONTH(tgl)');
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
            $laporanpengadaan = array();
            for($i = 1; $i <= 12; $i++){
                if($index < count($thpengadaan)){
                    if($i == $thpengadaan[$index]->bulan){
                        $laporanpengadaan[$i]['total_pengadaan']=$thpengadaan[$index]->total_pengadaan;
                        $index++;
                    }else{
                        $laporanpengadaan[$i]['total_pengadaan']=0;
                    }
                }else{
                    $laporanpengadaan[$i]['total_pengadaan']=0;
                }
                $laporanpengadaan[$i]['bulan'] = $i;
            }

            $index = 0;
            $laporanuntungrugi = array();
            for($i = 1; $i <= 12; $i++){
                $laporanuntungrugi[$i]['bulan'] = $i;
                $laporanuntungrugi[$i]['total_untungrugi'] = $laporan[$i]['total_penjualan'] - $laporanpengadaan[$i]['total_pengadaan'];
            }

        // untuk informasi grafik

        return view('keuangan.beranda')->with('laporanuntungrugi', $laporanuntungrugi)->with('jumlahpembelian', $jumlahpembelian)->with('totalpengadaan', $totalpengadaan)->with('totalpenjualan', $totalpenjualan)->with('data', $data)->with('tahun', $tahun)->with('laporan', $laporan);
    }

    public function grafiktransaksikeu($tahun)
    {
        if($tahun){
            $th=DB::SELECT('select MONTH(tgl) as bulan, sum(total) as total_penjualan FROM penjualan WHERE YEAR(tgl)='.$tahun.' group by bulan order by MONTH(tgl)');
            $thpemesanan=DB::SELECT('select MONTH(tanggal) as bulan, sum(total) as total_pemesanan FROM pemesanan WHERE YEAR(tanggal)='.$tahun.' group by bulan order by MONTH(tanggal)');
        }else{
            $th=DB::SELECT('select MONTH(tgl) as bulan, sum(total) as total_penjualan FROM penjualan WHERE YEAR(tgl)=YEAR(curdate()) group by bulan order by MONTH(tgl)');
            $thpemesanan=DB::SELECT('select MONTH(tanggal) as bulan, sum(total) as total_pemesanan FROM pemesanan WHERE YEAR(tanggal)=YEAR(curdate()) group by bulan order by MONTH(tanggal)');
        }

        $index = 0;
        $laporan = array();
        for($i = 1; $i <= 12; $i++){
            if($index < count($th)){
                if($i == $th[$index]->bulan){
                    $laporan[]=$th[$index]->total_penjualan;
                    $index++;
                }else{
                    $laporan[]=0;
                }
            }else{
                $laporan[]=0;
            }
        }

        $index = 0;
        $laporanpemesanan = array();
        for($i = 1; $i <= 12; $i++){
            if($index < count($thpemesanan)){
                if($i == $thpemesanan[$index]->bulan){
                    $laporanpemesanan[]=$thpemesanan[$index]->total_pemesanan;
                    $index++;
                }else{
                    $laporanpemesanan[]=0;
                }
            }else{
                $laporanpemesanan[]=0;
            }
        }
    // untuk informasi grafik transaksi
        $laporansemua[] = $laporan;
        $laporansemua[] = $laporanpemesanan; 
        return $laporansemua;
    }

    public function index_pengadaan()
    {
        // untuk info beranda
            $jumlahpenerimaan = Pembelian::where('status', '=', 'dibeli')->count();
            $totalstokbahan = count(DB::select("select * from bahan_baku where stok < stok_min"));
            $totalstokes = count(DB::select("select * from ice_cream where stok < stok_min"));
        // untuk info beranda
        return view('pengadaan.beranda')->with('jumlahpenerimaan', $jumlahpenerimaan)->with('totalstokbahan', $totalstokbahan)->with('totalstokes', $totalstokes);
    }

    public function index_produksi()
    {
        $data = IceCream::all();

        // untuk informasi pemesanan
            $sesudah=Carbon::now()->addDays(5);
            $pemesanan=Pemesanan::whereBetween('tanggal',[Carbon::now(),$sesudah])->orderBy('tanggal', 'asc')->whereIn('status', ['menunggu', 'siap'])->get();
        // untuk informasi pemesanan

        return view('produksi.beranda')->with('data', $data)->with('pemesanan', $pemesanan);
    }

    public function pilihTerlaris($tahun, $bulan){
        $laporanterlaris = DB::SELECT("select ice_cream.nama as nama, sum(jumlah) as Jumlah, month(penjualan.tgl) as bulan FROM ice_cream join detail_penjualan on detail_penjualan.id_es = ice_cream.id 
                join penjualan on penjualan.id = detail_penjualan.id_penjualan where month(penjualan.tgl)=".$bulan." and year(penjualan.tgl) = ".$tahun."
                GROUP BY nama, month(penjualan.tgl), year(penjualan.tgl) ORDER BY Jumlah desc LIMIT 10");
        return $laporanterlaris;
    }
}