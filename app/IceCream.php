<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IceCream extends Model
{
    protected $table = "ice_cream";

    protected $fillable = [
    	'id_jenis', 'id_rasa', 'nama', 'harga', 'stok',
    ];

    public function jenis(){
    	return $this->belongsTo('App\Jenis', 'id_jenis');
    }

    public function rasa(){
    	return $this->belongsTo('App\Rasa', 'id_rasa');
    }

    public function detail_bahan(){
        return $this->hasMany('App\DetailBahan', 'id_es');
    }

    public function bahan(){
        return $this->belongsToMany('App\Bahan');
    }

    public function produksi(){
        return $this->hasMany('App\Produksi', 'id_es');
    }

}
