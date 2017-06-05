<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailPemesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pemesanan', function($table){
            $table->increments('id', 5);
            $table->string('id_pemesanan', 10)->references('id')->on('pemesanan');
            $table->integer('id_es')->references('id')->on('ice_cream');
            $table->integer('jumlah');
            $table->integer('total');
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
