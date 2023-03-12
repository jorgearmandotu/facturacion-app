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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->text('number', 20);
            $table->text('prefijo', 5);
            $table->foreignId('client_id')->references('id')->on('terceros');
            $table->decimal('vlr_total', 10, 2);
            $table->date('date_invoice');
            $table->foreignId('cstate_id')->references('id')->on('cstates');
            $table->decimal('discount',10 ,2)->default(0);
            $table->foreignId('user_id')->references('id')->on('users');
            $table->enum('type', ['CONTADO', 'CREDITO'])->default('CONTADO');
            $table->enum('payment_method', ['EFECTIVO', 'TARJETA', 'TRANSFERENCIA']);
            $table->foreignId('resolution')->references('id')->on('resolutions');
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
        Schema::dropIfExists('invoices');
    }
};
