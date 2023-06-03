<?php

namespace Database\Factories;

use App\Models\Receptionist;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ReceptionistFactory extends Factory
{
    protected $model = Receptionist::class;

    public function definition()
    {
        return [
            'names' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'password' => bcrypt('password'), // Change this to generate secure passwords
        ];
    }
}
