<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsSeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([
            'name' => 'BODEGA',
            'cstate_id' => '1',
        ]);
        DB::table('locations')->insert([
            'name' => 'ALMACÉN',
            'cstate_id' => '1',
        ]);
    }
}
