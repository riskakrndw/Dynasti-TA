<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rasa;
use Illuminate\Support\Facades\DB;

class RasaApiController extends Controller
{
    public function index(Request $request)
    {
    	$search_term = $request->input('q');
    	$page = $request->input('page');

    	if($search_term){
    		$results = Rasa::where('nama', 'LIKE', '%'.$search_term.'%')->paginate(10);
    	}else{
    		$results = Rasa::paginate(10);
    	}

    	return $results;
    }

    public function reqNamaRasa($id)
    {
        $data = Rasa::find($id)->nama;

        return $data;
    }

    public function show($id)
    {
        /*return Rasa::find($id);*/
        $data = Rasa::find($id);
        $hasil = array();
        $hasil[] = $data->id;
        $hasil[] = $data->nama;
        return $hasil;
    }

    public function showDetail($id)
    {
        $data = DB::table('detail_rasa')
                ->join('bahan_baku', 'detail_rasa.id_bahan', '=', 'bahan_baku.id')
                ->where('id_rasa', $id)
                ->get();
        return $data;
    }

    public function showJenis($id)
    {
        $data = Rasa::find($id);

        $hasil = array();
        foreach ($data->ice_cream as $key=>$value) {
            $hasil[$key][0]=$value->id;
            $hasil[$key][1]=$value->jenis->nama;
            $hasil[$key][2]=$value->jumlah_produksi;
        }

        return $hasil;
    }
}
