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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $data = new User;
        $data->name = $request->name;
        $data->level = $request->level;
        $data->email = $request->email;
        $data->password = $request->password;
        $data->save();

        $notification = array(
            'message' => 'Data berhasil ditambah',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
