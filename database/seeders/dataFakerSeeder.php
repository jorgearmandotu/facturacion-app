<?php

namespace Database\Seeders;

use App\Models\Clients;
use App\Models\CompanyData;
use App\Models\Group;
use App\Models\Line;
use App\Models\ListPrices;
use App\Models\LocationProduct;
use App\Models\Product;
use App\Models\ProductsMovements;
use App\Models\ProductsTaxes;
use App\Models\Resolution;
use App\Models\Tercero;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\productFactory;

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
        $product1 = Product::create(['name'=>'DEPORTIVO PASTO 2022', 'group_id' => $grupo1->id, 'code' => '1', 'costo' => 35000, 'profit' => '0', 'cstate_id' => 1, 'date' => Carbon::now()->format('Y-m-d')]);
        $product2 = Product::create(['name'=>'RODILLERA', 'group_id' => $grupo2->id, 'code' => '2', 'costo' => 15000, 'profit' => '0', 'cstate_id' => 1, 'date' => Carbon::now()->format('Y-m-d')]);
        $product3 = Product::create(['name'=>'CHAQUETA DOBLE ALA', 'group_id' => $grupo3->id, 'code' => '3', 'costo' => 85000, 'profit' => '0', 'cstate_id' => 1, 'date' => Carbon::now()->format('Y-m-d')]);

        //crear lista de precios
        $price1 = ListPrices::create(['product_id' => $product1->id, 'name' => 'precio 1', 'price' => 35000 ]);
        $price4 = ListPrices::create(['product_id' => $product1->id, 'name' => 'precio 2', 'price' => 40000 ]);
        $price5 = ListPrices::create(['product_id' => $product1->id, 'name' => 'precio 3', 'price' => 45000 ]);
        $price2 = ListPrices::create(['product_id' => $product2->id, 'name' => 'precio 1', 'price' => 15000 ]);
        $price3 = ListPrices::create(['product_id' => $product3->id, 'name' => 'precio 1', 'price' => 85000 ]);

        //TAXES-PRODUCTOS
        $product_tax1 = ProductsTaxes::create(['product_id' => $product1->id, 'tax_id' => 1]);
        $product_tax2 = ProductsTaxes::create(['product_id' => $product2->id, 'tax_id' => 2]);
        $product_tax3 = ProductsTaxes::create(['product_id' => $product3->id, 'tax_id' => 3]);

        //locations_products
        $locationProduct1 = LocationProduct::create(['location_id' => 1, 'product_id' => $product1->id, 'stock' => 10]);
        $locationProduct2 = LocationProduct::create(['location_id' => 2, 'product_id' => $product2->id, 'stock' => 20]);
        $locationProduct3 = LocationProduct::create(['location_id' => 1, 'product_id' => $product3->id, 'stock' => 30]);

        //movimiento de products
        $productMovement = ProductsMovements::create(['type' => 'Creacion', 'quantity' => 10, 'saldo' => 10, 'location_id' => 1, 'product_id' => $product1->id]);
        $productMovement = ProductsMovements::create(['type' => 'Creacion', 'quantity' => 20, 'saldo' => 20, 'location_id' => 2, 'product_id' => $product2->id]);
        $productMovement = ProductsMovements::create(['type' => 'Creacion', 'quantity' => 30, 'saldo' => 30, 'location_id' => 1, 'product_id' => $product3->id]);

        //crear clientes
        $client1 = Tercero::create(['dni' => '111111111', 'document_type' => '1', 'name' => 'CLIENTES VARIOS']);
        $client1 = Tercero::create(['dni' => '1085284339', 'document_type' => '1', 'name' => 'Jorge Armando Urbina', 'phone' => '3148516572', 'address' => 'calle 14  #17-40', 'email' => 'jorgearmandou@gmail.com']);

        //crear datos de resolucion
        $resolution = Resolution::create([
            'number'=> '18764024704502',
            'date_resolution' => '2023-01-29',
            'expiration_date' => '2024-01-29',
            'validity' => '24 meses',
            'prefijo' => 'FP',
            'initial_number' => '1',
            'final_number' => '1000',]);

        //crear datos de compania
        $dataCompany = CompanyData ::create([
            'name_view' => 'Aetius',
            'razon_social' => 'La casa del estampado',
            'dni' => '9.547.458-3',
            'address' => 'calle 16 #23-15',
            'phone' => '315 8465 247',
            'regimen' => 'simplificado',
            'actividad_economica' => '04753',
        ]);

        //invoco a fabrica de productos
        // product::factory(1000)->create();
    }
}
