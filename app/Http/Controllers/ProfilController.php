<?php

namespace App\Http\Controllers;

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
        $data = User::find(auth()->user()->id);
        // dd(\Hash::check($request->sandiLama, $user->password));
        if(\Hash::check($request->sandiLama, $data->password)){
            $data->password = \Hash::make($request->sandiBaru);
            $data->save();
        }else{
            $data->session()->flash('error', 'Your password has not been changed.');
        }

        $notification = array(
            'message' => 'Data berhasil diubah',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }
}
