<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    public function sessionDates(): HasMany
    {
        return $this->hasMany(SessionDate::class, 'teacher_id', 'id');
    }

    public function sessionTimes(): HasMany
    {
        return $this->hasMany(SessionTime::class);
    }

    public function purchaseSessionsUser(): HasMany
    {
        return $this->hasMany(PurchaseSession::class);
    }

    public function purchaseSessionsTeacher(): HasMany
    {
        return $this->hasMany(PurchaseSession::class);
    }

    public function scopeGetTeachersProfile($query)
    {
        return $query->with(['profile'])->whereHas('profile', function ($q) {
            $q->where('user_type', UserProfile::USER_TYPE_TEACHER);
            $q->select('user_id', 'dob', 'gender', 'user_type');
        });
    }
}
