<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Penjualan;
use App\Pembelian;
use App\Pemesanan;
use App\Produksi;
use App\IceCream;
use App\Bahan;

class LaporanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function laporanPembelian()
    {
        $data = Pembelian::whereMonth('tgl', Carbon::now()->month)->whereIn('status', ['diterima', 'dibeli'])->get();
        return view('admin.laporan_pembelian')->with('eror','null')->with('data', $data);
    }

    public function lappengadaan(Request $request){
        $data=Pembelian::whereBetween('tgl',[$request->tgl_a,$request->tgl_b])->orderBy('tgl', 'asc')->whereIn('status', ['diterima', 'dibeli'])->get();
        return $data;
    }

    public function cetakpengadaan($tgl_a,$tgl_b){
        $data=Pembelian::whereBetween('tgl',[$tgl_a,$tgl_b])->orderBy('tgl', 'asc')->whereIn('status', ['diterima', 'dibeli'])->get();
        $totalpengadaan = DB::table('pembelian')->sum('total');
        return view('admin.print_pengadaan')->with('data',$data)->with('tgl_a',$tgl_a)->with('tgl_b',$tgl_b)->with('totalpengadaan', $totalpengadaan);
    }

    public function laporanPenjualan()
    {
        $data = Penjualan::whereMonth('tgl', Carbon::now()->month)->get();
        return view('admin.laporan_penjualan')->with('eror','null')->with('data', $data);
    }

    public function lappenjualan(Request $request){
        $data=Penjualan::whereBetween('tgl',[$request->tgl_a,$request->tgl_b])->orderBy('tgl', 'asc')->get();
        return $data;
    }

    public function cetakpenjualan($tgl_a,$tgl_b){
        $data=Penjualan::whereBetween('tgl',[$tgl_a,$tgl_b])->orderBy('tgl', 'asc')->get();
        $totalpenjualan = DB::table('penjualan')->sum('total');
        return view('admin.print_penjualan')->with('data',$data)->with('tgl_a',$tgl_a)->with('tgl_b',$tgl_b)->with('totalpenjualan', $totalpenjualan);
    }
    
    public function laporanPemesanan()
    {
        $data = Pemesanan::whereMonth('tanggal', Carbon::now()->month)->where('status', 'selesai')->get();
        return view('admin.laporan_pemesanan')->with('eror','null')->with('data', $data);
    }

    public function lappemesanan(Request $request){
        $data=Pemesanan::whereBetween('tanggal',[$request->tgl_a,$request->tgl_b])->orderBy('tanggal', 'asc')->where('status', 'selesai')->get();
        return $data;
    }

    public function cetakpemesanan($tgl_a,$tgl_b){
        $data=Pemesanan::whereBetween('tanggal',[$tgl_a,$tgl_b])->orderBy('tanggal', 'asc')->where('status', 'selesai')->get();
        $totalpemesanan = DB::table('pemesanan')->sum('total');
        return view('admin.print_pemesanan')->with('data',$data)->with('tgl_a',$tgl_a)->with('tgl_b',$tgl_b)->with('totalpemesanan', $totalpemesanan);
    }

    public function laporanProduksi()
    {
        $data = Produksi::whereMonth('tgl', Carbon::now()->month)->get();
        return view('admin.laporan_produksi')->with('eror','null')->with('data', $data);
    }

    public function lapproduksi(Request $request){
        $data=Produksi::whereBetween('tgl',[$request->tgl_a,$request->tgl_b])->orderBy('tgl', 'asc')->get();
        return $data;
    }

    public function cetakproduksi($tgl_a,$tgl_b){
        $data=Produksi::whereBetween('tgl',[$tgl_a,$tgl_b])->orderBy('tgl', 'asc')->get();
        return view('admin.print_produksi')->with('data',$data)->with('tgl_a',$tgl_a)->with('tgl_b',$tgl_b);
    }

    public function laporanEs()
    {
        $data = IceCream::all();
        return view('admin.laporan_es')->with('data', $data);
    }

    public function cetakes(){
         $data = IceCream::all();
        return view('admin.print_stok_es')->with('data', $data);
    }

    public function laporanBahan()
    {
        $data = Bahan::all();
        return view('admin.laporan_bahan')->with('data', $data);
    }

    public function cetakbahan(){
         $data = Bahan::all();
        return view('admin.print_stok_bahan')->with('data', $data);
    }
}
