<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsMovements extends Model
{
    use HasFactory;
    protected $table = 'products_movements';

    protected $fillable = [
        'type',
        'quantity',
        'saldo',
        'document_type',
        'document_id',
        'location_id',
        'product_id'
    ];

    public function location(){
        return $this->hasOne(Location::class, 'id', 'location_id');
    }
    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
