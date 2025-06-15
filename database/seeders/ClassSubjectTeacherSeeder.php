<?php

namespace Database\Seeders;

use App\Models\tenant\ClassSubjectTeacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSubjectTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassSubjectTeacher::factory()
                            ->count(10)
                            ->create();
    }
}
