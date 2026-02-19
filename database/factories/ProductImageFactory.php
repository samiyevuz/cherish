<?php

namespace Database\Factories;

use App\Models\ProductImage;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImageFactory extends Factory
{
    protected $model = ProductImage::class;

    public function definition(): array
    {
        $seed = $this->faker->numberBetween(1, 500);
        return [
            'product_id' => Product::inRandomOrder()->first()?->id ?? 1,
            'image_path' => 'https://picsum.photos/seed/' . $seed . '/600/600',
            'is_primary'  => false,
        ];
    }
}
