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
            $datamenunggu = Pembelian::where('status', '=', 'menunggu')->get();
            $datadisetujui = Pembelian::where('status', '=', 'disetujui')->get();
            $dataditolak = Pembelian::where('status', '=', 'ditolak')->get();
            $datadibeli = Pembelian::where('status', '=', 'dibeli')->get();
            $dataditerima = Pembelian::where('status', '=', 'diterima')->get();
            $datagagal = Pembelian::where('status', '=', 'gagal')->get();
            return view('admin.pembelian')->with('data', $data)->with('datamenunggu', $datamenunggu)->with('datadisetujui', $datadisetujui)->with('dataditolak', $dataditolak)->with('datadibeli', $datadibeli)->with('dataditerima', $dataditerima)->with('datagagal', $datagagal);
        } elseif (Auth::user()->level == "keuangan"){
            $data = Pembelian::all();
            $datamenunggu = Pembelian::where('status', '=', 'menunggu')->get();
            $datadisetujui = Pembelian::where('status', '=', 'disetujui')->get();
            $dataditolak = Pembelian::where('status', '=', 'ditolak')->get();
            $datadibeli = Pembelian::where('status', '=', 'dibeli')->get();
            $dataditerima = Pembelian::where('status', '=', 'diterima')->get();
            $datagagal = Pembelian::where('status', '=', 'gagal')->get();
            return view('keuangan.pembelian')->with('data', $data)->with('datamenunggu', $datamenunggu)->with('datadisetujui', $datadisetujui)->with('dataditolak', $dataditolak)->with('datadibeli', $datadibeli)->with('dataditerima', $dataditerima)->with('datagagal', $datagagal);
        } elseif (Auth::user()->level == "pengadaan"){
            $data = Pembelian::all();
            $datamenunggu = Pembelian::where('status', '=', 'menunggu')->get();
            $datadisetujui = Pembelian::where('status', '=', 'disetujui')->get();
            $dataditolak = Pembelian::where('status', '=', 'ditolak')->get();
            $datadibeli = Pembelian::where('status', '=', 'dibeli')->get();
            $dataditerima = Pembelian::where('status', '=', 'diterima')->get();
            $datagagal = Pembelian::where('status', '=', 'gagal')->get();
            return view('pengadaan.pembelian')->with('data', $data)->with('datamenunggu', $datamenunggu)->with('datadisetujui', $datadisetujui)->with('dataditolak', $dataditolak)->with('datadibeli', $datadibeli)->with('dataditerima', $dataditerima)->with('datagagal', $datagagal);
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

    public function store($pengguna, $datepicker, $total)
    {
        $data = new Pembelian;
        $data->kode_pembelian = 'BL/' . $datepicker . '/';
        $data->id_users = $pengguna;
        $data->tgl = $datepicker;
        $data->total = $total;
        if(Auth::user()->level == "manager"){
            $data->status = "diterima";
        } elseif (Auth::user()->level == "keuangan"){
            $data->status = "diterima";
        } elseif (Auth::user()->level == "pengadaan"){
            $data->status = "menunggu";
        }
        $data->save();

        $data->kode_pembelian = $data->kode_pembelian . $data->id;
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

    public function ubah($id_beli, $pengguna, $datepicker, $total)
    {
        $data = Pembelian::find($id_beli);
        $data->kode_pembelian = 'BL/' . $datepicker . '/' . $data->id;
        $data->id_users = $pengguna;
        $data->tgl = $datepicker;
        $data->total = $total;
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

    public function konfirmasikeu(){
        $data = Pembelian::where('status', '=', 'diterima')->get();
        /*$dd($data);*/
        return view('keuangan.konfirmasipermintaan')->with('data', $data);
    }

    public function ubahStatusKeu(Request $request)
    {
        $data = Pembelian::where('id', $request->id)->first();

        $data->status = $request->status;
        $data->save();

        foreach ($data->detail_beli as $key => $value) {
            $bahan = Bahan::find($value->id_bahan);
            $bahan->stok = $bahan->stok + $value->jumlah;
            $bahan->save();
        }
        $notification = array(
            'message' => 'Data berhasil diubah',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);

    }

    public function pembelianDisetujui(Request $request)
    {
        $data = Pembelian::where('id', $request->id)->first();

        $data->status = $request->status;
        $data->save();
        
        $notification = array(
            'message' => 'Permintaan berhasil disetujui',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function pembelianDitolak(Request $request)
    {
        $data = Pembelian::where('id', $request->id)->first();

        $data->status = $request->status;
        $data->save();
        
        $notification = array(
            'message' => 'Permintaan berhasil ditolak',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function pembelianDibeli(Request $request)
    {
        $data = Pembelian::where('id', $request->id)->first();

        $data->status = $request->status;
        $data->save();
        
        $notification = array(
            'message' => 'Barang pengadaan telah dibeli',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function pembelianGagal(Request $request)
    {
        $data = Pembelian::where('id', $request->id)->first();

        $data->status = $request->status;
        $data->save();

        $notification = array(
            'message' => 'Pembelian berhasil dibatalkan',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function pembelianDiterima(Request $request)
    {
        $data = Pembelian::where('id', $request->id)->first();

        $data->status = $request->status;
        $data->save();

        foreach ($data->detail_beli as $key => $value) {
            $bahan = Bahan::find($value->id_bahan);
            $bahan->stok = $bahan->stok + $value->jumlah;
            $bahan->save();
        }
        $notification = array(
            'message' => 'Barang pengadaan telah diterima',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    //UNTUK DI USER PENGADAAN
    public function konfirmasipenerimaan(){
        $data = Pembelian::where('status', '=', 'dibeli')->get();
        /*$dd($data);*/
        return view('pengadaan.konfirmasipenerimaan')->with('data', $data);
    }

}
