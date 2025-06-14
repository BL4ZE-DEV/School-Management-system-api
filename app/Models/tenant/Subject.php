<?php

namespace App\Models\tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    /** @use HasFactory<\Database\Factories\SubjectFactory> */
    use HasFactory;

    protected $connection ='tenants';

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'students_subjects', 'subject_id', 'student_id');
    }

    public function scores(): HasMany
    {
        return $this->hasMany(Score::class,'subject_id');
    }

    public function classSubjectTeachers() :HasMany
    {
        return $this->hasMany(ClassSubjectTeacher::class, 'subject_id');
    }

    public function schoolClass() :BelongsToMany
    {
        return $this->belongsToMany(SchoolClass::class, 'class_subject_teacher', 'subject_id', 'class_id');
    }

    public function teachers() :BelongsToMany
    {
        return $this->belongsToMany(Staff::class, 'class_subject_teacher', 'subject_id', 'teacher_id');
    }


}
