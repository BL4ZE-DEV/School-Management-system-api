<?php

namespace App\Models\tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Termwind\Components\Hr;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;
    
    
    
        protected $connection ='tenants';

        public function subjects(): BelongsToMany
        {
            return $this->belongsToMany(Subject::class, 'students_subjects', 'student_id', 'subject_id');
        }

        public function schoolClass():BelongsTo
        {
            return $this->belongsTo(SchoolClass::class);
        }

        public function attendance(): HasMany
        {
            return $this->hasMany(Attendance::class, 'student_id');
        }

        public function scores(): HasMany
        {
            return $this->hasMany(Score::class, 'student_id');
        }
}
