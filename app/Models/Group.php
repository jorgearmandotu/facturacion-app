<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'line_id',
        'cstate_id',
    ];

    public function cstates(){
        return $this->belongsTo(Cstate::class, 'cstate_id');
    }

    public function lines(){
        return $this->belongsTo(Line::class, 'line_id');
    }


    public function products(){
        return $this->hasMany(Product::class);
    }
}
