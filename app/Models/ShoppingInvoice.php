<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'number',
        'prefijo',
        'total',
        'date_invoice',
        'date_upload',
    ];

    public function suppliers(){
        return $this->belongsTo(Tercero::class, 'supplier_id');
    }
    public function products(){
        return $this->hasMany(DataInvoices::class, 'shopping_invoice_id', 'id');
    }

}
