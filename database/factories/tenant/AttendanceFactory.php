<?php

namespace Database\Factories\tenant;

use App\Models\tenant\SchoolClass;
use App\Models\tenant\Staff;
use App\Models\tenant\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'school_class_id' => SchoolClass::factory(),
            'date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['Present', 'Absent']),
            'marked_by' => Staff::factory()
        ];
    }
}
