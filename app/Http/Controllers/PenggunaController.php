<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Validator;

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
        $this->validate($request, [
            'nameUbah' => 'required|string|max:255',
            'levelUbah' => 'required',
            'usernameUbah' => 'required|string|max:255',
        ],
        [
        'nameUbah.required' => 'Nama harus diisi',
        'levelUbah.required' => 'Level harus diisi',
        'usernameUbah.required' => 'Username harus diisi',
        ]
        );

        $data = User::find($request->id);
        $data->name = $request->nameUbah;
        if($data->level != "manager"){
            $data->level = $request->levelUbah;    
        }
        
        // dd($request->username);
        $data->username = $request->usernameUbah;
        $data->save();

        $notification = array(
            'message' => 'Data berhasil diubah',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    public function updateSandi(Request $request)
    {
        // $cek = Validator::make($request->all(),[
        //     'passwordedit' => 'required'
        // ]);

        // if($cek->fails()){
        //     return back()->withErrors($cek, 'tambah')->withInput();
        // }


        $this->validate($request,[                      // --> validasi input
            'passwordUbah' => 'required|min:6|confirmed',
            'password_confirmationUbah' => 'confirmed',
            
        ]);

        $User = User::find($request->id);

        
        $User->password = $request->passwordUbah;
        $User->save();

        $notification = array(
            'message' => 'Kata Sandi Berhasil Diubah',
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
