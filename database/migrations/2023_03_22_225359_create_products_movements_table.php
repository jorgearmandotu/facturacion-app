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
        Schema::create('products_movements', function (Blueprint $table) {
            // $table->id();
            $table->uuid('id')->primary();
            $table->enum('type', ['Entrada', 'Salida', 'Creacion']);
            $table->foreignId('product_id')->references('id')->on('products');
            $table->integer('quantity');
            $table->integer('saldo');
            $table->enum('document_type', ['Invoice', 'shopping_invoice', 'Anulacion', 'TransferLocation'])->nullable();
            $table->bigInteger('document_id')->nullable();
            $table->foreignId('location_id')->constrained('locations', 'id')->nullable();
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
        Schema::dropIfExists('products_movements');
    }
};
