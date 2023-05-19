<?php

namespace App;

use App\Category;
use App\Supplier;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function scopeAvailable($query)
    {
        return $query->where('quantity', '>', 0);
    }

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo( Category::class );
    }

    public function supplier()
    {
        return $this->belongsTo( Supplier::class );
    }
}
