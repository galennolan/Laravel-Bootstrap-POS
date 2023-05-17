<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddCartTriggerToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER update_product_quantity
            AFTER INSERT, UPDATE ON products
            FOR EACH ROW
            BEGIN
                UPDATE products
                SET quantity = quantity - NEW.quantity
                WHERE id = NEW.product_id;
                END //

                DELIMITER ;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_product_quantity');
    }
}