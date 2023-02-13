<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        DB::statement('CREATE OR REPLACE VIEW products_list_view AS SELECT p.id AS id, p.name AS name, l.name AS line, g.name AS "group", p.code AS code, c.value AS state, reference , costo, price, profit from products p join `groups` g ON p.group_id = g.id join `lines` l on l.id = g.line_id join cstates c on p.cstate_id = c.id;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS products_list_view");
    }
};
