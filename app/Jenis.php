<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jenis extends Model
{

    use SoftDeletes;
    
    protected $table = "jenis";

    protected $fillable = [
    	'nama', 'harga',
    ];

    public function ice_cream(){
    	return $this->hasMany('App\Icecream', 'id_jenis')->withTrashed();
    }

}
