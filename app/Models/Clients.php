<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    //protected $table = "clients";
    use HasFactory;
    protected $fillable = [
        'dni',
        'document_type',
        'name',
        'phone',
        'address',
        'email'
    ];
}
