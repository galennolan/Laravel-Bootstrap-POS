<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetailPesan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pesan', function(Blueprint $table){
            $table->string('no_pesan',14);
            $table->string('kd_brg',5);
            $table->integer('qty_brg');
            $table->integer('qty_pesan');
            $table->integer('subtotal');

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
