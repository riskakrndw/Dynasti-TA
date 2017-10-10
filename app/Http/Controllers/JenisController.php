<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jenis;

class JenisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = Jenis::orderBy('nama', 'asc')->get();
        return view('admin.jenis', ['data'=>$data]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|min:2|max:50',
            'harga' => 'required|min:2|max:10',
        ],
        [
        'nama.required' => 'Nama harus diisi',
        'harga.required' => 'Harga harus diisi',
        ]
        );

        $data = new Jenis;
        $data->nama = $request->nama;
        $data->harga = $request->harga;
        $data->save();

        $notification = array(
            'message' => 'Data berhasil ditambah',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $data = Jenis::find($id);
    }

    public function update(Request $request)
    {

        $this->validate($request, [
            'namaUbah' => 'required|min:2|max:50',
            'hargaUbah' => 'required|min:2|max:10',
        ],
        [
        'namaUbah.required' => 'Nama harus diisi',
        'hargaUbah.required' => 'Harga harus diisi',
        ]
        );
        
        $data = Jenis::find($request->id);
        $data->nama = $request->namaUbah;
        $data->harga = $request->hargaUbah;
        $data->save();

        $notification = array(
            'message' => 'Data berhasil diubah',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    public function destroy(Request $request, $id)
    {
        $data = Jenis::where('id', $id)->delete();

        $notification = array(
            'message' => 'Data berhasil dihapus',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
