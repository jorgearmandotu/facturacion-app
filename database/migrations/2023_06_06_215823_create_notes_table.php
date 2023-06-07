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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type')->references('id')->on('ctypes_notes');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->foreignId('location_id')->references('id')->on('locations');
            $table->integer('quantity')->default(0);
            $table->text('description', '250');
            $table->decimal('costo');
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
        Schema::dropIfExists('notes');
    }
};
