<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PenggunaController extends Controller
{

    public function __construct(){
        $this->middleware('levelManager');
    }

    public function index()
    {
        $data = User::all();
        return view('admin.pengguna', ['data'=>$data]);
    }

    public function store(Request $request)
    {

    	$this->validate($request, [
            'name' => 'required|string|max:255',
            'level' => 'required',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
            'password_confirmation' => 'required',
        ],
        [
        'name.required' => 'Nama harus diisi',
        'level.required' => 'Level harus dipilih',
        'username.required' => 'Username harus diisi',
        'password.required' => 'Kata Sandi harus diisi',
        'password_confirmation.required' => 'Konfirmasi Kata Sandi harus diisi',
        'password.confirmed' => 'Kata Sandi tidak sama',
        ]
        );

        $data = new User;
        $data->name = $request->name;
        $data->level = $request->level;
        $data->username = $request->username;
        $data->password = $request->password;
        $data->save();

        $notification = array(
            'message' => 'Data berhasil ditambah',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function updateData(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required|string|max:255',
        //     'level' => 'required',
        //     'username' => 'required|string|username|max:255|unique:users',
        // ]);

        $data = User::find($request->id);
        $data->name = $request->name;
        if($data->level != "manager"){
            $data->level = $request->level;    
        }
        
        // dd($request->username);
        $data->username = $request->username;
        $data->save();

        $notification = array(
            'message' => 'Data berhasil diubah',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    public function updateSandi(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
        ]);

        // return $request->all();
        $data = User::find($request->id);
        // dd($request->id);
        
        if(!empty($request->password)){
            $data->password = bcrypt($request->password);
            // dd($request->password);
            $data->save();
        }

        $notification = array(
            'message' => 'Data berhasil diubah',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }


    public function destroy(Request $request, $id)
    {
        $data = User::where('id', $id)->delete();

        $notification = array(
            'message' => 'Data berhasil dihapus',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
