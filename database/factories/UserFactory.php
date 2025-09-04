<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_name' => $this->faker->unique()->userName(),
            'password'  => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
