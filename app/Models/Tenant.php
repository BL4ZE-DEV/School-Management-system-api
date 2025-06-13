<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tenant extends Model
{
    /** @use HasFactory<\Database\Factories\TenantsFactory> */
    use HasFactory;

    protected $connection = 'central';
    
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manger_id', 'user_id');
    }

}
