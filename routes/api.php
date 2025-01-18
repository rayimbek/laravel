<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;


Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
});


Route::get('/classes', [TeacherController::class, 'getRooms']);
Route::get('/students', [TeacherController::class, 'getAllStudents']);
Route::get('/classes/{roomId}/students', [TeacherController::class, 'getStudentsByClass']);

Route::post('/subjects', [TeacherController::class, 'createSubject']);
Route::post('/classes', [TeacherController::class, 'createRoom']);
Route::post('/students', [TeacherController::class, 'createStudent']);

