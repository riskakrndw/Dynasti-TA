<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function laporanPembelian()
    {
        return view('admin.laporan_pembelian');
    }

    public function laporanPenjualan()
    {
        return view('admin.laporan_penjualan');
    }

    public function laporanEs()
    {
        return view('admin.laporan_es');
    }
}
