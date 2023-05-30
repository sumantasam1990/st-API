<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AppointmentsCollection extends ResourceCollection
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
                    'session_dates' => $user->sessionDates->map(function ($date) {
                        return [
                            'date' => $date->session_date,
                            'teacher_id' => $date->teacher_id,
                            'session_times' => $date->sessionTimes->map(function ($time) {
                                return [
                                    'session_date_id' => $time->session_date_id,
                                    'time' => $time->session_time,
                                ];
                            }),
                        ];
                    }),
                ];
            }),
        ];
    }
}
