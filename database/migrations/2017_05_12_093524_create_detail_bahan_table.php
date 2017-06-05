<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailBahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_bahan', function($table){
            $table->increments('id', 5);
            $table->integer('id_bahan')->references('id')->on('bahan_baku');
            $table->integer('id_es')->references('id')->on('ice_Cream');
            $table->float('takaran', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
