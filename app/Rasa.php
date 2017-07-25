<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rasa extends Model
{

    use SoftDeletes;
    
    protected $table = "rasa";

    protected $fillable = [
    	'id', 'nama', 'takaran'
    ];

    public function ice_cream(){
    	return $this->hasMany('App\Icecream', 'id_rasa');
    }

    public function detail_rasa(){
    	return $this->hasMany('App\DetailRasa', 'id_rasa');
    }
    
}
