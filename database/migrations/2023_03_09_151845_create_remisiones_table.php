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
        Schema::create('remisiones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->references('id')->on('clients');
            $table->decimal('vlr_total',10, 2)->default(0);
            $table->decimal('vlr_payment', 10, 2)->default(0);
            $table->text('description', 400);
            $table->date('date_remision');
            $table->foreignId('cstate_id')->references('id')->on('cstates');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->enum('payment_method', ['EFECTIVO', 'TARJETA', 'TRANSFERENCIA']);
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
        Schema::dropIfExists('remisiones');
    }
};
