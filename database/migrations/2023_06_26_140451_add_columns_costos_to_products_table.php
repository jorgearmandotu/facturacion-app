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
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('costo_fijo', 10, 2)->default(0)->after('costo');
            $table->decimal('costo_promedio', 10, 2)->default(0)->after('costo');
            $table->enum('select_costo', ['ultimo_costo', 'costo_promedio', 'costo_fijo'])->default('ultimo_costo')->after('costo_fijo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('costo_promedio');
            $table->dropColumn('costo_fijo');
            $table->dropColumn('select_costo');
        });
    }
};
