<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'prefijo',
        'client_id',
        'vlr_total',
        'date_invoice',
        'cstate_id',
        'discount',
        'user_id',
        'type',
        'payment_method',
        'observation',
    ];

    public function dataInvoices(){
        return $this->hasMany(DataInvoices::class, 'invoice_id', 'id');
    }

    public function clients() {
        return $this->hasOne(Tercero::class, 'id', 'client_id');
    }

    public function state() {
        return $this->hasOne(Cstate::class, 'id', 'cstate_id');
    }

    public function receipts() {
        return $this->hasMany(Receipt::class, 'invoice_id', 'id');
    }

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
