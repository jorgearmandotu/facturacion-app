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
            $table->enum('type', ['CONTADO', 'CREDITO'])->default('CONTADO');
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
