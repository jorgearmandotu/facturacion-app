<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListPrices extends Model
{
    protected $table = 'list_prices';
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'price',
        'utilidad',
    ];

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
