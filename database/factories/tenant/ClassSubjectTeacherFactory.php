<?php

namespace Database\Factories\tenant;

use App\Models\tenant\SchoolClass;
use App\Models\tenant\Staff;
use App\Models\tenant\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClassSubjectTeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'school_class_id' => SchoolClass::factory(),
            'subject_id'=> Subject::factory(),
            'teacher_id'=> Staff::factory()
        ];
    }
}
