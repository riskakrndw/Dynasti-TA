<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    protected $table = "produksi";

    protected $fillable = [
    	'id', 'tgl'
    ];

    public function users(){
        return $this->belongsTo('App\User', 'id_users');
    }

    public function detail_produksi(){
        return $this->hasMany('App\DetailProduksi', 'id_produksi');
    }
}
