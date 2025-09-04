<?php

namespace Database\Seeders;

use App\Enums\RegistrationStatus;
use App\Models\Clazz;
use App\Models\Customer;
use App\Models\Registration;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['user_name' => 'admin'],
            ['password' => Hash::make('123456')]
        );
        $this->command->info('> Seeded admin user');

        $teachers = Teacher::factory()->count(5)->create();
        $this->command->info('> Teachers: '.Teacher::count());

        $classes = Clazz::factory()->count(8)->create();
        foreach ($classes as $c) {
            $c->update(['teacher_id' => $teachers->random()->id]);
        }
        $this->command->info('> Classes: '.Clazz::count());

        $customers = Customer::factory()->count(30)->create();
        $this->command->info('> Customers: '.Customer::count());

        foreach ($customers as $cust) {
            $n = rand(0, 2);
            for ($i = 0; $i < $n; $i++) {
                $cls    = $classes->random();
                $months = [1,3,6,12][array_rand([1,3,6,12])];
                $disc   = [1=>0,3=>5,6=>10,12=>20][$months];
                $final  = $cls->price * $months * (1 - $disc/100);

                Registration::create([
                    'customer_id'    => $cust->id,
                    'class_id'       => $cls->id,
                    'package_months' => $months,
                    'discount'       => $disc,
                    'final_price'    => $final,
                    'status'         => method_exists(\App\Enums\RegistrationStatus::class,'cases')
                        ? RegistrationStatus::PENDING->value
                        : 'PENDING',
                    'note'           => null,
                ]);
            }
        }
        $this->command->info('> Registrations: '.Registration::count());
        $this->command->info('> Seeding done!');
    }
}
