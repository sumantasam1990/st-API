<?php

namespace App\Http\Traits;

use App\Http\Resources\AppointmentsCollection;
use App\Models\User;
use Illuminate\Http\JsonResponse;

trait AppointmentTrait
{
    public function appointments(int $uid): AppointmentsCollection|JsonResponse
    {
        try {
            $query = User::query();

            $query->with(['sessionDates.sessionTimes']);

            $query->where('id', $uid);

            $data = $query->get();

            return new AppointmentsCollection($data);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'error',
                'data' => $th->getMessage(),
            ], 500);
        }
    }
}
