<?php

namespace App\Models\tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Staff extends Model
{
    /** @use HasFactory<\Database\Factories\StaffFactory> */
    use HasFactory;

    protected $connection ='tenants';

    public function attendance() : HasMany
    {
        return $this->hasMany(Attendance::class, 'marked_by');
    }

    public function schoolClass(): HasOne
    {
        return $this->hasOne(SchoolClass::class,'class_teacher_id');
    }

    public function classSubjectTeachers() :HasMany
    {
        return $this->hasMany(ClassSubjectTeacher::class, 'teacher_id');
    }

    public function subjects() :BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'class_subject_teacher', 'teacher_id', 'subject_id');
    }

    public function classes() :BelongsToMany
    {
        return $this->belongsToMany(SchoolClass::class, 'class_subject_teacher', 'teacher_id', 'class_id');
    }


}
