<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\RoomController;



Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
//Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/subjects', [SubjectController::class, 'store']);
    Route::get('/subjects/{id}', [SubjectController::class, 'show']);
    Route::get('/rooms/{roomId}/schedules', [TeacherController::class, 'getScheduleByRoom']);

    Route::post('/students', [StudentController::class, 'store']);
    Route::get('/students/{id}', [StudentController::class, 'show']);


    Route::post('/schedules', [ScheduleController::class, 'store']);
    Route::get('/schedules/{id}', [ScheduleController::class, 'show']);

    Route::post('/classes', [RoomController::class, 'store']);
    Route::get('/classes/{id}', [RoomController::class, 'show']);

});
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


Route::get('/classes', [TeacherController::class, 'getRooms']);
Route::get('/subjects', [TeacherController::class, 'getSubjects']);
Route::get('/get-all/students', [TeacherController::class, 'getAllStudents']);
Route::get('/classes/{roomId}/students', [TeacherController::class, 'getStudentsByClass']);

//Route::post('/subjects', [TeacherController::class, 'createSubject']);
//Route::post('/classes', [TeacherController::class, 'createRoom']);
//Route::post('/students', [TeacherController::class, 'createStudent']);

