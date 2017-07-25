<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;
use App\Bahan;
use App\Pembelian;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Bahan::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        
        $detail = DetailPembelian::where('id_bahan', $id)->get();
        foreach ($detail as $value) {
            $pembelian = Pembelian::find($value->id_pembelian);
            $pembelian->total = $pembelian->total - $value->subtotal;
            $pembelian->save();
        }

        DetailPembelian::where('id_bahan', $id)->delete();
        $data = Bahan::where('id', $id)->delete();

        $notification = array(
            'message' => 'Data berhasil dihapus',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);

    }
}
