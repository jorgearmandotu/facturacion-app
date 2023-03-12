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
    ];

    public function dataInvoices(){
        return $this->hasMany(DataInvoices::class);
    }

    public function clients() {
        return $this->hasOne(Tercero::class, 'id', 'client_id');
    }
}
