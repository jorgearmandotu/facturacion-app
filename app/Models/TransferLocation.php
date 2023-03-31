<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferLocation extends Model
{
    protected $table = 'transfer_locations';
    use HasFactory;

    protected $fillable = [
        'number',
        'product_id',
        'fromLocation',
        'toLocation',
        'quantity',
        'user_id',
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function fromLocations(){
        return $this->hasOne(Location::class, 'id', 'fromLocation');
    }

    public function toLocations(){
        return $this->hasOne(Location::class, 'id', 'toLocation');
    }

}
