<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Produksi;
use App\IceCream;
use App\User;
use App\Bahan;
use App\DetailBahan;

class ProduksiController extends Controller
{

    public function index()
    {
    	$data = Produksi::all();
    	return view('admin.produksi')->with('data', $data);
    }

    public function tambah()
    {
        if(Auth::user()->level == "manager"){
            $dataIceCream = Produksi::get();
            return view('admin.produksi_tambah');
        } elseif (Auth::user()->level == "keuangan"){
           
        } 
    	
    }

    public function store($ides, $pengguna, $kode, $datepicker, $jumlah, $idbahan)
    {

        // dd($idbahan);
        $data = new Produksi;
        $data->id_es = $ides;
        $data->id_users = $pengguna;
        $data->kode_produksi = $kode;
        $data->tgl = $datepicker;
        $data->jumlah = $jumlah;
        $data->save();

        $dataes = IceCream::find($ides);
        $dataes->stok = $dataes->stok + $jumlah;
        $dataes->save();   

        $arr = explode(',', $idbahan); //mecah jadi array
        foreach ($arr as $bahan) {
            $databahan = Bahan::find($bahan);
            // dd($bahan);
            $datadetail = DetailBahan::where('id_es', '=', $ides)->where('id_bahan', '=', $bahan)->first()->takaran;
            $databahan->stok = $databahan->stok - $datadetail*$jumlah;
            $databahan->save();
        }
    }

    public function edit($id)
    {
        $data = Produksi::find($id);
    }

    public function ubah($id_produksi, $ides, $pengguna, $kode, $datepicker, $jumlah, $idbahan)
    {
        $data = Produksi::find($id_produksi);
        

        $dataes = IceCream::find($ides);
        $dataes->stok = $dataes->stok - $data->jumlah + $jumlah;
        $dataes->save();   

        $arr = explode(',', $idbahan); //mecah jadi array
        foreach ($arr as $bahan) {
            $databahan = Bahan::find($bahan);
            // dd($bahan);
            $datadetail = DetailBahan::where('id_es', '=', $ides)->where('id_bahan', '=', $bahan)->first()->takaran;
            $databahan->stok = $databahan->stok + $data->jumlah * $datadetail - $datadetail * $jumlah;
            $databahan->save();
        }

        $data->id_es = $ides;
        $data->id_users = $pengguna;
        $data->kode_produksi = $kode;
        $data->tgl = $datepicker;
        $data->jumlah = $jumlah;
        $data->save();

    }

    public function showEdit($id)
    {
        if(Auth::user()->level == "manager"){
            $data = Produksi::where('id', $id)->first();
            $datadetail = DetailBahan::where('id_es', '=', $data->id_es)->select('id_bahan')->get();
            // dd($datadetail);
            return view('admin.produksi_ubah')->with('data', $data)->with('datadetail', $datadetail);
        } elseif (Auth::user()->level == "produksi"){
            
        }
    }

    public function destroy(Request $request, $id)
    {
        $data = Produksi::where('id', $id)->delete();

        $notification = array(
            'message' => 'Data berhasil dihapus',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }
}
