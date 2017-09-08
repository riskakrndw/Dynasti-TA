<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;
use App\Bahan;
use App\Pembelian;
use App\Jenis;
use App\DetailPembelian;

class BahanController extends Controller
{

    // public function __construct(){
    //     $this->middleware('levelManager');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Bahan::all();
        if(Auth::user()->level == "manager"){
            return view('admin.bahan', ['data'=>$data]);
        } elseif (Auth::user()->level == "pengadaan"){
            return view('pengadaan.bahan', ['data'=>$data]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bahan');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|min:2|max:50',
            'harga' => 'required|max:10',
            'stok' => 'required|max:20',
            'satuan' => 'required|max:30',

        ]);

        $data = new Bahan;
        $data->nama = $request->nama;
        $data->harga = $request->harga;
        $data->stok = $request->stok;
        $data->satuan = $request->satuan;
        $data->stok_min = $request->stok_min;
        $data->save();

        $notification = array(
            'message' => 'Data berhasil ditambah',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $data = Bahan::find($id);
    }

    public function update(Request $request)
    {
        $data = Bahan::find($request->id);
        $data->nama = $request->nama;
        $data->harga = $request->harga;
        $data->stok = $request->stok;
        $data->satuan = $request->satuan;
        $data->stok_min = $request->stok_min;
        $data->save();

        $notification = array(
            'message' => 'Data berhasil diubah',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    public function destroy(Request $request, $id)
    {
        
        $data = Bahan::where('id', $id)->delete();

        $notification = array(
            'message' => 'Data berhasil dihapus',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);

    }

    public function hapus(Request $request, $id)
    {
        $data = Bahan::where('id', $id)->delete();

        $notification = array(
            'message' => 'Data berhasil dihapus',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);

    }
}
