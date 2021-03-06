<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailPemesanan extends Model
{

    use SoftDeletes;
    
    protected $table = "detail_pemesanan";

    protected $fillable = [
    	'id', 'id_pemesanan', 'id_es', 'jumlah', 'subtotal', 'status',
    ];

    public function pemesanan(){
    	return $this->belongsTo('App\Pemesanan', 'id_pemesanan');
    }

    public function ice_cream(){
    	return $this->belongsTo('App\IceCream', 'id_es');
    }
}
