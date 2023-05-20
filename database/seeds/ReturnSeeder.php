<?php
use Illuminate\Database\Seeder;
use App\Pengembalian;

class ReturnSeeder extends Seeder
{
    public function run()
    {
        Pengembalian::create([
            'order_detail_id' => 1,
            'quantity' => 2,
        ]);

        Pengembalian::create([
            'order_detail_id' => 2,
            'quantity' => 1,
        ]);
        
        // Add more sample data as needed
    }
}
