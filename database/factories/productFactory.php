<?php

namespace Database\Factories;

use App\Models\Cstate;
use App\Models\Group;
use App\Models\ListPrices;
use App\Models\Location;
use App\Models\LocationProduct;
use App\Models\Product;
use App\Models\ProductsMovements;
use App\Models\ProductsTaxes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class productFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;
    protected static $code = 100;

    public function definition()
    {
        return [
            'group_id' => Group::inRandomOrder()->first()->id,//Group::factory(),
            'code' => static::$code++,
            'name' => $this->faker->sentence(2),
            //'bar_code',
            //'reference',
            'costo' => $this->faker->numberBetween(30000, 300000),
            'profit' => 0,
        //'price',
            'cstate_id' => 1,
            'date' => now()->format('Y-m-d'),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            $location = LocationProduct::create([
                'location_id' => Location::inRandomOrder()->first()->id,//Location::factory(),
                'product_id' => $product->id,
                'stock' => $this->faker->numberBetween(1, 100),
            ]);

            $movement = ProductsMovements::create([
                'type' => 'Creacion',
                'quantity' => 0,//$this->faker->numberBetween(1, 100),
                'saldo' => 0,
                //'document_type' => '',
                //'document_id',
                'location_id' => $location->location_id,
                'product_id' => $product->id,
            ]);

            ListPrices::create([
                'product_id' => $product->id,
                'name' => 'precio 1',
                'price' => $product->costo,
            ]);

            ProductsTaxes::create([
                'product_id' => $product->id,
                'tax_id' => 1,
            ]);

        });
    }
}
