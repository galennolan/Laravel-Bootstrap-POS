<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class);
    }
}
