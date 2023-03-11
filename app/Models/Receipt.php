<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'tercero_id',
        'invoice_id',
        'vlr_invoice',
        'vlr_payment',
        'user_id',
        'date',
        'remision_id',
    ];

    public function remision(){
        return $this->hasOne(Remision::class, 'id', 'remision_id');
    }

    public function clients(){
        return $this->hasOne(Clients::class, 'id', 'tercero_id');
    }

    public function invoices(){
        return $this->hasOne(Invoice::class, 'id', 'invoice_id');
    }
}
