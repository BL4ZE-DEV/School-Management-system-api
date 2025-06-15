<?php

namespace Database\Factories\tenant;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject_code'=> $this->faker->unique()->bothify('SUB-####'),
            'name'=> $this->faker->word,
            'type' => $this->faker->randomElement(['Core', 'Elective'])
        ];
    }
}
