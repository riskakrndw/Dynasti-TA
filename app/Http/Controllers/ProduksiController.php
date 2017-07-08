<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Produksi;
use App\IceCream;
use App\User;

class ProduksiController extends Controller
{

    public function index()
    {
    	$data = Produksi::all();
    	return view('admin.produksi')->with('data', $data);
    }

    public function tambah()
    {
        if(Auth::user()->level == "manager"){
            $dataIceCream = Produksi::get();
            return view('admin.produksi_tambah');
        } elseif (Auth::user()->level == "keuangan"){
           
        } 
    	
    }
}
