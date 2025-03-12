<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategorieController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\Ratelimit;


// Route::middleware([AuthMiddleware
// ::class])->group(function(){

Route::prefix('books')->group(function(){
Route::resource('books', BookController::class);
Route::post('/filter', [BookController::class, 'filterbook']);
 });



Route::resource('categorie', CategorieController::class);



Route::middleware([AuthMiddleware::class])->group(
    function () {
        Route::post('/user/profile', [AuthController::class, 'profile']);
    }
);

Route::middleware([Ratelimit::class])->prefix('user')->group(function(){

Route::post('/register', [AuthController::class, 'register']);


    Route::post('/login', [AuthController::class, 'login']);

});
