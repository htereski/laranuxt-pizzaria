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

Route::get('/email/verify', [MailController::class, 'notice'])->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [MailController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', [MailController::class, 'send'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/check', [AuthController::class, 'check']);


Route::middleware(['auth', 'email'])->group(function () {
    Route::get('/home', [KindController::class, 'index'])->name('home');

    Route::prefix('/pizzas')->group(function () {
        Route::get('/category/{id}', [PizzaController::class, 'index']);
        Route::get('/{id}', [PizzaController::class, 'show']);
        Route::post('/', [PizzaController::class, 'store'])->middleware('role:Admin,Employee');

        Route::middleware('role:Admin')->group(function () {
            Route::put('/{id}', [PizzaController::class, 'update']);
            Route::delete('/{id}', [PizzaController::class, 'destroy']);
        });
    });

    Route::prefix('/kinds')->group(function () {
        Route::get('/', [KindController::class, 'index']);
        Route::post('/', [KindController::class, 'store'])->middleware('role:Admin,Employee');

        Route::middleware('role:Admin')->group(function () {
            Route::put('/{id}', [KindController::class, 'update']);
            Route::delete('/{id}', [KindController::class, 'destroy']);
        });
    });

    Route::prefix('/sizes')->group(function () {
        Route::get('/', [SizeController::class, 'index']);
        Route::get('/{id}', [SizeController::class, 'show']);
        Route::post('/', [SizeController::class, 'store'])->middleware('role:Admin,Employee');

        Route::middleware('role:Admin')->group(function () {
            Route::put('/{id}', [SizeController::class, 'update']);
            Route::delete('/{id}', [SizeController::class, 'destroy']);
        });
    });

    Route::prefix('/pizza-orders')->group(function () {
        Route::middleware('role:Admin')->group(function () {
            Route::put('/{id}', [PizzaOrderController::class, 'update']);
            Route::delete('/{id}', [PizzaOrderController::class, 'destroy']);
        });

        Route::middleware('role:Admin,Employee')->group(function () {
            Route::get('/', [PizzaOrderController::class, 'index']);
        });

        Route::middleware(PizzaOrderMiddleware::class)->group(function () {
            Route::get('/{id}', [PizzaOrderController::class, 'show']);
        });

        Route::post('/', [PizzaOrderController::class, 'store']);
    });

    Route::prefix('/admin')->middleware('role:Admin')->group(function () {
        Route::get('/employees', [AdminController::class, 'employees']);
        Route::get('/employees/{id}', [AdminController::class, 'employee']);
        Route::post('/employees', [AdminController::class, 'registerEmployee']);
        Route::put('/employees/{id}', [AdminController::class, 'updateEmployee']);
        Route::delete('/employees/{id}', [AdminController::class, 'destroyEmployee']);
    });
});
