<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IceCream;
use App\Jenis;
use App\Rasa;
use App\DetailBahan;
use App\Bahan;

class IceCreamController extends Controller
{

    public function index()
    {
        $data = IceCream::all();
        $dataJenis = Jenis::get();
        $dataRasa = Rasa::get();
        $dataBahan = DetailBahan::get();
        /*dd($data);*/
        return view('admin.ice_cream')->with('data', $data)->with('dataJenis', $dataJenis)->with('dataRasa', $dataRasa);
    }


    public function tambah()
    {
        $dataJenis = Jenis::get();
        $dataRasa = Rasa::get();
        $dataBahan = DetailBahan::get();
        return view('admin.ice_cream_tambah')->with('dataJenis', $dataJenis)->with('dataRasa', $dataRasa);
    }

    public function store($nama, $harga, $stok, $jumlah_produksi, $listJenis, $listRasa)
    {
        /*$this->validate($request, [
            'nama' => 'required|min:2|max:50',
            'harga' => 'required|min:2|max:50',
            'stok' => 'required|min:2|max:50',
            'total' => 'required',
            'jumlahProduksi' => 'required|max:10',
        ]);*/

        $data = new IceCream;
        $data->nama = $nama;
        $data->harga = $harga;
        $data->stok = $stok;
        $data->jumlah_produksi = $jumlah_produksi;
        $data->id_jenis = $listJenis;
        $data->id_rasa = $listRasa;
        $data->save();

        return $data->id;

    }

    public function store1($id_es, $namabahan, $takaran)
    {
        /*$this->validate($request, [
            'nama' => 'required|min:2|max:50',
            'harga' => 'required|min:2|max:50',
            'stok' => 'required|min:2|max:50',
            'total' => 'required',
            'jumlahProduksi' => 'required|max:10',
        ]);*/   
        
        $idbahan = Bahan::where('nama', '=', $namabahan)->first()->id;
        $datadetail = new DetailBahan;
        $datadetail->id_es = $id_es;
        $datadetail->id_bahan = $idbahan;
        $datadetail->takaran = $takaran;
        $datadetail->save();

    }

    public function edit($id)
    {
        $data = IceCream::find($id);
    }

    public function ubah($id_eskrim, $nama, $harga, $stok, $jumlah_produksi, $listJenis, $listRasa)
    {
        /*$this->validate($request, [
            'nama' => 'required|min:2|max:50',
            'harga' => 'required|min:2|max:50',
            'stok' => 'required|min:2|max:50',
            'total' => 'required',
            'jumlahProduksi' => 'required|max:10',
        ]);*/

        $data = IceCream::find($id_eskrim);
        $data->nama = $nama;
        $data->harga = $harga;
        $data->stok = $stok;
        $data->jumlah_produksi = $jumlah_produksi;
        $data->id_jenis = $listJenis;
        $data->id_rasa = $listRasa;
        $data->save();

        return $data->id;

    }

    public function ubah1($id_es, $id_detailbahan, $namabahan, $takaran)
    {
        /*$this->validate($request, [
            'nama' => 'required|min:2|max:50',
            'harga' => 'required|min:2|max:50',
            'stok' => 'required|min:2|max:50',
            'total' => 'required',
            'jumlahProduksi' => 'required|max:10',
        ]);*/   
        
        $idbahan = Bahan::where('nama', '=', $namabahan)->first()->id;
        $datadetail = DetailBahan::find($id_detailbahan);
        $datadetail->id_es = $id_es;
        $datadetail->id = $id_detailbahan;
        $datadetail->id_bahan = $idbahan;
        $datadetail->takaran = $takaran;
        $datadetail->save();

    }

    public function showEdit($id)
    {
        $dataJenis = Jenis::get();
        $dataRasa = Rasa::get();
        $data = IceCream::where('id', $id)->first();
        return view('admin.ice_cream_ubah')->with('data', $data)->with(compact('dataJenis', $dataJenis, 'dataRasa', $dataRasa));
    }

    public function show($id)
    {
        $dataJenis = Jenis::get();
        $dataRasa = Rasa::get();
        $data = IceCream::where('id', $id)->first();
        return view('admin.ice_cream_detail')->with('data', $data)->with(compact('dataJenis', $dataJenis, 'dataRasa', $dataRasa));
    }

    public function hapusDetailBahan($id)
    {
        $data = DetailBahan::where('id_es', '=', $id)->delete();
        return "berhasil";
    }


    public function destroy(Request $request, $id)
    {
        $data = IceCream::where('id', $id)->delete();

        $notification = array(
            'message' => 'Data berhasil dihapus',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
