<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Line;
use App\Models\LocationProduct;
use App\Models\Product;
use App\Models\ProductsTaxes;
use Carbon\Carbon;
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
        $linea1 = Line ::create(['name' => 'DEPORTIVA', 'cstate_id' => 1]);
        $linea2 = Line::create(['name' => 'CASUAL', 'cstate_id' => 1]);
        $linea3 = Line::create(['name' => 'ESTAMPADOS', 'cstate_id' => 1]);
        $linea4 = Line::create(['name' => 'BORDADOS', 'cstate_id' => 1]);

        //crear grupos
        $grupo1 = Group::create(['name'=> 'UNIFORMES', 'cstate_id' => 1, 'line_id' => $linea1->id]);
        $grupo2 = Group::create(['name'=> 'ACCESORIOS', 'cstate_id' => 1, 'line_id' => $linea1->id]);
        $grupo3 = Group::create(['name'=> 'CHAQUETAS', 'cstate_id' => 1, 'line_id' => $linea2->id]);
        $grupo4 = Group::create(['name'=> 'MOCHILAS', 'cstate_id' => 1, 'line_id' => $linea2->id]);
        $grupo5 = Group::create(['name'=> 'CAMISETAS', 'cstate_id' => 1, 'line_id' => $linea3->id]);
        $grupo6 = Group::create(['name'=> 'BUSOS', 'cstate_id' => 1, 'line_id' => $linea3->id]);
        $grupo7 = Group::create(['name'=> 'INSTITUCIONALES', 'cstate_id' => 1, 'line_id' => $linea4->id]);

        //crear productos
        $product1 = Product::create(['name'=>'DEPORTIVO PASTO 2022', 'group_id' => $grupo1->id, 'code' => '123', 'costo' => 35000, 'profit' => '0', 'price' => 35000, 'cstate_id' => 1, 'date' => Carbon::now()->format('Y-m-d')]);
        $product2 = Product::create(['name'=>'RODILLERA', 'group_id' => $grupo2->id, 'code' => '456', 'costo' => 15000, 'profit' => '0', 'price' => 15000, 'cstate_id' => 1, 'date' => Carbon::now()->format('Y-m-d')]);
        $product3 = Product::create(['name'=>'CHAQUETA DOBLE ALA', 'group_id' => $grupo3->id, 'code' => '123', 'costo' => 85000, 'profit' => '0', 'price' => 85000, 'cstate_id' => 1, 'date' => Carbon::now()->format('Y-m-d')]);

        //TAXES-PRODUCTOS
        $product_tax1 = ProductsTaxes::create(['product_id' => $product1->id, 'tax_id' => 1]);
        $product_tax2 = ProductsTaxes::create(['product_id' => $product2->id, 'tax_id' => 2]);
        $product_tax3 = ProductsTaxes::create(['product_id' => $product3->id, 'tax_id' => 3]);
        //locations_products

        $locationProduct1 = LocationProduct::create(['location_id' => 1, 'product_id' => $product1->id, 'stock' => 10]);
        $locationProduct2 = LocationProduct::create(['location_id' => 2, 'product_id' => $product2->id, 'stock' => 20]);
        $locationProduct3 = LocationProduct::create(['location_id' => 1, 'product_id' => $product3->id, 'stock' => 30]);
    }
}
