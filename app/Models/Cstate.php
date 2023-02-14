<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cstate extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
    ];

    public function groups(){
        return $this->hasMany(Group::class);
    }

    public function lines(){
        return $this->hasMany(Line::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function locations(){
        return $this->hasMany(Location::class);
    }
}
