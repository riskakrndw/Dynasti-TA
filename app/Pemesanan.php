<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemesanan extends Model
{

    use SoftDeletes;
    
    protected $table = "pemesanan";

    protected $fillable = [
    	'id', 'nama', 'alamat', 'telepon', 'tanggal', 'total', 'status'
    ];

    public function detail_pemesanan(){
        return $this->hasMany('App\DetailPemesanan', 'id_pemesanan');
    }
}
