<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cstate_id',
    ];

    public function cstates(){
        return $this->belongsTo(Cstate::class, 'cstate_id');
    }

    public function groups(){
        return $this->hasMany(Group::class);
    }

}
