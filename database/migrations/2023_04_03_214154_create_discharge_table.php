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
        Schema::create('discharges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tercero_id')->references('id')->on('terceros');
            $table->foreignId('category_discharge')->references('id')->on('categories_discharges');
            $table->string('description', 250);
            $table->date('date');
            $table->decimal('mount', 10, 2);
            $table->text('payment_method', 50);
            $table->foreignId('shopping_invoice_id')->nullable()->constrained('shopping_invoices' ,'id');
            $table->foreignId('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('discharge');
    }
};
