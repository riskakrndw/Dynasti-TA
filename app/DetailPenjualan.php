<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $table = "detail_penjualan";

    protected $fillable = [
    	'id', 'id_penjualan', 'id_es', 'jumlah', 'subtotal'
    ];

    public function penjualan(){
    	return $this->belongsTo('App\Penjualan', 'id_penjualan');
    }

    public function ice_cream(){
    	return $this->belongsTo('App\IceCream', 'id_es');
    }
}
