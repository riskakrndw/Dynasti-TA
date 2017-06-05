<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Penjualan;
use App\DetailPenjualan;
use App\IceCream;

class PenjualanController extends Controller
{
    
    public function index()
    {
    	$data = Penjualan::all();
    	return view('admin.penjualan')->with('data', $data);
    }

    public function tambah()
    {
    	$dataIceCream = DetailPenjualan::get();
    	return view('admin.penjualan_tambah');
    }

    public function store($kode, $datepicker, $total)
    {
        $data = new Penjualan;
        $data->kode_penjualan = $kode;
        $data->tgl = $datepicker;
        $data->total = $total;
        $data->save();

        return $data->id;
    }

    public function store1($idjual, $namaes, $jumlah, $subtotal)
    {
        $ides = IceCream::where('nama', '=', $namaes)->first()->id;
        $datadetail = new DetailPenjualan;
        $datadetail->id_penjualan = $idjual;
        $datadetail->id_es = $ides;
        $datadetail->jumlah = $jumlah;
        $datadetail->subtotal = $subtotal;
        $datadetail->save();
    }

    public function edit($id)
    {
    	$data = Penjualan::find($id);
    }

    public function ubah($id_jual, $kode, $datepicker, $total)
    {
    	$data = Penjualan::find($id_jual);
    	$data->kode_penjualan = $kode;
    	$data->tgl = $datepicker;
    	$data->total = $total;
    	$data->save();

    	return $data->id;
    }
    public function ubah1($id_penjualan, $id_detailjual, $namaes, $jumlah, $subtotal)
    {
    	$ides = IceCream::where('nama', '=', $namaes)->first()->id;
    	$datadetail = DetailPenjualan::find($id_detailpenjualan);
    	$datadetail->id_penjualan = $id_penjualan;
    	$datadetail->id = $id_detailjual;
    	$datadetail->id_es = $ides;
    	$datadetail->jumlah = $jumlah;
    	$datadetail->subtotal = $subtotal;
    	$datadetail->save();
    }

    public function showEdit($id)
    {
    	$data = Penjualan::where('id', $id)->first();
    	return view('admin.penjualan_ubah')->with('data', $data);
    }

    public function show($id)
    {
    	$data = Penjualan::where('id', $id)->first();
    	return view('admin.penjualan_detail')->with('data', $data);
    }

    public function hapusDetailPenjualan($id)
    {
    	$data = DetailPenjualan::where('id_penjualan', '=', $id)->delete();
    	return "berhasil";
    }

    public function destroy(Request $request, $id)
    {
    	$data = Penjualan::where('id', $id)->delete();

    	$notification = array(
    		'message' => 'Data berhasil dihapus',
    		'alert-type' => 'error'
    	);
    	return redirect()->back()->with($notification);
    }
}
