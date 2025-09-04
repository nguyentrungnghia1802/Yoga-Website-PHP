<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    public function definition(): array {
        return [
            'name'        => $this->faker->name(),
            'phone'       => $this->faker->unique()->numerify('08########'),
            'email'       => $this->faker->unique()->safeEmail(),
            'birthday'    => $this->faker->date('Y-m-d','1995-12-31'),
            'exp_year'    => $this->faker->numberBetween(1,15),
            'description' => $this->faker->sentence(10),
            'avatar'      => $this->faker->imageUrl(256,256,'people',true),
        ];
    }
}
