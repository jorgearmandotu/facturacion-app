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
        Schema::create('data_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->references('id')->on('products');
            $table->foreignId('invoice_id')->nullable()->constrained('invoices', 'id');
            $table->integer('quantity')->default(0);
            $table->decimal('vlr_unit', 10, 2);
            $table->decimal('vlr_tax', 10, 2)->default(0);
            $table->integer('position')->nullable();
            $table->foreignId('shopping_invoice_id')->nullable()->constrained('shopping_invoices', 'id');
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
        Schema::dropIfExists('invoices_products');
    }
};
