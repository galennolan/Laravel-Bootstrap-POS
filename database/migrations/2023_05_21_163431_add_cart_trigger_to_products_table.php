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
    //kita bikin ketika klik add cart quantity dari products 
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER update_product_quantity 
            AFTER INSERT ON carts
            FOR EACH ROW 
            BEGIN 
                UPDATE products SET quantity = quantity - NEW.quantity WHERE id = NEW.product_id; 
            END
        ');

        DB::unprepared('
            CREATE TRIGGER update_product_quantity_update 
            AFTER UPDATE ON carts
            FOR EACH ROW 
            BEGIN 
                UPDATE products SET quantity = quantity + OLD.quantity - NEW.quantity WHERE id = NEW.product_id; 
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
        DB::unprepared('DROP TRIGGER IF EXISTS update_product_quantity');
    }
}