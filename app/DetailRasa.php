<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailRasa extends Model
{
    protected $table = "detail_rasa";

    protected $fillable = [
    	'id_bahan', 'id_rasa', 
    ];

    public function rasa(){
    	return $this->belongsTo('App\Rasa', 'id_rasa');
    }

    public function bahan(){
    	return $this->belongsTo('App\Bahan', 'id_bahan');
    }
}
