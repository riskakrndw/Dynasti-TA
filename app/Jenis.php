<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $table = "jenis";

    protected $fillable = [
    	'id', 'nama'
    ];

    public function ice_cream(){
    	return $this->hasMany('App\Icecream', 'id_jenis');
    }

}
