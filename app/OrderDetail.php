<?php

namespace App;

use App\Product;
use App\Order;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public function product()
    {
        return $this->belongsTo( Product::class );
    }
    public function orders()
    {
        return $this->belongsTo( Order::class );
    }
}
