<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionTime extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'session_time' => 'date:h:i A',
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sessionDate(): BelongsTo
    {
        return $this->belongsTo(SessionDate::class);
    }
}
