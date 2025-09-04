<?php
namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClazzFactory extends Factory
{
    public function definition(): array {
        $start = $this->faker->dateTimeBetween('now','+1 month');
        $end   = (clone $start)->modify('+2 months');

        return [
            'teacher_id' => Teacher::factory(),
            'name'       => 'Yoga ' . $this->faker->randomElement(['Beginner','Flow','HIIT','Balance']),
            'lich_hoc'   => $this->faker->randomElement(['Mon-Wed-Fri','Tue-Thu','Sat-Sun']),
            'start_time' => '07:00',
            'end_time'   => '08:00',
            'start_date' => $start->format('Y-m-d'),
            'end_date'   => $end->format('Y-m-d'),
            'quantity'   => $this->faker->numberBetween(10,30),
            'price'      => $this->faker->randomFloat(2, 200000, 800000),
            'location'   => $this->faker->city(),
            'description'=> $this->faker->sentence(12),
        ];
    }
}
