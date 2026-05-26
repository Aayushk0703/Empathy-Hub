<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = $this->faker->randomElement(['pending', 'paid', 'failed', 'refunded']);
        return [
            'user_id' => User::factory(),
            'product_id' => Product::factory(),
            'amount' => $this->faker->randomFloat(2, 100, 20000),
            'currency' => 'INR',
            'provider' => $this->faker->randomElement(['razorpay', 'stripe', 'cash']),
            'reference' => strtoupper(Str::random(12)),
            'status' => $status,
            'paid_at' => $status === 'paid' ? $this->faker->dateTimeBetween('-2 months', 'now') : null,
            'meta' => ['source' => 'seeder'],
        ];
    }
}
