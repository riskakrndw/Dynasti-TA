<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Produksi;
use App\IceCream;
use App\User;
use App\Bahan;
use App\DetailBahan;
use App\DetailRasa;
use App\DetailProduksi;

class ProduksiController extends Controller
{

    public function index()
    {
    	$data = Produksi::all();
        // dd($data);
        // dd($data[0]->detail_produksi);
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

    public function show($id)
    {
        if(Auth::user()->level == "manager"){
            $data = Produksi::where('id', $id)->first();
            return view('admin.produksi_detail')->with('data', $data);
        }
        
    }

    public function showEdit($id)
    {
        if(Auth::user()->level == "manager"){
            $data = Produksi::where('id', $id)->first();
            $datadetail = DetailRasa::where('id_rasa', '=', $data->detail_produksi[0]->ice_cream->id_rasa)->get();
            // dd($data->detail_produksi[0]->ice_cream->rasa->detail_rasa);
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
