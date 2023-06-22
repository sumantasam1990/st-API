<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const USER_TYPE_TEACHER = 0;

    public const USER_TYPE_STUDENT = 1;

    public const GENDER_MALE = 0;

    public const GENDER_FEMALE = 1;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
