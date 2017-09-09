<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Penjualan;
use App\DetailPenjualan;
use App\IceCream;
use App\User;

class PenjualanController extends Controller
{

    public function index()
    {
        if(Auth::user()->level == "manager"){
            $data = Penjualan::all();
            return view('admin.penjualan')->with('data', $data);
        } elseif (Auth::user()->level == "keuangan"){
            $data = Penjualan::all();
            return view('keuangan.penjualan')->with('data', $data);
        }
    }

    public function tambah()
    {
        if(Auth::user()->level == "manager"){
            $dataIceCream = DetailPenjualan::get();
            return view('admin.penjualan_tambah');
        } elseif (Auth::user()->level == "keuangan"){
            $dataIceCream = DetailPenjualan::get();
            return view('keuangan.penjualan_tambah');
        } 
    	
    }

    public function store($pengguna, $datepicker, $total)
    {
        $data = new Penjualan;
        $data->kode_penjualan = 'JL/' . $datepicker . '/';
        $data->id_users = $pengguna;
        $data->tgl = $datepicker;
        $data->total = $total;
        $data->save();
        
        $data->kode_penjualan = $data->kode_penjualan . $data->id;
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

    public function ubah($id_jual, $pengguna, $datepicker, $total)
    {
    	$data = Penjualan::find($id_jual);
        $data->kode_penjualan = 'JL/' . $datepicker . '/' . $data->id;
        $data->id_users = $pengguna;
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
        if(Auth::user()->level == "manager"){
            $data = Penjualan::where('id', $id)->first();
            return view('admin.penjualan_ubah')->with('data', $data);
        } elseif (Auth::user()->level == "keuangan"){
            $data = Penjualan::where('id', $id)->first();
            return view('keuangan.penjualan_ubah')->with('data', $data);
        }
    	
    }

    public function hapusDetailPenjualan($id)
    {
        $data = DetailPenjualan::where('id_penjualan', '=', $id)->delete();
        return "berhasil";
    }
    
    public function show($id)
    {
        if(Auth::user()->level == "manager"){
            $data = Penjualan::where('id', $id)->first();
            return view('admin.penjualan_detail')->with('data', $data);
        } elseif (Auth::user()->level == "keuangan"){
            $data = Penjualan::where('id', $id)->first();
            return view('keuangan.penjualan_detail')->with('data', $data);
        } 
	
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
