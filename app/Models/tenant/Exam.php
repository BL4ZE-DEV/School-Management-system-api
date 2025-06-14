<?php

namespace App\Models\tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exam extends Model
{
    /** @use HasFactory<\Database\Factories\ExamsFactory> */
    use HasFactory;

    protected $connection ='tenants';

    public function scores(): HasMany
    {
        return $this->hasMany(Score::class, 'exam_id');
    }

}
