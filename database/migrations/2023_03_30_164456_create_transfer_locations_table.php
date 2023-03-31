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
        Schema::create('transfer_locations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('number');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->foreignId('fromLocation')->references('id')->on('locations');
            $table->foreignId('toLocation')->references('id')->on('locations');
            $table->integer('quantity')->default(0);
            $table->foreignId('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('transfer_locations');
    }
};
