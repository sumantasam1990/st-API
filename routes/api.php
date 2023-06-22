<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\SessionTimeController;
use App\Http\Controllers\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return 'st-API';
});

//Route::get('teachers', [TeacherController::class, 'index']);
//Route::get('sessions/{uid}', [AppointmentController::class, 'appointments']);
//
//Route::get('test/name/{name}', [AppointmentController::class, 'getTestName']);
//Route::get('test/age/{age}', [AppointmentController::class, 'getTestAge']);

Route::get('/index', [AppointmentController::class, 'index']);

Route::get('teachers', [TeacherController::class, 'index']);

Route::prefix('appointment')->group(function() {
    Route::get('teacher/available/dates/{user}', [TeacherController::class, 'getTeacherAppointmentDate']);
    Route::get('teacher/available/times/{sessionDate:id}', [SessionTimeController::class, 'getTeacherAppointmentTime']);

    Route::post('book', [AppointmentController::class, 'book']);
});
