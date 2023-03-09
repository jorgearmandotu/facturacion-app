<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remision extends Model
{
    use HasFactory;
    protected $table = 'remisiones';

    protected $fillable = [
        'client_id',
        'vlr_total',
        'vlr_payment',
        'date_remision',
        'description',
        'cstate_id',
        'user_id',
        'payment_method',
    ];
}
