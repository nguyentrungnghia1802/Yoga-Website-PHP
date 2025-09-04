<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    public function definition(): array {
        return [
            'name'      => $this->faker->name(),
            'phone'     => $this->faker->unique()->numerify('09########'),
            'email'     => $this->faker->unique()->safeEmail(),
            'birthday'  => $this->faker->date('Y-m-d','2007-12-31'),
            'gender' => $this->faker->randomElement(['male','female','other']),
            'address'   => $this->faker->address(),
            'note'      => $this->faker->optional()->sentence(8),
        ];
    }
}
