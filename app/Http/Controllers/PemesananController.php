<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pemesanan;
use App\IceCream;
use App\DetailPemesanan;
use Auth;

class PemesananController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = DetailPemesanan::whereIn('status', ['menunggu', 'siap'])->orderBy('updated_at', 'desc')->get();
        $datamenunggu = DetailPemesanan::where('status', '=', 'menunggu')->orderBy('updated_at', 'asc')->get();
        $datasiap = DetailPemesanan::where('status', '=', 'siap')->orderBy('updated_at', 'desc')->get();

        if(Auth::user()->level == "manager"){
            // dd($data);
            return view('admin.pemesanan_barang')->with('data', $data)->with('datamenunggu', $datamenunggu)->with('datasiap', $datasiap);
        } elseif (Auth::user()->level == "pengadaan"){
            // dd($data);
            return view('pengadaan.pemesanan_barang')->with('data', $data)->with('datamenunggu', $datamenunggu)->with('datasiap', $datasiap);
        }
    	
        
    }

    public function index1()
    {
    	$data = Pemesanan::orderBy('updated_at', 'desc')->get();
        $datamenunggu = Pemesanan::where('status', '=', 'menunggu')->orderBy('updated_at', 'asc')->get();
        $datasiap = Pemesanan::where('status', '=', 'siap')->orderBy('updated_at', 'asc')->get();
        $dataselesai = Pemesanan::where('status', '=', 'selesai')->orderBy('updated_at', 'desc')->get();
        $databatal = Pemesanan::where('status', '=', 'batal')->orderBy('updated_at', 'desc')->get();
        // dd($databatal);
        if(Auth::user()->level == "manager"){
            return view('admin.pemesanan')->with('data', $data)->with('datamenunggu', $datamenunggu)->with('datasiap', $datasiap)->with('dataselesai', $dataselesai)->with('databatal', $databatal);
        } elseif (Auth::user()->level == "pengadaan"){
            return view('pengadaan.pemesanan')->with('data', $data)->with('datamenunggu', $datamenunggu)->with('datasiap', $datasiap)->with('dataselesai', $dataselesai)->with('databatal', $databatal);
        }
    	
    }

    public function tambah()
    {
        if(Auth::user()->level == "manager"){
            return view('admin.pemesanan_tambah');
        }
    	
    }

    public function store($pengguna, $nama, $alamat, $telepon, $datepicker, $total)
    {
        $data = new Pemesanan;
        $data->id_users = $pengguna;
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
            $data->stok = $data->stok - $jumlahes;
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
            }

            $cekstok = "cukup";
        }else{
            $cekstok = "tidak cukup";
        }

        return $cekstok;
        // return $hasil;
    }

    public function pemesananSelesai($idpesanan)
    {
        $data = Pemesanan::find($idpesanan);
        $data->status = "selesai";
        $data->save();
    }

    public function pemesananBatal($idpesanan)
    {
        $data = Pemesanan::find($idpesanan);
        $data->status = "batal";
        $data->save();

        foreach ($data->detail_pemesanan as $value) {
            $value->status = "batal";
            $value->save();
        }
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
        if(Auth::user()->level == "manager"){
            return view('admin.pemesanan_detail')->with('data', $data)->with('tipe', $tipe);
        } elseif (Auth::user()->level == "pengadaan"){
            return view('admin.pemesanan_detail')->with('data', $data)->with('tipe', $tipe);
        }elseif (Auth::user()->level == "produksi"){
            return view('produksi.pemesanan_detail')->with('data', $data)->with('tipe', $tipe);
        }
        
        // dd($data);
        
    }

    public function ubah($id_pesan, $pengguna, $nama, $alamat, $telepon, $datepicker, $total)
    {
        $data = Pemesanan::find($id_pesan);
        $data->id_users = $pengguna;
        $data->nama = $nama;
        $data->alamat = $alamat;
        $data->telepon = $telepon;
        $data->tanggal = $datepicker;
        $data->total = $total;
        $data->save();

        return $data->id;
    }

    public function ubah1($pemesanan_id, $ides, $jumlah, $status, $subtotal)
    {
        /*$this->validate($request, [
            'nama' => 'required|min:2|max:50',
            'harga' => 'required|min:2|max:50',
            'stok' => 'required|min:2|max:50',
            'total' => 'required',
            'jumlahProduksi' => 'required|max:10',
        ]);*/   
    
        if($status == "menunggu"){
            $data = DetailPemesanan::withTrashed()->where('id_es', '=', $ides)->where('id_pemesanan', '=', $pemesanan_id)->get();

            if (count($data) == 0 || ($data[0]->status == "siap" && count($data) == 1)) {
                $datadetail = new DetailPemesanan;
                $datadetail->id_pemesanan = $pemesanan_id;
                $datadetail->id_es = $ides;
                $datadetail->jumlah = $jumlah;
                $datadetail->subtotal = $subtotal;
                $datadetail->save();
                return count($data);
            }elseif(count($data) > 1){
                $cek = false;
                $index;
                foreach ($data as $key => $value) {
                    if($value->status == "menunggu"){
                        $cek = true;
                        $index = $key;
                        break;
                    }
                }
                if($cek == false){
                    $datadetail = new DetailPemesanan;
                    $datadetail->id_pemesanan = $pemesanan_id;
                    $datadetail->id_es = $ides;
                    $datadetail->jumlah = $jumlah;
                    $datadetail->subtotal = $subtotal;
                    $datadetail->save();
                    return "2";
                }
                else{
                    $datadetail = $data[$index];
                    $datadetail->jumlah = $jumlah;
                    $datadetail->subtotal = $subtotal;
                    $datadetail->save();
                    return $jumlah;

                }
            }else{
                $datadetail = DetailPemesanan::withTrashed()->where('id_es', '=', $ides)->where('id_pemesanan', '=', $pemesanan_id)->first();

                if($datadetail->deleted_at != "NULL"){
                    $datadetail->restore();
                }

                $datadetail->jumlah = $jumlah;
                $datadetail->subtotal = $subtotal;
                $datadetail->save();
                return "4";
            }
            return $data;
        }
    
        
    }

    public function hapusDetailPemesanan(Request $request)
    {

        $arr = explode(',', $request->id); //mecah jadi array
        $data = DetailPemesanan::where('id_pemesanan', '=', $request->idpesan)->whereNotIn('id', $arr);
        $data->delete();

        return $request->id;
    }

    public function showEdit($id)
    {
        if(Auth::user()->level == "manager"){
            $data = Pemesanan::where('id', $id)->first();
            return view('admin.pemesanan_ubah')->with('data', $data);
        } elseif (Auth::user()->level == "pengadaan"){
            $data = Pemesanan::where('id', $id)->first();
            return view('pengadaan.pemesanan_ubah')->with('data', $data);
        }
        
    }
}
