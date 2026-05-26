<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->sentence(5);
        $status = $this->faker->randomElement(['draft', 'published', 'published', 'archived']);
        return [
            'user_id' => User::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->sentence(12),
            'body' => $this->faker->paragraphs(4, true),
            'status' => $status,
            'published_at' => $status === 'published' ? $this->faker->dateTimeBetween('-3 months', 'now') : null,
            'featured_media_id' => null,
        ];
    }
}
