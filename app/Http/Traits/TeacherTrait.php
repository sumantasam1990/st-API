<?php

namespace App\Http\Traits;

use App\Http\Resources\AllTeachersCollection;
use App\Models\User;
use Illuminate\Http\JsonResponse;

trait TeacherTrait
{
    public function index(): AllTeachersCollection|JsonResponse
    {
        try {
            $query = User::query();

            $query->getTeachersProfile();

            $data = $query->cursorPaginate(10);

            return new AllTeachersCollection($data);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'error',
                'data' => $th->getMessage(),
            ], 500);
        }
    }
}
