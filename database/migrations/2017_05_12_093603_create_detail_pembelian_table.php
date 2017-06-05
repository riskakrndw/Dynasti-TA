<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailPembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pembelian', function($table){
            $table->increments('id', 5);
            $table->string('id_pembelian')->references('id')->on('pembelian');
            $table->integer('id_bahan')->references('id')->on('bahan_baku');
            $table->integer('jumlah');
            $table->integer('subtotal');
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
