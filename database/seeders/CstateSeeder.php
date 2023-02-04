<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CstateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cstates')->insert([
            'value' => 'Activo',
        ]);
        DB::table('cstates')->insert([
            'value' => 'Inactivo',
        ]);
        DB::table('cstates')->insert([
            'value' => 'Anulado',
        ]);
        DB::table('cstates')->insert([
            'value' => 'Vencido',
        ]);
        DB::table('cstates')->insert([
            'value' => 'Cancelado',
        ]);
        DB::table('cstates')->insert([
            'value' => 'Pendiente',
        ]);
    }
}
