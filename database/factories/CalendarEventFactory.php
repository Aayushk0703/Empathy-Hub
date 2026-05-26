<?php

namespace Database\Factories;

use App\Models\CalendarEvent;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalendarEventFactory extends Factory
{
    protected $model = CalendarEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start = $this->faker->dateTimeBetween('-1 month', '+2 months');
        $allDay = $this->faker->boolean(20);
        return [
            'title' => $this->faker->randomElement([
                'Orientation Program',
                'Mid Semester Exams',
                'Admissions Counselling',
                'Placement Drive',
                'Annual Tech Fest',
            ]),
            'description' => $this->faker->sentence(14),
            'start_at' => $start,
            'end_at' => $allDay ? null : (clone $start)->modify('+2 hours'),
            'is_all_day' => $allDay,
            'location' => $this->faker->randomElement(['Main Hall', 'Block A', 'Lab 2', 'Auditorium']),
            'event_type' => $this->faker->randomElement(['general', 'exam', 'admission', 'holiday']),
            'created_by' => User::factory(),
        ];
    }
}
