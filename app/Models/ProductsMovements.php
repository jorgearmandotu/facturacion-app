<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsMovements extends Model
{
    use HasFactory;
    use HasUuids;
    protected $table = 'products_movements';

    protected $fillable = [
        'type',
        'quantity',
        'saldo',
        'document_type',
        'document_id',
        'location_id',
        'product_id'
    ];

    public function location(){
        return $this->hasOne(Location::class, 'id', 'location_id');
    }
    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function documentType(){
        return $this->hasOne(CtypesNotes::class, 'id', 'document_type');
    }

    public function invoice(){
        $documentType = CtypesNotes::find($this->document_type);
        if($documentType){
            if($documentType->name == 'Factura de venta'){
                return $this->hasOne(DataInvoices::class, 'invoice_id', 'document_id');
            }else if($documentType->name == 'Factura de compra'){
                return $this->hasOne(DataInvoices::class, 'shopping_invoice_id', 'document_id');
            }else if($documentType->name == 'Anulacion' && $this->type == 'Entrada'){
                return $this->hasOne(DataInvoices::class, 'invoice_id', 'document_id');
            }else if($documentType->name == 'Anulacion' && $this->type == 'Salida'){
                return $this->hasOne(DataInvoices::class, 'shopping_invoice_id', 'document_id');
            }
        }
        return $this->hasOne(DataInvoices::class, 'shopping_invoice_id', 'document_id');//nunca deberia ejecutarse
        // }else if($this->document_type == 'Anulacion' && $this->type == 'Salida'){
        //     return $this->hasOne(DataInvoices::class, 'shopping_invoice_id', 'document_id');
        // }
    }

    public function shoppingInvoice(){
        return $this->hasOne(DataInvoices::class, 'shopping_invoice_id','document_id');
    }

    public function transfer(){
        return $this->hasOne(TransferLocation::class, 'number', 'document_id');
    }

    public function note(){
        return $this->hasOne(Notes::class, 'id', 'document_id');
    }

}
