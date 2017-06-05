<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = "pembelian";

    protected $fillable = [
    	'id', 'kode_pembelian', 'total', 'tgl',
    ];

    public function detail_beli(){
    	return $this->hasMany('App\DetailPembelian', 'id_pembelian');
    }

    public function bahan(){
    	return $this->belongsToMany('App\Bahan');
    }
}
