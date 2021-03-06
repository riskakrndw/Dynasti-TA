<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailEs extends Model
{
    protected $table = "detail_es";

    protected $fillable = [
    	'id_bahan', 'id_es', 'takaran',
    ];

    public function ice_cream(){
    	return $this->belongsTo('App\IceCream', 'id_es');
    }

    public function pembelian(){
        return $this->belongsTo('App\Pembelian', 'id_pembelian');
    }

    public function bahan(){
    	return $this->belongsTo('App\Bahan', 'id_bahan');
    }
}
