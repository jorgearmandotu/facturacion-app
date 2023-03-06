<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListPrices extends Model
{
    protected $table = 'list_prices';
    use HasFactory;

    protected $fillable = [
        'id_product',
        'name',
        'price',
    ];

    public function products(){
        return $this->hasOne(Product::class);
    }
}
