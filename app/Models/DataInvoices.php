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
        'quanity',
        'vlr_unit',
        'vlr_tax',
        'position',
    ];

    public function invoice(){
        return $this->hasOne(Invoice::class, 'id', 'invoice_id');
    }

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
