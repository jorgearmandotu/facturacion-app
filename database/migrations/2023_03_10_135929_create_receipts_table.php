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
            $table->foreignId('tercero_id');
            $table->foreignId('invoice_id');//para cruzar con factura
            $table->decimal('vlr_invoice');
            $table->decimal('vlr_payment')->default(0);//valor q paga
            $table->enum('type', ['EFECTIVO', 'TARJETA', 'TRANSFERENCIA'])->default('EFECTIVO');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->date('date');
            $table->foreignId('remision_id')->references('id')->on('remisiones')->nullable();
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
