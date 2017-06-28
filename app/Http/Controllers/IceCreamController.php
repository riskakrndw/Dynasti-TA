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

    public function __construct(){
        $this->middleware('levelManager');
    }

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

    public function store(Request $request)
    {
        /*$this->validate($request, [
            'nama' => 'required|min:2|max:50',
            'harga' => 'required|min:2|max:50',
            'stok' => 'required|min:2|max:50',
            'total' => 'required',
            'jumlahProduksi' => 'required|max:10',
        ]);*/
        $rasa=Rasa::find($request->listRasa_);
        $jenis=Jenis::find($request->listJenis_);
        $nama='Ice Cream '.$jenis->nama.' '.$rasa->nama;
       
        $data = new IceCream;
        $data->nama = $nama;
        $data->harga = $request->harga_;
        $data->stok = $request->stok_;
        $data->id_jenis = $request->listJenis_;
        $data->id_rasa = $request->listRasa_;
        $data->save();

        return $data->id;

    }

    public function store1(Request $request)
    {
        /*$this->validate($request, [
            'nama' => 'required|min:2|max:50',
            'harga' => 'required|min:2|max:50',
            'stok' => 'required|min:2|max:50',
            'total' => 'required',
            'jumlahProduksi' => 'required|max:10',
        ]);*/   
        $ides= IceCream::max('id');

        $idbahan = Bahan::where('nama', '=', $request->nama_bahan)->first();
        $datadetail = new DetailBahan;
        $datadetail->id_es = $ides;
        $datadetail->id_bahan = $idbahan['id'];
        $datadetail->takaran = $request->jumlah_;
        $datadetail->satuan = $request->satuan_;
        $datadetail->save();

    }

    public function edit($id)
    {
        $data = IceCream::find($id);
    }

    public function ubah(Request $request)
    {
        /*$this->validate($request, [
            'nama' => 'required|min:2|max:50',
            'harga' => 'required|min:2|max:50',
            'stok' => 'required|min:2|max:50',
            'total' => 'required',
            'jumlahProduksi' => 'required|max:10',
        ]);*/
        $rasa=Rasa::find($request->listRasa_);
        $jenis=Jenis::find($request->listJenis_);
        $nama='Ice Cream '.$jenis->nama.' '.$rasa->nama;
        
        $ides= IceCream::max('id');

        $data = IceCream::find($ides);
        $data->nama = $nama;
        $data->harga = $request->harga_;
        $data->stok = $request->stok_;
        $data->id_jenis = $request->listJenis_;
        $data->id_rasa = $request->listRasa_;
        $data->save();

        return $data->id;

    }

    public function ubah1(Request $request)
    {
        /*$this->validate($request, [
            'nama' => 'required|min:2|max:50',
            'harga' => 'required|min:2|max:50',
            'stok' => 'required|min:2|max:50',
            'total' => 'required',
            'jumlahProduksi' => 'required|max:10',
        ]);*/   
        
        $ides = $request->ides;

        $idbahan = Bahan::where('nama', '=', $request->nama_bahan)->first();
        $datadetail = new DetailBahan;
        $datadetail->id_es = $ides;
        $datadetail->id_bahan = $idbahan['id'];
        $datadetail->takaran = $request->jumlah_;
        $datadetail->satuan = $request->satuan_;
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

    public function hapusDetailBahan(Request $request)
    {
        $data = DetailBahan::where('id_es', '=', $request->ides);
        $data->delete();
        
        return $request->ides;
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
