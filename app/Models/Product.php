<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        //'line_id',
        'group_id',
        'code',
        'name',
        'bar_code',
        'reference',
        'costo',
        'costo_promedio',
        'quantity_costos',
        'costo_fijo',
        'select_costo',
        'profit',
        'location_main',
        'cstate_id',
        'date',
    ];

    public function prices(){
        return $this->hasMany(ListPrices::class);
    }

    public function groups() {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function cstates(){
        return $this->hasOne(Cstate::class, 'id', 'cstate_id');
    }

    public function taxes(){
        return $this->belongsToMany(Tax::class, 'products_taxes', 'product_id', 'tax_id');
    }

    public function dataInvoice(){
        return $this->belongsToMany(DataInvoices::class);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class, 'product_id', 'id');
    }

    public function shopingInvoices(){
        return $this->hasMany(ShoppingInvoice::class, 'product_id', 'id');
    }

    public function locations(){
        return $this->hasMany(LocationProduct::class, 'product_id', 'id');
    }

    public function locationMain(){
        return $this->hasOne(Location::class, 'id', 'location_main');
    }

}
