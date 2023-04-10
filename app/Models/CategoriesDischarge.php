<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class CategoriesDischarge extends Model
{
    use HasFactory;
    protected $table = 'categories_discharges';
    protected $fillable = [
        'name',
        'cstate_id',
    ];

    public function category(){
        return $this->hasMany(Category::class, 'category_id', 'id');
    }
}
