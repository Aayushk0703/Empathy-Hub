<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->words(3, true);
        return [
            'title' => ucwords($title),
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraph(),
            'icon' => $this->faker->randomElement(['fas fa-book', 'fas fa-flask', 'fas fa-laptop-code', 'fas fa-user-graduate']),
            'is_active' => $this->faker->boolean(90),
            'sort_order' => $this->faker->numberBetween(0, 20),
        ];
    }
}
