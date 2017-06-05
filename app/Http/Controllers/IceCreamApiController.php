<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IceCream;

class IceCreamApiController extends Controller
{
    public function index(Request $request)
    {
    	$search_term = $request->input('q');
    	$page = $request->input('page');

    	if($search_term){
    		$results = IceCream::where('nama', 'LIKE', '%'.$search_term.'%')->paginate(10);
    	}else{
    		$results = IceCream::paginate(10);
    	}

    	return $results;
    }

    public function reqNamaIceCream($id)
    {
        $data = IceCream::find($id)->nama;

        return $data;
    }

    public function show($id)
    {
        /*return IceCream::find($id);*/
        $data = IceCream::find($id);
        $hasil = array();
        $hasil[] = $data->id;
        $hasil[] = $data->stok;
        $hasil[] = $data->nama;
        $hasil[] = $data->harga;
        $hasil[] = $data->jenis->nama;
        $hasil[] = $data->rasa->nama;
        return $hasil;
    }
}
