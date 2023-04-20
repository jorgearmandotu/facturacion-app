<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tercero_id')->references('id')->on('terceros');
            $table->foreignId('invoice_id')->references('id')->on('invoices');//para cruzar con factura
            $table->foreignId('shopping_invoice_id')->references('id')->on('shopping_invoices');//para cruzar con factura de compra
            $table->decimal('vlr_invoice', 10, 2);
            $table->decimal('vlr_payment', 10, 2)->default(0);//valor q paga
            $table->text('type', '50')->default('EFECTIVO');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->date('date');
            $table->foreignId('remision_id')->nullable()->constrained('remisiones' ,'id');
            $table->text('observation', 150)->nullable();
            $table->foreignId('cstate_id')->references('id')->on('cstates');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipts');
    }
};
