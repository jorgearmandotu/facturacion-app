<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Notes extends Model
{
    use HasFactory;
    protected $fillable = [
        'location_id',
        'product_id',
        'quantity',
        'type',
        'costo',
        'description',
    ];

    public function typeNote() {
        return $this->HasOne(CtypesNotes::class, 'id', 'type');
    }
}
