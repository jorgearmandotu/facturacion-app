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
        Schema::table('shopping_invoices', function (Blueprint $table) {
            $table->foreignId('user_id')->references('id')->on('users')->after('date_upload');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shopping_invoices', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
};
