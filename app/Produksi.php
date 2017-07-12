<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    protected $table = "produksi";

    protected $fillable = [
    	'id', 'tgl'
    ];

    public function ice_cream(){
    	return $this->belongsTo('App\IceCream', 'id_es');
    }

    public function users(){
        return $this->belongsTo('App\User', 'id_users');
    }
}
