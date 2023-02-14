<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'product_id',
        'stock'
    ];
}
