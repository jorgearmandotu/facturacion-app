<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tercero extends Model
{
    use HasFactory;
    protected $fillable = [
        'dni',
        'document_type',
        'name',
        'phone',
        'address',
        'email',
        'supplier',
    ];

    public function shoppingInvoices(){
        return $this->hasMany(ShoppingInvoice::class);
    }

    public function documentType() {
        return $this->hasOne(Document_type::class, 'id', 'document_type');
    }
}
