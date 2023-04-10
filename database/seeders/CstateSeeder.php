<?php

namespace Database\Seeders;

use App\Models\Cstate;
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
        $activo = Cstate::create([
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
        DB::table('cstates')->insert([
            'value' => 'Finalizado',
        ]);
        DB::table('cstates')->insert([
            'value' => 'Aprobado',
        ]);
        DB::table('cpayment_methods')->insert([
            'value' => 'Efectivo',
            'cstate_id' => $activo->id,
        ]);
        DB::table('cpayment_methods')->insert([
            'value' => 'Tarjeta',
            'cstate_id' => $activo->id,
        ]);
        DB::table('cpayment_methods')->insert([
            'value' => 'Transferencia',
            'cstate_id' => $activo->id,
        ]);
        DB::table('categories_discharges')->insert([
            'name' => 'GASTOS VARIOS',
            'cstate_id' => $activo->id,
        ]);
    }
}
