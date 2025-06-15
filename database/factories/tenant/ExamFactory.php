<?php

namespace Database\Factories\tenant;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exams>
 */
class ExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'First Term Midterm',
                'First Term Exam',
                'Second Term Midterm',
                'Second Term Exam',
                'Third Term Midterm',
                'Third Term Exam',
            ]),
            'session' => $this->faker->numerify('20##/20##'),
            'term'=> $this->faker->randomElement(['FirstTerm','SecondTerm', 'ThirdTerm']),
            'start_date' => $this->faker->dateTimeThisYear(),
            'end_date'   => $this->faker->dateTimeThisYear('+6 months'),
        ];
    }
}
