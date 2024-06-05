<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

    Route::get('/home', [PizzaController::class, 'home']);
    Route::get('/pizzas', [PizzaController::class, 'index']);
    Route::get('/foods', [ProductController::class, 'foods']);
    Route::get('/drinks', [ProductController::class, 'drinks']);
    Route::get('/pizza/{id}', [PizzaController::class, 'show']);
    Route::get('/product/{id}', [ProductController::class, 'show']);

    Route::middleware(['role:Admin'])->group(function () {
        Route::resource('/pizzas', PizzaController::class)->except([
            'create', 'edit'
        ]);
        Route::resource('/products', ProductController::class)->except([
            'create', 'edit'
        ]);
    });

    Route::prefix('/admin')->middleware('role:Admin')->group(function () {
        Route::resource('/employees', AdminController::class)->except([
            'create', 'edit'
        ]);
    });
});
