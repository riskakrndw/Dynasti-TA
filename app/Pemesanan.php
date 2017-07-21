<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = "pemesanan";

    protected $fillable = [
    	'id', 'kode_pemesanan', 'nama', 'alamat', 'telepon', 'tanggal', 'total', 'status'
    ];

    public function detail_pemesanan(){
        return $this->hasMany('App\DetailPemesanan', 'id_pemesanan');
    }
}
