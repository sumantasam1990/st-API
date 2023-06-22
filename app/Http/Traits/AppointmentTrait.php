<?php

namespace App\Http\Traits;

use App\Http\Resources\AppointmentsCollection;
use App\Models\PurchaseSession;
use App\Models\User;
use http\Client\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Throwable;

trait AppointmentTrait
{
    /**
     * Get the appointments for a specific user.
     *
     * @param int $uid The ID of the teacher.
     *
     * @return AppointmentsCollection|JsonResponse Returns a collection of appointments or a JSON response.
     */
    public function appointments(int $uid): AppointmentsCollection|JsonResponse
    {
        try {
            // Create a query to fetch the user's data
            $query = User::query();

            // Eager load the relationships for session dates and times
            $query->with(['sessionDates.sessionTimes']);

            // Filter the query to find the user by ID
            $query->where('id', $uid);

            // Execute the query and retrieve the data
            $data = $query->get();

            // Return a collection of appointments using the retrieved data
            return new AppointmentsCollection($data);
        } catch (Throwable $th) {
            // Handle any exceptions or errors that occur
            return response()->json([
                'message' => 'Error',
                'data' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Save/store book appointment data
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function book(\Illuminate\Http\Request $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $book = new PurchaseSession;
            $book->user_id = $request->input('user_id');
            $book->teacher_id = $request->input('teacher_id');
            $book->session_date_id = $request->input('sess_date');
            $book->session_time_id = $request->input('sess_time');
            $book->save();

            DB::commit();

            return $this->apiResponse(
                [],
                'Your appointment has been pending and going for approval.',
                'success',
                201,
            );

        } catch (\Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollback();

            // Handle the exception or return an error response
            return $this->apiResponse(
                [],
                'Error! Something is wrong. Please try again later.'.$e->getMessage(),
                'error',
                500,
            );
        }
    }
}
