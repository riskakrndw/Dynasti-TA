<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIceCreamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ice_cream', function($table){
            $table->increments('id', 5);
            $table->integer('id_jenis')->references('id')->on('jenis');
            $table->integer('id_rasa')->references('id')->on('rasa');
            $table->string('nama', 50);
            $table->integer('harga');
            $table->integer('stok');
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
