<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    protected $table = "bahan_baku";

    protected $fillable = [
    	'id', 'nama', 'harga', 'stok', 'satuan', 'stok_min'
    ];

    public function ice_cream(){
    	return $this->belongsToMany('App\IceCream');
    }
}
