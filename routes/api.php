<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KindController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\PizzaOrderController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\PizzaOrderMiddleware;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return 'ping';
// });

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/home', [KindController::class, 'index']);

    Route::prefix('/pizzas')->group(function () {
        Route::get('/category/{id}', [PizzaController::class, 'index']);
        Route::get('/{id}', [PizzaController::class, 'show']);
        Route::post('/', [PizzaController::class, 'store'])->middleware('ability:Admin,Employee');

        Route::middleware('ability:Admin')->group(function () {
            Route::put('/{id}', [PizzaController::class, 'update']);
            Route::delete('/{id}', [PizzaController::class, 'destroy']);
        });
    });

    Route::prefix('/kinds')->group(function () {
        Route::get('/', [KindController::class, 'index']);
        Route::post('/', [KindController::class, 'store'])->middleware('ability:Admin,Employee');

        Route::middleware('ability:Admin')->group(function () {
            Route::put('/{id}', [KindController::class, 'update']);
            Route::delete('/{id}', [KindController::class, 'destroy']);
        });
    });

    Route::prefix('/sizes')->group(function () {
        Route::get('/', [SizeController::class, 'index']);
        Route::get('/{id}', [SizeController::class, 'show']);
        Route::post('/', [SizeController::class, 'store'])->middleware('ability:Admin,Employee');

        Route::middleware('ability:Admin')->group(function () {
            Route::put('/{id}', [SizeController::class, 'update']);
            Route::delete('/{id}', [SizeController::class, 'destroy']);
        });
    });

    Route::prefix('/pizza-orders')->group(function () {
        Route::get('/', [PizzaOrderController::class, 'index'])->middleware('ability:Admin,Employee');

        Route::get('/{id}', [PizzaOrderController::class, 'show'])->middleware(PizzaOrderMiddleware::class);

        Route::post('/', [PizzaOrderController::class, 'store']);
    });
});
