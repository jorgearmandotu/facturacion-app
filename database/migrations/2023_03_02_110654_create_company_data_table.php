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
        Schema::create('company_data', function (Blueprint $table) {
            $table->id();
            $table->string('name_view', 50);
            $table->string('razon_social', 50);
            $table->string('dni', 50);
            $table->string('address', 50);
            $table->string('phone', 50);
            $table->string('email', 70);
            $table->string('regimen', 20);
            $table->string('actividad_economica', 50);
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
        Schema::dropIfExists('company_data');
    }
};
