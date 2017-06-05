<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    protected $table = "detail_pembelian";

    protected $fillable = [
    	'id', 'id_pembelian', 'id_bahan', 'jumlah', 'subtotal',
    ];

    public function pembelian(){
    	return $this->belongsTo('App\Pembelian', 'id_pembelian');
    }

    public function bahan(){
    	return $this->belongsTo('App\Bahan', 'id_bahan');
    }
}
