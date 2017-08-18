<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pemesanan;
use App\IceCream;
use App\DetailPemesanan;
use Auth;

class PemesananController extends Controller
{
    public function index()
    {
    	$data = DetailPemesanan::all();
        $datamenunggu = DetailPemesanan::where('status', '=', 'menunggu')->get();
        $datasiap = DetailPemesanan::where('status', '=', 'siap')->get();
        // dd($data);
    	return view('admin.pemesanan_barang')->with('data', $data)->with('datamenunggu', $datamenunggu)->with('datasiap', $datasiap);
    }

    public function index1()
    {
    	$data = Pemesanan::all();
        $datamenunggu = Pemesanan::where('status', '=', 'menunggu')->get();
        $datasiap = Pemesanan::where('status', '=', 'siap')->get();
        $dataselesai = Pemesanan::where('status', '=', 'selesai')->get();
        $databatal = Pemesanan::where('status', '=', 'batal')->get();
        // dd($databatal);
    	return view('admin.pemesanan')->with('data', $data)->with('datamenunggu', $datamenunggu)->with('datasiap', $datasiap)->with('dataselesai', $dataselesai)->with('databatal', $databatal);
    }

    public function tambah()
    {
        if(Auth::user()->level == "manager"){
            return view('admin.pemesanan_tambah');
        }
    	
    }

    public function store($pengguna, $kode, $nama, $alamat, $telepon, $datepicker, $total)
    {
        $data = new Pemesanan;
        $data->id_users = $pengguna;
        $data->kode_pemesanan = $kode;
        $data->nama = $nama;
        $data->alamat = $alamat;
        $data->telepon = $telepon;
        $data->tanggal = $datepicker;
        $data->total = $total;
        $data->save();

        return $data->id;
    }

    public function store1($idpesan, $namaes, $jumlah, $subtotal)
    {
        $ides = IceCream::where('nama', '=', $namaes)->first()->id;
        $datadetail = new DetailPemesanan;
        $datadetail->id_pemesanan = $idpesan;
        $datadetail->id_es = $ides;
        $datadetail->jumlah = $jumlah;
        $datadetail->subtotal = $subtotal;
        $datadetail->save();
    }

    public function produkSiap($ides, $jumlahes, $iddetailpemesanan)
    {

        $data = IceCream::find($ides);
        $cekstok;

        if($data->stok >= $jumlahes){
            $data->stok = $data->stok - $data->jumlahes;
            $data->save();

            $datadetail = DetailPemesanan::find($iddetailpemesanan);
            $datadetail->status = "siap";
            $datadetail->save();

            $detailpesanan = DetailPemesanan::Where('id_pemesanan', '=', $datadetail->id_pemesanan)->where('status', '=', 'menunggu')->get();
            // dd(count($detailpesanan));
            if(count($detailpesanan) == 0)
            {
                $datapemesanan = Pemesanan::find($datadetail->id_pemesanan);
                $datapemesanan->status = "siap";
                $datapemesanan->save();
                // dd($datapemesanan->status);
            }

            $cekstok = "cukup";
        }else{
            $cekstok = "tidak cukup";
        }

        return $cekstok;
    }

    public function pemesananSelesai($idpesanan)
    {
        $data = Pemesanan::find($idpesanan);
        $data->status = "selesai";
        $data->save();
    }

    public function updateJumlah($iddetail, $jumlahes)
    {
        $data = DetailPemesanan::find($iddetail);
        $data->jumlah = $jumlahes;
       
        
        $datapemesanan = Pemesanan::find($data->id_pemesanan);
        $datapemesanan->total = $datapemesanan->total - $data->subtotal + ($data->ice_cream->jenis->harga * $jumlahes);

        $data->subtotal = $data->ice_cream->jenis->harga * $jumlahes;

        $datapemesanan->save();

        $data->save();

        $hasil[0] = $data->subtotal;
        $hasil[1] = $datapemesanan->total;

        return $hasil;
    }

    public function show($id, $tipe)
    {
        $data = Pemesanan::find($id);
        // dd($data);
        return view('admin.pemesanan_detail')->with('data', $data)->with('tipe', $tipe);
    }

    public function ubah($id_pesan, $pengguna, $kode, $nama, $alamat, $telepon, $datepicker, $total, $status)
    {
        $data = Pemesanan::find($id_pesan);
        $data->id_users = $pengguna;
        $data->kode_pemesanan = $kode;
        $data->nama = $nama;
        $data->alamat = $alamat;
        $data->telepon = $telepon;
        $data->tanggal = $datepicker;
        $data->total = $total;
        $data->status = $status;
        $data->save();

        return $data->id;
    }

    public function ubah1($id_pemesanan, $ides, $jumlah, $subtotal)
    {
        /*$this->validate($request, [
            'nama' => 'required|min:2|max:50',
            'harga' => 'required|min:2|max:50',
            'stok' => 'required|min:2|max:50',
            'total' => 'required',
            'jumlahProduksi' => 'required|max:10',
        ]);*/   
    
        $data = DetailPemesanan::withTrashed()->where('id_es', '=', $ides)->first();

        if (count($data) == 0) {
            $data = new DetailPemesanan;
            $data->id_pemesanan = $id_pemesanan;
            $data->id_es = $ides;
        }else{
            if($data->deleted_at != "NULL"){
                $data->restore();
            }

        }
       
        $data->jumlah = $jumlah;
        $data->subtotal = $subtotal;
        $data->save();

        return $rasa;
    }

    public function hapusDetailPemesanan(Request $request)
    {

        $arr = explode(',', $request->iddetailpesan); //mecah jadi array
        $data = Pemesanan::where('id_pemesanan', '=', $request->idpesan)->whereNotIn('id_es', $arr);
        $data->delete();
    }

    public function showEdit($id)
    {
        if(Auth::user()->level == "manager"){
            $data = Pemesanan::where('id', $id)->first();
            return view('admin.pemesanan_ubah')->with('data', $data);
        }
        
    }
}
