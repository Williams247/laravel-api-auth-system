<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

# Unprotected routes
Route::post('/auth/register', [AuthController::class, 'register_user']);
Route::post('/auth/login', [AuthController::class, 'login_user']);

# Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/profile', [UserController::class, 'fetch_user']);
    Route::delete('/auth/logout', [AuthController::class, 'logout_user']);
});

?>
