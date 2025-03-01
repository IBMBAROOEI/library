<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\Ratelimit;


// Route::middleware([AuthMiddleware
// ::class])->group(function(){
Route::resource('books', BookController::class);

// });

Route::middleware([Ratelimit::class])->group(function(){

Route::post('/user/register', [AuthController::class, 'register']);
Route::post('/user/login', [AuthController::class, 'login']);

});
