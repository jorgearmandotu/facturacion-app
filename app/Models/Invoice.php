<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'client_id',
        'vlr_total',
        'date_invoice',
        'cstate_id',
        'discount',
        'user_id',
        'type'
    ];
}
