<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resolution extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'date_resolution',
        'expiration_date',
        'validity',
        'prefijo',
        'initial_number',
        'final_number',
    ];
}
