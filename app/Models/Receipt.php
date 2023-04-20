<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;
    protected $table = 'receipts';
    protected $fillable = [
        'type',
        'tercero_id',
        'invoice_id',
        'vlr_invoice',
        'vlr_payment',
        'user_id',
        'date',
        'remision_id',
        'observation',
        'cstate_id',
        'shopping_invoice_id'
    ];

    public function remision(){
        return $this->hasOne(Remision::class, 'id', 'remision_id');
    }

    public function clients(){
        return $this->hasOne(Tercero::class, 'id', 'tercero_id');
    }

    public function invoices(){
        return $this->hasOne(Invoice::class, 'id', 'invoice_id');
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function state(){
        return $this->hasOne(Cstate::class, 'id', 'cstate_id');
    }
}
