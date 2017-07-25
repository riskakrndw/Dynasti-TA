<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IceCream extends Model
{

    use SoftDeletes;

    protected $table = "ice_cream";

    protected $fillable = [
    	'id_jenis', 'id_rasa', 'nama', 'harga', 'stok', 'jumlah_produksi',
    ];

    protected $dates = ['deleted_at'];

    public function jenis(){
    	return $this->belongsTo('App\Jenis', 'id_jenis')->withTrashed();
    }

    public function rasa(){
    	return $this->belongsTo('App\Rasa', 'id_rasa')->withTrashed();
    }

    public function detail_bahan(){
        return $this->hasMany('App\DetailBahan', 'id_es');
    }

    public function detail_pemesanan(){
        return $this->hasMany('App\DetailPemesanan', 'id_es');
    }

    public function bahan(){
        return $this->belongsToMany('App\Bahan');
    }

    public function produksi(){
        return $this->hasMany('App\Produksi', 'id_es');
    }

}
