<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjualan;
use App\Pembelian;
use App\Pemesanan;
use App\Produksi;
use App\IceCream;
use App\Bahan;

class LaporanController extends Controller
{
    public function laporanPembelian()
    {
        return view('admin.laporan_pembelian')->with('eror','null');
    }

    public function lappengadaan(Request $request){
        $data=Pembelian::whereBetween('tgl',[$request->tgl_a,$request->tgl_b])->get();
        return $data;
    }

    public function cetakpengadaan($tgl_a,$tgl_b){
        $data=Pembelian::whereBetween('tgl',[$tgl_a,$tgl_b])->get();
        return view('admin.print_pengadaan')->with('data',$data)->with('tgl_a',$tgl_a)->with('tgl_b',$tgl_b);
    }

    public function laporanPenjualan()
    {
        return view('admin.laporan_penjualan')->with('eror','null');
    }

    public function lappenjualan(Request $request){
        $data=Penjualan::whereBetween('tgl',[$request->tgl_a,$request->tgl_b])->get();
        return $data;
    }

    public function cetakpenjualan($tgl_a,$tgl_b){
        $data=Penjualan::whereBetween('tgl',[$tgl_a,$tgl_b])->get();
        return view('admin.print_penjualan')->with('data',$data)->with('tgl_a',$tgl_a)->with('tgl_b',$tgl_b);
    }
    
    public function laporanPemesanan()
    {
        return view('admin.laporan_pemesanan')->with('eror','null');
    }

    public function lappemesanan(Request $request){
        $data=Pemesanan::whereBetween('tanggal',[$request->tgl_a,$request->tgl_b])->get();
        return $data;
    }

    public function cetakpemesanan($tgl_a,$tgl_b){
        $data=Pemesanan::whereBetween('tanggal',[$tgl_a,$tgl_b])->get();
        return view('admin.print_pemesanan')->with('data',$data)->with('tgl_a',$tgl_a)->with('tgl_b',$tgl_b);
    }

    public function laporanProduksi()
    {
        return view('admin.laporan_produksi')->with('eror','null');
    }

    public function lapproduksi(Request $request){
        $data=Produksi::whereBetween('tgl',[$request->tgl_a,$request->tgl_b])->get();
        return $data;
    }

    public function cetakproduksi($tgl_a,$tgl_b){
        $data=Produksi::whereBetween('tgl',[$tgl_a,$tgl_b])->get();
        return view('admin.print_produksi')->with('data',$data)->with('tgl_a',$tgl_a)->with('tgl_b',$tgl_b);
    }

    public function laporanEs()
    {
        $data = IceCream::all();
        return view('admin.laporan_es')->with('data', $data);
    }

    public function cetakes(){
         $data = IceCream::all();
        return view('admin.print_stok_es')->with('data', $data);;
    }

    public function laporanBahan()
    {
        $data = Bahan::all();
        return view('admin.laporan_bahan')->with('data', $data);
    }

    public function cetakbahan(){
         $data = Bahan::all();
        return view('admin.print_stok_bahan')->with('data', $data);;
    }
}
