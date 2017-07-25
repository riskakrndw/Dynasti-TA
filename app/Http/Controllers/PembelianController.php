<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Pembelian;
use App\DetailPembelian;
use App\Bahan;
use App\User;

class PembelianController extends Controller
{
    
    public function index()
    {
        if(Auth::user()->level == "manager"){
            $data = Pembelian::all();
            $databerhasil = Pembelian::where('status', '=', 'berhasil')->get();
            $datamenunggu = Pembelian::where('status', '=', 'menunggu')->get();
            $datagagal = Pembelian::where('status', '=', 'gagal')->get();
            return view('admin.pembelian')->with('data', $data)->with('databerhasil', $databerhasil)->with('datamenunggu', $datamenunggu)->with('datagagal', $datagagal);
        } elseif (Auth::user()->level == "keuangan"){
            $data = Pembelian::all();
            $databerhasil = Pembelian::where('status', '=', 'berhasil')->get();
            $datamenunggu = Pembelian::where('status', '=', 'menunggu')->get();
            $datagagal = Pembelian::where('status', '=', 'gagal')->get();return view('keuangan.pembelian')->with('data', $data)->with('databerhasil', $databerhasil)->with('datamenunggu', $datamenunggu)->with('datagagal', $datagagal);
        } elseif (Auth::user()->level == "pengadaan"){
            $data = Pembelian::all();
            $databerhasil = Pembelian::where('status', '=', 'berhasil')->get();
            $datamenunggu = Pembelian::where('status', '=', 'menunggu')->get();
            $datagagal = Pembelian::where('status', '=', 'gagal')->get();
            return view('pengadaan.pembelian')->with('data', $data)->with('databerhasil', $databerhasil)->with('datamenunggu', $datamenunggu)->with('datagagal', $datagagal);
        }
        
    }

    public function tambah()
    {
        if(Auth::user()->level == "manager"){
            $dataBahan = DetailPembelian::get();
            return view('admin.pembelian_tambah');
        } elseif (Auth::user()->level == "keuangan"){
            $dataBahan = DetailPembelian::get();
            return view('keuangan.pembelian_tambah');
        } elseif (Auth::user()->level == "pengadaan"){
            $dataBahan = DetailPembelian::get();
            return view('pengadaan.pembelian_tambah');
        }
        
    }

    public function store($kode, $pengguna, $datepicker, $total, $status)
    {
        $data = new Pembelian;
        $data->kode_pembelian = $kode;
        $data->id_users = $pengguna;
        $data->tgl = $datepicker;
        $data->total = $total;
        if(Auth::user()->level == "manager"){
            $data->status = "berhasil";
        } elseif (Auth::user()->level == "keuangan"){
            $data->status = "berhasil";
        } elseif (Auth::user()->level == "pengadaan"){
            $data->status = "menunggu";
        }
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
        if(Auth::user()->level == "manager"){
            $data->status = "berhasil";
        } elseif (Auth::user()->level == "keuangan"){
            $data->status = "berhasil";
        } elseif (Auth::user()->level == "pengadaan"){
            $data->status = "menunggu";
        }
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
        if(Auth::user()->level == "manager"){
            $data = Pembelian::where('id', $id)->first();
            return view('admin.pembelian_ubah')->with('data', $data);
        } elseif (Auth::user()->level == "keuangan"){
            $data = Pembelian::where('id', $id)->first();
            return view('keuangan.pembelian_ubah')->with('data', $data);
        } elseif (Auth::user()->level == "pengadaan"){
            $data = Pembelian::where('id', $id)->first();
            return view('pengadaan.pembelian_ubah')->with('data', $data);
        }
        
    }

    public function show($id)
    {
        if(Auth::user()->level == "manager"){
            $data = Pembelian::where('id', $id)->first();
            return view('admin.pembelian_detail')->with('data', $data);
        } elseif (Auth::user()->level == "keuangan"){
            $data = Pembelian::where('id', $id)->first();
            return view('keuangan.pembelian_detail')->with('data', $data);
        } elseif (Auth::user()->level == "pengadaan"){
            $data = Pembelian::where('id', $id)->first();
            return view('pengadaan.pembelian_detail')->with('data', $data);
        }
        
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

    public function konfirmasi(){
        $data = Pembelian::where('status', '=', 'menunggu')->get();
        /*$dd($data);*/
        return view('admin.permintaan')->with('data', $data);
    }

    public function ubahStatus(Request $request)
    {
        $data = Pembelian::where('id', $request->id)->first();

        $data->status = $request->status;
        $data->save();

        $notification = array(
            'message' => 'Data berhasil diubah',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);

    }

}
