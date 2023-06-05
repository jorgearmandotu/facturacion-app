<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'value',
        'description',
        'cstate_id',
    ];

    public function products(){
        return $this->belongsToMany(products::class);
    }

    public function state(){
        return $this->hasOne(Cstate::class, 'id', 'cstate_id');
    }

}
