<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesNotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //'Entrada-Devolución','Entrada-Ajuste', 'Salida-devolución', 'Salida-Ajuste', 'Salida-Merma'
        DB::table('ctypes_notes')->insert([
            'name' => 'Entrada - Devolución',
            'action' => 'entrada',
            'description' => 'Notas de entrada por devoluciones',
        ]);
        DB::table('ctypes_notes')->insert([
            'name' => 'Entrada - Ajustes',
            'action' => 'entrada',
            'description' => 'Notas de entrada por ajuste de inventario',
        ]);
        DB::table('ctypes_notes')->insert([
            'name' => 'Salida - Devolución',
            'action' => 'salida',
            'description' => 'Notas de salida por devoluciones',
        ]);
        DB::table('ctypes_notes')->insert([
            'name' => 'Salida - Ajuste',
            'action' => 'salida',
            'description' => 'Notas de salida por Ajuste de inventario',
        ]);
        DB::table('ctypes_notes')->insert([
            'name' => 'Salida - Merma',
            'action' => 'salida',
            'description' => 'Notas de salida por Mermas',
        ]);
    }
}
