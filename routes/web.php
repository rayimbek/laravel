<?php

use App\Http\Controllers\AuthController;

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'login']);



