<?php

use App\Http\Controllers\Actions\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/update-profile', [AuthController::class, 'updateProfile']);
Route::post('auth/update-password', [AuthController::class, 'updatePassword']);
