<?php

namespace App\Http\Traits;

use App\Http\Resources\AllTeachersCollection;
use App\Models\SessionDate;
use App\Models\SessionTime;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Modules\Appointment\Transformers\SessionTimeResource;

trait TeacherTrait
{
    /**
     * Get all teachers list
     *
     * @return JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        try {
            $query = User::query()
                ->getTeachersProfile()
                ->select('users.id', 'users.name', 'users..email')
                ->cursorPaginate(10);

            return AllTeachersCollection::collection($query);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'error',
                'data' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Get available appointment dates for a teacher
     *
     * @param User $user The teacher user
     * @return JsonResponse
     */
    public function getTeacherAppointmentDate(User $user): JsonResponse
    {
        $user->load(['sessionDates' => function ($query) {
            $query->orderByDesc('id');
        }]);

        return $this->apiResponse(
            $user,
            'Success',
            200,
        );
    }

    /**
     * Get available appointment dates for a teacher
     *
     * @param SessionDate $sessionDate
     * @return JsonResponse
     */
    public function getTeacherAppointmentTime(SessionDate $sessionDate): JsonResponse
    {
        $sessionDate->load('sessionTimes');

        return $this->apiResponse(
            $sessionDate,
            'success',
            200,
        );
    }
}
