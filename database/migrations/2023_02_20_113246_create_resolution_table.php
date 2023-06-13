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
        Schema::create('resolutions', function (Blueprint $table) {
            $table->id();
            $table->string('number', 50)->default('');
            $table->date('date_resolution')->nullable();
            $table->date('expiration_date')->nullable();
            $table->string('validity')->default('');
            $table->string('prefijo', 5)->default('');
            $table->integer('initial_number');
            $table->integer('final_number');
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
        Schema::dropIfExists('resolutions');
    }
};
