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
        Schema::create('terceros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_type')->references('id')->on('document_types');
            $table->text('dni', 30)->unique();
            $table->text('name', 50);
            $table->text('phone', 12)->nullable();
            $table->text('address', 50)->nullable();
            $table->text('email', 50)->nullable();
            $table->boolean('supplier')->default(false);
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
        Schema::dropIfExists('terceros');
    }
};
