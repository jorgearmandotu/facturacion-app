<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationProduct extends Model
{
    protected $table = "locations_products";

    use HasFactory;

    protected $fillable = [
        'location_id',
        'product_id',
        'stock'
    ];

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function location(){
        return $this->hasOne(Location::class, 'id', 'location_id');
    }
}
