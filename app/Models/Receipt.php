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
}
