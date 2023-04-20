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
        DB::table('cstates')->insert([
            'value' => 'Pagado',
        ]);
        DB::table('cstates')->insert([
            'value' => 'Pendiente por pagar',
        ]);


        DB::table('categories_discharges')->insert([
            'name' => 'FACTURAS DE COMPRA',
            'cstate_id' => $activo->id,
        ]);

        DB::table('cpayment_methods')->insert([
            'value' => 'EFECTIVO',
            'cstate_id' => $activo->id,
        ]);
        DB::table('cpayment_methods')->insert([
            'value' => 'TARJETA',
            'cstate_id' => $activo->id,
        ]);
        DB::table('cpayment_methods')->insert([
            'value' => 'TRANSFERENCIA',
            'cstate_id' => $activo->id,
        ]);
        DB::table('categories_discharges')->insert([
            'name' => 'GASTOS VARIOS',
            'cstate_id' => $activo->id,
        ]);
    }
}
