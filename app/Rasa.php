<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rasa extends Model
{
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
