<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Notes extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'location_id',
        'description',
        'date_note',
    ];

    public function typeNote() {
        return $this->HasOne(CtypesNotes::class, 'id', 'type');
    }
}
