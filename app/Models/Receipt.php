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
        'type',
    ];
}
