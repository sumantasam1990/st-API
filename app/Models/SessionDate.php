<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Date;

class SessionDate extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'session_date' => 'date:jS F Y',
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sessionTimes(): HasMany
    {
        return $this->hasMany(SessionTime::class);
    }


}
