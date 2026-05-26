<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->words(2, true);
        return [
            'name' => ucwords($name),
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence(18),
            'price' => $this->faker->randomFloat(2, 100, 25000),
            'currency' => 'INR',
            'stock' => $this->faker->numberBetween(0, 500),
            'sku' => strtoupper(Str::random(8)),
            'is_active' => $this->faker->boolean(85),
            'media_id' => null,
        ];
    }
}
