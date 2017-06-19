<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class PenggunaController extends Controller
{
    use RegistersUsers;

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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3',
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

    public function edit($id)
    {
        $data = User::find($id);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'level' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $data = User::find($request->id);
        $data->name = $request->name;
        $data->level = $request->level;
        $data->email = $request->email;
        $data->password = $request->password;
        $data->save();

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
