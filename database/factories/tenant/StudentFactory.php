<?php

namespace Database\Factories\tenant;

use App\Models\tenant\SchoolClass;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'student_id'    => (string)Str::uuid(), 
        'first_name'    => $this->faker->firstName,
        'last_name'     => $this->faker->lastName,
        'gender'        => $this->faker->randomElement(['Male', 'Female']),
        'date_of_birth' => $this->faker->date('Y-m-d', '-10 years'),
        'admission_no'  => 'ADM-' . $this->faker->unique()->numberBetween(1000, 9999),
        'admission_date'=> $this->faker->date(now()),
        'school_class_id' => SchoolClass::factory()
        ];
    }
}
