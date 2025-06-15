<?php

namespace Database\Factories\tenant;

use App\Models\tenant\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SchoolClass>
 */
class SchoolClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'class_names'=>$this->faker->randomElement(['JSS1','JSS2','JSS3','SS1','SS2','SS3']),
            'class_teacher_id'=>Staff::factory()
        ];
    }
}
