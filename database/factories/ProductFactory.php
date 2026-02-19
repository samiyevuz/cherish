<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    private static array $brands = [
        'Nike', 'Adidas', 'Puma', 'New Balance', 'Reebok', 'Converse',
        'Vans', 'Jordan', 'Asics', 'Saucony', 'Brooks', 'Salomon',
    ];

    private static array $models = [
        'Air Max 270', 'Ultra Boost', 'RS-X', '990v5', 'Classic Leather',
        'Chuck 70', 'Old Skool', 'Retro 1', 'Gel-Nimbus', 'Kinvara 12',
        'Ghost 14', 'Speedcross 5', 'Air Force 1', 'Stan Smith', 'Suede Classic',
        'Fresh Foam', 'Club C', 'Platform', 'Air Jordan 1', 'Yeezy 350',
    ];

    public function definition(): array
    {
        $brand = $this->faker->randomElement(self::$brands);
        $model = $this->faker->randomElement(self::$models);
        $name  = "$brand $model";
        $price = $this->faker->numberBetween(150, 850) * 1000;
        $isSale = $this->faker->boolean(30);

        return [
            'category_id' => Category::inRandomOrder()->first()?->id ?? 1,
            'name'        => $name,
            'slug'        => Str::slug($name) . '-' . $this->faker->unique()->numberBetween(1, 9999),
            'description' => $this->faker->paragraphs(3, true),
            'price'       => $price,
            'sale_price'  => $isSale ? round($price * 0.8 / 1000) * 1000 : null,
            'is_new'      => $this->faker->boolean(40),
            'is_featured' => $this->faker->boolean(30),
        ];
    }
}
