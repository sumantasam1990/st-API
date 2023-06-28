<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\SessionTimeController;
use App\Http\Controllers\TeacherController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

Route::middleware(['auth:sanctum'])->prefix('v2')->group(function () {

    Route::get('/index', [AppointmentController::class, 'index']);

    Route::get('teachers', [TeacherController::class, 'index']);

    Route::prefix('appointment')->group(function() {
        Route::get('teacher/available/dates/{user}', [TeacherController::class, 'getTeacherAppointmentDate']);
        Route::get('teacher/available/times/{sessionDate:id}', [SessionTimeController::class, 'getTeacherAppointmentTime']);

        Route::post('save/date', [AppointmentController::class, 'save_date']);

        Route::post('book', [AppointmentController::class, 'book']);

    });

    Route::get('test', function () {
        return \Illuminate\Support\Facades\Auth::user()->profile->user_type;
    });




});



Route::prefix('v1')->group(function () {

    //Route::post('register', [PassportAuthController::class, 'register']);

    Route::post('/sanctum/token', function (Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['err' => 'Please check your email or password.'], 401);
        }

        return response()->json(['token' => $user->createToken($request->email.uniqid())->plainTextToken], 200);
    });



});

Route::get('/', function () {
    return 'st-API';
});

//Route::get('teachers', [TeacherController::class, 'index']);
//Route::get('sessions/{uid}', [AppointmentController::class, 'appointments']);
//
//Route::get('test/name/{name}', [AppointmentController::class, 'getTestName']);
//Route::get('test/age/{age}', [AppointmentController::class, 'getTestAge']);


