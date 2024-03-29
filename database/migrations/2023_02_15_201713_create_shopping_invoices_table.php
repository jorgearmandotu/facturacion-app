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
            $table->foreignId('supplier_id')->references('id')->on('terceros');
            $table->integer('number');
            $table->decimal('total', 10, 2)->default(0);
            $table->foreignId('cstate_id')->references('id')->on('cstates');
            $table->date('date_invoice');
            $table->date('date_upload');
            $table->enum('type',['CONTADO', 'CREDITO'])->default('CONTADO');
            $table->text('payment_method', '50')->default('EFECTIVO');
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
