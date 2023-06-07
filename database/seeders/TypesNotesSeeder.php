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
            'description' => 'Notas de entrada por devoluciones',
        ]);
        DB::table('ctypes_notes')->insert([
            'name' => 'Entrada - Ajustes',
            'description' => 'Notas de entrada por ajuste de inventario',
        ]);
        DB::table('ctypes_notes')->insert([
            'name' => 'Salida - Devolución',
            'description' => 'Notas de salida por devoluciones',
        ]);
        DB::table('ctypes_notes')->insert([
            'name' => 'Salida - Ajuste',
            'description' => 'Notas de salida por Ajuste de inventario',
        ]);
        DB::table('ctypes_notes')->insert([
            'name' => 'Salida - Merma',
            'description' => 'Notas de salida por Mermas',
        ]);
    }
}
