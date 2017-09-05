<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input as input;
use Auth;
use Hash;

use Illuminate\Http\Request;
use App\User;

class ProfilController extends Controller
{
    public function index()
    {
        $data = User::all();
        // if(auth()->user()->level == "manager"){
        //     return '/manager/profil';
        // }elseif (auth()->user()->level == "produksi") {
        //     return '/produksi/profil';
        // }elseif (auth()->user()->level == "pengadaan") {
        //     return '/pengadaan/profil';
        // }elseif (auth()->user()->level == "keuangan") {
        //     return '/produksi/keuangan';
        // }
        /*$dd($data);*/
        return view('admin.profile')->with('data', $data);
    }

    public function updateData(Request $request)
    {
    	$data = User::find($request->id);
    	$data->name = $request->name;
    	$data->username = $request->username;
    	$data->save();

    	$notification = array(
            'message' => 'Data berhasil diubah',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    public function setup()
    {
        
    }

    public function updateSandi(Request $request)
    {
        
        $User = User::find(Auth::user()->id);

        if(Hash::check(Input::get('passwordold'), $User['password']) && Input::get('password') == Input::get('password_confirmation')){
            $User->password = bcrypt(Input::get('password'));
            $User->save();

            $notification = array(
                'message' => 'Data berhasil diubah',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Data tidak berhasil diubah',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        
    }
}
