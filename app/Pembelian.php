<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = "pembelian";
    
    protected $fillable = [
    	'id', 'total', 'tgl', 'status'
    ];

    public function detail_beli(){
    	return $this->hasMany('App\DetailPembelian', 'id_pembelian');
    }

    public function bahan(){
    	return $this->belongsToMany('App\Bahan');
    }

    public function users(){
        return $this->belongsTo('App\User', 'id_users');
    }
}
