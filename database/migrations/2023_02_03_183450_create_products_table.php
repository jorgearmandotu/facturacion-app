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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('line_id')->references('id')->on('lines');
            $table->foreignId('group_id')->references('id')->on('groups');
            $table->string('code', 20);
            $table->string('name', 20);
            $table->string('bar_code', 20);
            $table->string('reference', 20);
            $table->decimal('costo')->default(0);
            $table->decimal('price')->default(0);
            $table->foreignId('cstate_id')->references('id')->on('cstates');
            $table->date('date');
            //ubicaciones bodegas
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
        Schema::dropIfExists('products');
    }
};
