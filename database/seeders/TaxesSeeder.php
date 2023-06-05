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
            'cstate_id' => '1',
        ]);
        DB::table('taxes')->insert([
            'name' => '5%',
            'value' => '5',
            'description' => 'Iva 5%',
            'cstate_id' => '1',
        ]);
        DB::table('taxes')->insert([
            'name' => '19%',
            'value' => '19',
            'description' => 'Iva 19%',
            'cstate_id' => '1',
        ]);
    }
}
