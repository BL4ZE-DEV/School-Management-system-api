<?php

namespace App\Models\tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    /** @use HasFactory<\Database\Factories\AttendanceFactory> */
    use HasFactory;


    protected $connection ='tenants';

    public function students():BelongsTo
    {
        return $this->belongsTo(Student::class);
    }


    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class);
    }
    

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

}
