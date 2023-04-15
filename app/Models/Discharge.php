<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class Discharge extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_discharge',
        'tercero_id',
        'description',
        'date',
        'mount',
        'payment_method',
        'user_id',
        'cstate_id'
    ];


    public function category(){
        return $this->hasOne(CategoriesDischarge::class, 'id', 'category_discharge');
    }

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function state() {
        return $this->hasOne(Cstate::class, 'id', 'cstate_id');
    }

    public function tercero() {
        return $this->hasOne(Tercero::class, 'id', 'tercero_id');
    }
}
