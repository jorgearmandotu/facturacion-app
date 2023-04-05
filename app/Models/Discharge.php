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
        'description',
        'date',
        'mount',
        'user_id',
    ];

    public function category(){
        return $this->hasOne(CategoriesDischarge::class, 'id', 'category_discharge');
    }

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
