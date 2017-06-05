<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    protected $table = "produksi";

    protected $fillable = [
    	'id', 'tgl'
    ];

    public function detail_produksi(){
    	return $this->hasMany('App\DetailProduksi', 'id_produksi');
    }

    public function ice_cream(){
    	return $this->belongsToMany('App\IceCream');
    }
}
