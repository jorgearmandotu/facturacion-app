<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotesProducts extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'note_id',
        'quantity',
        'costo',
        'position',
    ];

    public function note(){
        return $this->hasOne(Notes::class, 'id', 'note_id');
    }

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
