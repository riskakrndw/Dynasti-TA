<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Penjualan extends Model
{
    protected $table = "penjualan";

    protected $fillable = [
    	'id', 'total', 'tgl'
	];

	public function detail_jual(){
		return $this->hasMany('App\DetailPenjualan', 'id_penjualan');
	}

	public function ice_cream(){
		return $this->belongsToMany('App\IceCream');
	}

	public function users(){
        return $this->belongsTo('App\User', 'id_users');
    }

    public static function getTahun(){
    	return DB::select(DB::raw("select YEAR(tgl) as tahun FROM penjualan group by tahun"));
    }

    public static function getJumlahPenjualan(){
    	return DB::select(DB::raw("select MONTHNAME(tgl) as bulan, sum(total) as total_penjualan FROM penjualan WHERE YEAR(tgl)=2017 group by bulan ASc"));
    }


}
