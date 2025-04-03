<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HabitLog extends Model
{
    use HasFactory;

    public function habit(): BelongsTo
    {
        return $this->belongsTo(Habit::class);
    }
}
