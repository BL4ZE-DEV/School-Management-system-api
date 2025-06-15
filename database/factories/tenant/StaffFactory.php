<?php

namespace Database\Factories\tenant;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'staff_id' => (string)Str::uuid(),
            'first_name' => $this->faker->firstName,
            'last_name'=>$this->faker->lastName,
            'email'=>$this->faker->email,
            'gender'=>$this->faker->randomElement(['Male', 'Female']),
            'role'=>$this->faker->randomElement(['Teacher', 'Admin', 'Non_Academic'])
        ];
    }
}
