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
            'stok' => 'required',
            'stok_min' => 'required',
            'satuan' => 'required|max:30',
        ],
        [
        'nama.required' => 'Nama harus diisi',
        'harga.required' => 'Harga harus diisi',
        'stok.required' => 'Stok harus diisi',
        'stok_min.required' => 'Harga harus diisi',
        'satuan.required' => 'Satuan harus diisi',
        ]
        );

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

        $this->validate($request, [
            'namaUbah' => 'required|min:2|max:50',
            'hargaUbah' => 'required|min:2|max:10',
            'stokUbah' => 'required|min:2|max:50',
            'satuanUbah' => 'required|min:2|max:10',
            'stok_minUbah' => 'required|min:2|max:50',
        ],
        [
        'namaUbah.required' => 'Nama harus diisi',
        'hargaUbah.required' => 'Harga harus diisi',
        'stokUbah.required' => 'Stok harus diisi',
        'satuanUbah.required' => 'Satuan harus diisi',
        'stok_minUbah.required' => 'Stok Minimal harus diisi',
        ]
        );

        $data = Bahan::find($request->id);
        $data->nama = $request->namaUbah;
        $data->harga = $request->hargaUbah;
        $data->stok = $request->stokUbah;
        $data->satuan = $request->satuanUbah;
        $data->stok_min = $request->stok_minUbah;
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
