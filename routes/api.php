<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/register', [AuthController::class, 'register_user']);
Route::post('/auth/login', [AuthController::class, 'login_user']);
?>
