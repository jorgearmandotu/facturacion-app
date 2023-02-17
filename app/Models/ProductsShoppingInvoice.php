<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsShoppingInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'invoice_id',
        'quantity',
        'price',
    ];

    public function taxes(){
        return $this->belongsToMany(Tax::class, 'products_taxes', 'product_id', 'tax_id');
    }
}
