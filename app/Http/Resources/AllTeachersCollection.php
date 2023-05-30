<?php

namespace App\Http\Resources;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AllTeachersCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => 'success',
            'data' => $this->collection->transform(function ($user) {
                return [
                    'teacher_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'profile' => [
                        'dob' => $user->profile->dob,
                        'gender' => $user->profile->gender === UserProfile::GENDER_MALE ? 'Male' : 'Female',
                        'user_type' => $user->profile->user_type === UserProfile::USER_TYPE_TEACHER ? 'Teacher' : '',
                    ],
                ];
            }),
        ];
    }
}
