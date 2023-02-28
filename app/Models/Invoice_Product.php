<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_Product extends Model
{
    protected $table = 'invoices_products';
    use HasFactory;
    protected $fillable = [
        'product_id',
        'invoice_id',
        'quanity',
        'vlr_unit',
        'vlr_tax',
    ];
}
