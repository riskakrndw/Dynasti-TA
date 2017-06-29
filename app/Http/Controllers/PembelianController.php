<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pembelian;
use App\DetailPembelian;
use App\Bahan;
use App\User;

class PembelianController extends Controller
{

    public function __construct(){
        $this->middleware('levelManager');
    }

    
    public function index()
    {
        $data = Pembelian::all();
        /*$dd($data);*/
        return view('admin.pembelian')->with('data', $data);
    }

    public function tambah()
    {
        $dataBahan = DetailPembelian::get();
        return view('admin.pembelian_tambah');
    }

    public function store($kode, $pengguna, $datepicker, $total, $status)
    {
        $data = new Pembelian;
        $data->kode_pembelian = $kode;
        $data->id_users = $pengguna;
        $data->tgl = $datepicker;
        $data->total = $total;
        $data->status = "berhasil";
        $data->save();

        return $data->id;
    }

    public function store1($idbeli, $namabahan, $jumlah, $subtotal)
    {
        $idbahan = Bahan::where('nama', '=', $namabahan)->first()->id;
        $datadetail = new DetailPembelian;
        $datadetail->id_pembelian = $idbeli;
        $datadetail->id_bahan = $idbahan;
        $datadetail->jumlah = $jumlah;
        $datadetail->subtotal = $subtotal;
        $datadetail->save();
    }

    public function edit($id)
    {
        $data = Pembelian::find($id);

    }

    public function ubah($id_beli, $kode, $pengguna, $datepicker, $total, $status)
    {
        $data = Pembelian::find($id_beli);
        $data->kode_pembelian = $kode;
        $data->id_users = $pengguna;
        $data->tgl = $datepicker;
        $data->total = $total;
        $data->status = "berhasil";
        $data->save();

        return $data->id;
    }

    public function ubah1($id_pembelian, $id_detailbeli, $namabahan, $jumlah, $subtotal)
    {
        $idbahan = Bahan::where('nama', '=', $namabahan)->first()->id;
        $datadetail = DetailPembelian::find($id_detailpembelian);
        $datadetail->id_pembelian = $id_pembelian;
        $datadetail->id = $id_detailbeli;
        $datadetail->id_bahan = $idbahan;
        $datadetail->jumlah = $jumlah;
        $datadetail->subtotal = $subtotal;
        $datadetail->save();
    }

    public function showEdit($id)
    {
        $data = Pembelian::where('id', $id)->first();
        return view('admin.pembelian_ubah')->with('data', $data);
    }

    public function show($id)
    {
        $data = Pembelian::where('id', $id)->first();
        return view('admin.pembelian_detail')->with('data', $data);
    }

    public function hapusDetailPembelian($id)
    {
        $data = DetailPembelian::where('id_pembelian', '=', $id)->delete();
        return "berhasil";
    }

    public function destroy(Request $request, $id)
    {

        $data = Pembelian::where('id', $id)->delete();

        $notification = array(
            'message' => 'Data berhasil dihapus',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
                
    }
}
