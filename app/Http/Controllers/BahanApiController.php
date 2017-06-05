<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bahan;

class BahanApiController extends Controller
{
    public function index(Request $request)
    {
    	$search_term = $request->input('q');
    	$page = $request->input('page');

    	if($search_term){
    		$results = Bahan::where('nama', 'LIKE', '%'.$search_term.'%')->paginate(10);
    	}else{
    		$results = Bahan::paginate(10);
    	}

    	return $results;
    }

    public function reqNamaBahan($id)
    {
        $data = Bahan::find($id)->nama;

        return $data;
    }

    public function show($id)
    {
        return Bahan::find($id);
    }
}
