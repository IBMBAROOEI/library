<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;

Route::resource('books', BookController::class);
// Route::resource('user', AuthController::class);
Route::get('/resource/user', [AuthController::class, 'register']);
