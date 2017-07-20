<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jenis;
use App\Rasa;
use App\Bahan;
use App\IceCream;
use App\DetailRasa;
use App\DetailEs;

class RasaController extends Controller
{

    public function __construct(){
        $this->middleware('levelManager');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Rasa::all();
        return view('admin.rasa', ['data'=>$data]);
    }

    public function create()
    {
        return view('admin.rasa');
    }

    public function tambah()
    {
        $dataJenis = Jenis::get();
        $dataRasa = Rasa::get();
        return view('admin.rasa_tambah')->with('dataJenis', $dataJenis)->with('dataRasa', $dataRasa);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|min:2|max:50',
        ]);

        $data = new Rasa;
        $data->nama = $request->nama;
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
        $idrasa= Rasa::max('id');

        $idbahan = Bahan::where('nama', '=', $request->nama_bahan)->first();
        $datadetail = new DetailRasa;
        $datadetail->id_rasa = $idrasa;
        $datadetail->id_bahan = $idbahan['id'];
        $datadetail->takaran = $request->takaran_;
        $datadetail->save();
    }

    public function store2(Request $request)
    {
        /*$this->validate($request, [
            'nama' => 'required|min:2|max:50',
            'harga' => 'required|min:2|max:50',
            'stok' => 'required|min:2|max:50',
            'total' => 'required',
            'jumlahProduksi' => 'required|max:10',
        ]);*/   
        $idrasa= Rasa::max('id');

        $rasa=Rasa::find($idrasa);
        $jenis=Jenis::find($request->idjenis);
        $nama='Ice Cream '.$jenis->nama.' '.$rasa->nama;
       
        $data = new IceCream;
        $data->nama = $nama;
        $data->id_jenis = $request->idjenis;
        $data->id_rasa = $idrasa;
        $data->jumlah_produksi = $request->jumlah_produksi;
        $data->save();

        return $data->id;
    }

    public function store3(Request $request)
    {
        /*$this->validate($request, [
            'nama' => 'required|min:2|max:50',
            'harga' => 'required|min:2|max:50',
            'stok' => 'required|min:2|max:50',
            'total' => 'required',
            'jumlahProduksi' => 'required|max:10',
        ]);*/   
        $idrasa= Rasa::max('id');

        $idbahan = Bahan::where('nama', '=', $request->nama_bahan)->first();
        $datadetail = new DetailEs;
        $datadetail->id_es = $request->ides;
        $datadetail->takaran = $request->takaran;
        $datadetail->id_bahan = $idbahan['id'];
        $datadetail->save();
    }

    public function show($id)
    {
        $dataJenis = Jenis::get();
        $data = Rasa::where('id', $id)->first();
        // dd($data);
        return view('admin.rasa_detail')->with(compact('dataJenis', $dataJenis, 'data', $data));
    }

    

    public function edit($id)
    {
        $data = Rasa::find($id);
    }

    public function update(Request $request)
    {
        $data = Rasa::find($request->id);
        $data->nama = $request->nama;
        $data->save();

        $notification = array(
            'message' => 'Data berhasil diubah',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    public function destroy(Request $request, $id)
    {
        $data = Rasa::where('id', $id)->delete();

        $notification = array(
            'message' => 'Data berhasil dihapus',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
