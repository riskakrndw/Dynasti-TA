<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Produksi;
use App\IceCream;
use App\User;
use App\Bahan;

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

    public function store($ides, $pengguna, $kode, $datepicker, $jumlah)
    {

        // foreach ($ides as $key) {
        //     $detailbahan = DetailBahan::where('id_es', $key);
        //     dd($detailbahan);
        //     foreach ($detailbahan->id_bahan as $value) {
        //         $a = $detailbahan->takaran * $jumlah;
        //         $databahan = Bahan::where('id_bahan', $value);
        //         $databahan->stok = $databahan->stok - $a;
        //         $data->save();

        //     }
        // }
        $data = new Produksi;
        $data->id_es = $ides;
        $data->id_users = $pengguna;
        $data->kode_produksi = $kode;
        $data->tgl = $datepicker;
        $data->jumlah = $jumlah;
        $data->save();


    }

    public function edit($id)
    {
        $data = Produksi::find($id);
    }

    public function ubah($id_produksi, $ides, $pengguna, $kode, $datepicker, $jumlah)
    {
        $data = Produksi::find($id_produksi);
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
            // $databahan = Bahan::where('id', $id)->first();
            return view('admin.produksi_ubah')->with('data', $data);
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
