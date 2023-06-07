<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CtypesNotes extends Model
{

    protected $table = 'ctypes_notes';
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];
}
