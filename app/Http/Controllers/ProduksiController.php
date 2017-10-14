<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Produksi;
use App\IceCream;
use App\User;
use App\Bahan;
use App\DetailBahan;
use App\DetailRasa;
use App\DetailProduksi;

class ProduksiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        if(Auth::user()->level == "manager"){
            $data = Produksi::orderBy('updated_at', 'desc')->get();
            // dd($data->ice_cream);
            return view('admin.produksi')->with('data', $data);
        } elseif (Auth::user()->level == "produksi"){
            $data = Produksi::orderBy('updated_at', 'desc')->get();
            return view('produksi.produksi')->with('data', $data);
        }
    	
    }

    public function index1()
    {
       
        if(Auth::user()->level == "manager"){
            $data = DetailProduksi::orderBy('updated_at', 'desc')->get();
            // dd($data);
            return view('admin.produksi_barang')->with('data', $data);
        } elseif (Auth::user()->level == "produksi"){
            $data = DetailProduksi::orderBy('updated_at', 'desc')->get();
            // dd($data);
            return view('produksi.produksi_barang')->with('data', $data);
        }
    }

    public function tambah()
    {
        if(Auth::user()->level == "manager"){
            $dataIceCream = Produksi::get();
            return view('admin.produksi_tambah');
        } elseif (Auth::user()->level == "produksi"){
            $dataIceCream = Produksi::get();
            return view('produksi.produksi_tambah');
        } 
    	
    }

    public function store($pengguna)
    {

        // dd($idbahan);
        $data = new Produksi;
        $datepicker = Carbon::now()->format('Y-m-d');
        $data->id_users = $pengguna;
        $data->kode_produksi = 'PRO/' . $datepicker . '/';
        $data->tgl = $datepicker;
        $data->save();
        
        $data->kode_produksi = $data->kode_produksi . $data->id;
        $data->save();

        return $data->id;
    }

    public function store1($ides, $idproduksi, $jumlahproduksi)
    {
        $dataes = IceCream::find($ides);
        $dataes->stok = $dataes->stok + $jumlahproduksi;
        $dataes->save();   

        if($jumlahproduksi > 0){
            $detailProduksi = new DetailProduksi;
            $detailProduksi->id_es = $ides;
            $detailProduksi->id_produksi = $idproduksi;
            $detailProduksi->jumlah = $jumlahproduksi;
            $detailProduksi->save();
        }
        
    }

    public function store2($jumlah, $idbahan)
    {
        $i = 0; 
        $arr = explode(',', $idbahan); //mecah jadi array
        $arrjumlah = explode(',', $jumlah);
        foreach ($arr as $bahan) {
            $databahan = Bahan::find($bahan);
            // dd($bahan);
            $databahan->stok = $databahan->stok - $arrjumlah[$i];
            $databahan->save();

            $i++;
        }
    }

    public function show($id, $tipe)
    {
        if(Auth::user()->level == "manager"){
            $data = Produksi::where('id', $id)->first();
            return view('admin.produksi_detail')->with('data', $data)->with('tipe', $tipe);
        }   elseif (Auth::user()->level == "produksi"){
            $data = Produksi::where('id', $id)->first();
            return view('produksi.produksi_detail')->with('data', $data)->with('tipe', $tipe);
        }
        
    }

    public function showEdit($id)
    {
        if(Auth::user()->level == "manager"){
            $data = Produksi::where('id', $id)->first();
            $datadetail = DetailRasa::where('id_rasa', '=', $data->detail_produksi[0]->ice_cream->id_rasa)->get();
            // dd($data->detail_produksi[0]->ice_cream->rasa->detail_rasa);
            return view('admin.produksi_ubah')->with('data', $data)->with('datadetail', $datadetail);
        } elseif (Auth::user()->level == "produksi"){
            $data = Produksi::where('id', $id)->first();
            $datadetail = DetailRasa::where('id_rasa', '=', $data->detail_produksi[0]->ice_cream->id_rasa)->get();
            // dd($data->detail_produksi[0]->ice_cream->rasa->detail_rasa);
            return view('produksi.produksi_ubah')->with('data', $data)->with('datadetail', $datadetail);
        }
    }

    public function edit(Request $request)
    {
        // return $request->jumlahes;
        $data = Produksi::find($request->id);
        $data->tgl = $request->datepicker;
        $data->kode_produksi = 'PRO/' . $request->datepicker . '/' . $request->id;
        $data->id_users = auth()->user()->id;
        $data->save();

        if($data->detail_produksi[0]->ice_cream->id_rasa == $request->id_rasa){
            $jumlahes = explode(",", $request->jumlahes);
            $id_es = explode(",", $request->id_es);

            $detail_produksi = DetailProduksi::where('id_produksi', $request->id)->get();
            foreach ($detail_produksi as $key => $value) {
                $dataes = IceCream::find($value->id_es);
                $dataes->stok = $dataes->stok - $value->jumlah;
                $dataes->save();
            }

            foreach ($jumlahes as $key=>$value) {
                $datadetail = DetailProduksi::where("id_produksi", $request->id)->where('id_es', $id_es[$key])->first();
                if($datadetail != NULL){
                
                    $dataes = IceCream::find($request->id_es[$key]);
                    $dataes->stok = $dataes->stok + $value;
                    $dataes->save();
                    if($value == 0){
                        DetailProduksi::where("id_produksi", $request->id)->where('id_es', $id_es[$key])->delete();
                    }else{
                        $datadetail->jumlah = $value;
                        $datadetail->save();
                    }
                }else{
                    if($value > 0){
                        $datadetail = new DetailProduksi;
                        $datadetail->id_produksi = $request->id;
                        $datadetail->id_es = $id_es[$key];
                        $datadetail->jumlah = $value;
                        $datadetail->save();

                        $dataes = IceCream::find($id_es[$key]);
                        $dataes->stok = $dataes->stok + $value;
                        $dataes->save();
                    }
                }
            }

            DetailProduksi::where('id_produksi', $request->id)->whereNotIn('id_es', $id_es)->delete();
        }
    }

    public function edit1(Request $request)
    {
        $idbahanawal = explode(",", $request->idbahanawal);
        $jumlahbahanawal = explode(",", $request->jumlahbahanawal);
        $jumlahbahandipakai = explode(",", $request->jumlahbahandipakai);
        $idbahandipakai = explode(",", $request->idbahandipakai);
        foreach ($idbahanawal as $key => $value) {
            $databahan = Bahan::find($value);
            $databahan->stok = $databahan->stok + $jumlahbahanawal[$key];
            $databahan->save();
        }

        foreach ($idbahandipakai as $key => $value) {
            $databahan = Bahan::find($value);
            $databahan->stok = $databahan->stok - $jumlahbahandipakai[$key];
            $databahan->save();
        }
    }

    public function update(Request $request)
    {

        $this->validate($request, [
            'datepicker' => 'required',
        ],
        [
        'datepicker.required' => 'Tanggal harus diisi',
        ]
        );
        
        $data = Produksi::find($request->id);
        $data->kode_produksi = 'PRO/' . $request->datepicker . '/' . $request->id;
        $data->tgl = $request->datepicker;
        $data->save();

        $notification = array(
            'message' => 'Data berhasil diubah',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    public function destroy(Request $request, $id)
    {
        $data = Produksi::where('id', $id)->delete();

        $notification = array(
            'message' => 'Data berhasil dihapus',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }
}
