<?php

namespace App\Http\Resources;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AllTeachersCollection extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
                'teacher_id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'profile' => [
                    'dob' => $this->profile->dob,
                    'gender' => $this->profile->gender === UserProfile::GENDER_MALE ? 'Male' : 'Female',
                    'user_type' => $this->profile->user_type === UserProfile::USER_TYPE_TEACHER ? 'Teacher' : '',
                ],
        ];
    }
}
