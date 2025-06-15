<?php

namespace Database\Factories\tenant;

use App\Models\tenant\Exam;
use App\Models\tenant\SchoolClass;
use App\Models\tenant\Student;
use App\Models\tenant\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Scores>
 */
class ScoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'exam_id' => Exam::factory(),
            'student_id' => Student::factory(),
            'subject_id' => Subject::factory(),
            'school_class_id' => SchoolClass::factory(),
            'score' => $this->faker->numberBetween(0, 100)
        ];
    }
}
