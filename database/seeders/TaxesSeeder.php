<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('taxes')->insert([
            'name' => 'Exento',
            'value' => '0',
            'description' => 'Exento Iva',
        ]);
        DB::table('taxes')->insert([
            'name' => '5%',
            'value' => '5',
            'description' => 'Iva 5%',
        ]);
        DB::table('taxes')->insert([
            'name' => '19%',
            'value' => '19',
            'description' => 'Iva 19%',
        ]);
    }
}
