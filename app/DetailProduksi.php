<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailProduksi extends Model
{
    protected $table = "detail_produksi";

    protected $fillable = [
    	'id', 'id_produksi', 'id_es', 'jumlah'
    ];

    public function produksi(){
    	return $this->belongsTo('App\Produksi', 'id_produksi');
    }

    public function ice_cream(){
    	return $this->belongsTo('App\IceCream', 'id_es');
    }
}
