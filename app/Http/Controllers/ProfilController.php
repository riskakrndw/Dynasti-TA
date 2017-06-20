<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfilController extends Controller
{
    public function index()
    {
        $data = User::all();
        /*$dd($data);*/
        return view('admin.profile')->with('data', $data);
    }
}
