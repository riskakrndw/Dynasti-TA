<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Produksi;
use App\IceCream;
use App\User;
use App\Bahan;
use App\DetailBahan;
use App\DetailProduksi;

class ProduksiController extends Controller
{

    public function index()
    {
    	$data = DetailProduksi::all();
        // dd($data);
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

    public function store($pengguna, $kode, $datepicker)
    {

        // dd($idbahan);
        $data = new Produksi;
        $data->id_users = $pengguna;
        $data->kode_produksi = $kode;
        $data->tgl = $datepicker;
        $data->save();

        return $data->id;
    }

    public function store1($ides, $idproduksi, $jumlahproduksi)
    {
        $dataes = IceCream::find($ides);
        $dataes->stok = $dataes->stok + $jumlahproduksi;
        $dataes->save();   

        $detailProduksi = new DetailProduksi;
        $detailProduksi->id_es = $ides;
        $detailProduksi->id_produksi = $idproduksi;
        $detailProduksi->jumlah = $jumlahproduksi;
        $detailProduksi->save();
    }

    public function store2($jumlah, $idbahan)
    {
        $i = 0; 
        $arr = explode(',', $idbahan); //mecah jadi array
        $arrjumlah = explode(',', $jumlah);
        foreach ($arr as $bahan) {
            $databahan = Bahan::find($bahan);
            // dd($bahan);
            $databahan->stok = $databahan->stok - $arrjumlah[$i];
            $databahan->save();

            $i++;
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
