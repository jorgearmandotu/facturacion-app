<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpaymentMethods extends Model
{
    use HasFactory;
    protected $table = 'cpayment_methods';

    protected $fillable = [
        'value',
        'cstate_id'
    ];

    public function state(){
        return $this->hasOne(Cstate::class, 'id', 'cstate_id');
    }
}
