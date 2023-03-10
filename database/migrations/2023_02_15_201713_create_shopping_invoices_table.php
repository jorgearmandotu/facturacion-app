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
        Schema::create('shopping_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->references('id')->on('suppliers');
            $table->integer('number');
            $table->decimal('total', 10, 2)->default(0);
            $table->date('date_invoice');
            $table->date('date_upload');
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
        Schema::dropIfExists('shopping_invoices');
    }
};
