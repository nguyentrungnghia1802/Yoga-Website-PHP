<?php
namespace Database\Factories;

use App\Enums\RegistrationStatus;
use App\Models\Customer;
use App\Models\Clazz;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegistrationFactory extends Factory
{
    public function definition(): array {
        $months   = $this->faker->randomElement([1,3,6,12]);
        $discount = [1=>0,3=>5,6=>10,12=>20][$months];

        return [
            'package_months' => $months,
            'discount'       => $discount,
            'final_price'    => 0,
            'status'         => $this->faker->randomElement([
                RegistrationStatus::PENDING->value,
                RegistrationStatus::CONFIRMED->value,
            ]),
            'note'           => $this->faker->optional()->sentence(6),
        ];
    }
}
