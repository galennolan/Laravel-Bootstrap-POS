<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TriggerTambah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER update_stok after INSERT ON detail_pembelian
        FOR EACH ROW BEGIN
        UPDATE barang
        SET stok = stok + qty_beli
        WHERE
        kd_brg = NEW.kd_brg;
        END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER update_stok');
    }
}
