<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyData extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_view',
        'razon_social',
        'dni',
        'address',
        'phone',
        'regimen',
        'actividad_economica',
        'email',
        'usa_resolucion_factura',
    ];
}
