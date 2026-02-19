<?php

namespace Database\Factories;

use App\Models\ProductSize;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductSizeFactory extends Factory
{
    protected $model = ProductSize::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::inRandomOrder()->first()?->id ?? 1,
            'size'       => $this->faker->randomElement(['36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46']),
            'stock'      => $this->faker->numberBetween(0, 30),
        ];
    }
}
