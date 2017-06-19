<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jenis;

class JenisController extends Controller
{

    public function __construct(){
        $this->middleware('levelManager');
    }
    
    public function index()
    {
        $data = Jenis::all();
        return view('admin.jenis', ['data'=>$data]);
    }

    public function create()
    {
        return view('admin.jenis');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|min:2|max:50',
        ]);

        $data = new Jenis;
        $data->nama = $request->nama;
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
            'nama' => 'required|min:2|max:50',
        ]);
        
        $data = Jenis::find($request->id);
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
        $data = Jenis::where('id', $id)->delete();

        $notification = array(
            'message' => 'Data berhasil dihapus',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
