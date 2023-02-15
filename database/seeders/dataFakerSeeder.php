<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Line;
use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class dataFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        //crear lineas
        $linea1 = Line ::create(['name' => $faker->word, 'cstate_id' => 1]);
        $linea2 = Line::create(['name' => $faker->word, 'cstate_id' => 1]);
        $linea3 = Line::create(['name' => $faker->word, 'cstate_id' => 1]);
        $linea4 = Line::create(['name' => $faker->word, 'cstate_id' => 1]);

        //crear grupos
        $grupo1 = Group::create(['name'=> $faker->word, 'cstate_id' => 1, 'line_id' => $linea1->id]);
        $grupo2 = Group::create(['name'=> $faker->word, 'cstate_id' => 1, 'line_id' => $linea1->id]);
        $grupo3 = Group::create(['name'=> $faker->word, 'cstate_id' => 1, 'line_id' => $linea2->id]);
        $grupo4 = Group::create(['name'=> $faker->word, 'cstate_id' => 1, 'line_id' => $linea2->id]);
        $grupo5 = Group::create(['name'=> $faker->word, 'cstate_id' => 1, 'line_id' => $linea3->id]);
        $grupo6 = Group::create(['name'=> $faker->word, 'cstate_id' => 1, 'line_id' => $linea3->id]);
        $grupo7 = Group::create(['name'=> $faker->word, 'cstate_id' => 1, 'line_id' => $linea4->id]);

        //crear productos
        //$product1 = Product::create(['name']);

    }
}
