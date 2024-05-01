<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KindController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return 'ping';
// });

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/home', [KindController::class, 'home']);

    Route::prefix('/pizzas')->group(function () {
        Route::get('/category/{id}', [PizzaController::class, 'index']);
        Route::post('/create', [PizzaController::class, 'store'])->middleware('ability:Admin,Employee');
    });
});
