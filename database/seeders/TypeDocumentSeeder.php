<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('document_types')->insert([
            'name' => 'Cédula de ciudadania',
        ]);
        DB::table('document_types')->insert([
            'name' => 'Cédula de Extranjeria',
        ]);
        DB::table('document_types')->insert([
            'name' => 'NIT',
        ]);
    }
}
