<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input as input;
use Auth;
use Hash;

use Illuminate\Http\Request;
use App\User;

class ProfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
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

    public function updateSandi(Request $request)
    {
        $this->validate($request,[                      // --> validasi input
            'passwordold' => 'required|min:6',
            'password' => 'required|min:6|confirmed',
        ]);

        $User = User::find(Auth::user()->id);

        if(Hash::check($request->passwordold, $User->password)){
            $User->password = $request->password;
            $User->save();

            $notification = array(
                'message' => 'Kata Sandi Berhasil Diubah',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Kata Sandi Gagal Diubah',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        
    }

    // public function editPassword(Request $request){         // --> fungsi ubah password
    //     $this->validate($request,[                      // --> validasi input
    //         'id'=> 'required',
    //         'oldPassword' => 'required|min:6',
    //         'password' => 'required|min:6|confirmed',
    //         ]);

    //     $user = User::find($request->id);           // --> cari baris user berdasarkan auth id

    //     if (Hash::check($request->oldPassword, $user->password)){    // pengecekan apakah pass lama == database 
            
    //         $user->password=bcrypt($request->password);         // jika iya simpan pass baru
    //         $user->save();

    //         Toastr::success('Password telah diperbarui!','Password');

    //         return back();
    //     } else {
    //         Toastr::error('Password lama tidak cocok!','Password');     // pass lama tidak cocok dengan oldPassword

    //         return back();
    //     }       
    // }
}
