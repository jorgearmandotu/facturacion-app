<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cstate_id',
    ];

    public function cstates(){
        return $this->hasOne(Cstate::class, 'id', 'cstate_id');
    }
}
