<?php

namespace Database\Factories;

use App\Models\order;
use App\Models\orderProducts;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<orderProducts>
 */
class OrderProductsFactory extends Factory
{
    protected $model = orderProducts::class;

    public function definition(): array
    {
        return [
            'order_id' => order::factory(),
            'product_id' => Product::factory(),
            'quantity' => $this->faker->numberBetween(1, 10),
        ];
    }
}