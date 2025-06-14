<?php

namespace App\Models\tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolClass extends Model
{
    /** @use HasFactory<\Database\Factories\SchoolClassFactory> */
    use HasFactory;
    
    protected $connection ='tenants';

    Public function students():HasMany
    {
        return $this->hasMany(Student::class,'School_class_id','id');
    }


    public function scores(): HasMany
    {
        return $this->hasMany(Score::class, 'School_class_id');
    }


    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class, 'School_class_id');
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    public function classSubjectTeachers() :HasMany
    {
        return $this->hasMany(ClassSubjectTeacher::class, 'class_id');
    }

    public function subjects() :BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'class_subject_teacher', 'class_id', 'subject_id');
    }



}
