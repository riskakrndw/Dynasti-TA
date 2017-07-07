<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
