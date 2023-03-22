<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataInvoices extends Model
{
    protected $table = 'data_invoices';
    use HasFactory;
    protected $fillable = [
        'product_id',
        'invoice_id',
        'quantity',
        'vlr_unit',
        'vlr_tax',
        'position',
        'shopping_invoice_id',
    ];

    public function invoice(){
        return $this->hasOne(Invoice::class, 'id', 'invoice_id');
    }

    public function shoppingInvoice(){
        return $this->hasOne(ShoppingInvoice::class, 'id', 'shopping_invoice_id');
    }

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
