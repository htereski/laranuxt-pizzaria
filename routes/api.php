<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KindController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\PizzaOrderController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\PizzaOrderMiddleware;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return 'ping';
// });

Route::get('/email/verify', [MailController::class, 'notice'])->middleware('auth:sanctum')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [MailController::class, 'verify'])->middleware(['auth:sanctum', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', [MailController::class, 'send'])->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth:sanctum', 'email'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/home', [KindController::class, 'index'])->name('home');

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
        Route::middleware('ability:Admin')->group(function () {
            Route::put('/{id}', [PizzaOrderController::class, 'update']);
            Route::delete('/{id}', [PizzaOrderController::class, 'destroy']);
        });

        Route::middleware(PizzaOrderMiddleware::class)->group(function () {
            Route::get('/', [PizzaOrderController::class, 'index']);
            Route::get('/{id}', [PizzaOrderController::class, 'show']);
        });

        Route::post('/', [PizzaOrderController::class, 'store']);
    });

    Route::prefix('/admin')->middleware('ability:Admin')->group(function () {
        Route::get('/employees', [AdminController::class, 'employees']);
    });
});
