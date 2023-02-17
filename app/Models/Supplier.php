<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'dni',
        'name'
    ];

    public function shoppingInvoices(){
        return $this->hasMany(ShoppingInvoice::class);
    }
}
