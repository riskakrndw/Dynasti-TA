<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DetailProduksi;
use App\Produksi;
use App\IceCream;

class ProduksiController extends Controller
{
    
    public function index()
    {
    	$data = Produksi::all();
    	return view('admin.produksi')->with('data', $data);
    }
}
