<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        //'line_id',
        'group_id',
        'code',
        'name',
        'bar_code',
        'reference',
        'costo',
        'profit',
        'price',
        'cstate_id',
    ];

    public function groups() {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function cstates(){
        return $this->belongsTo(Cstate::class, 'cstate_id');
    }
}
