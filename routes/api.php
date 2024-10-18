<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::put('users', [UserController::class, 'update'])->name('users.update');
    Route::post('users/upload-image', [UserController::class, 'uploadImage'])->name('users.uploadImage');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->middleware(AdminMiddleware::class)->name('users.destroy');
    Route::get('profile', [UserController::class, 'profile'])->name('users.profile');

    Route::get('categories', [CategoryController::class, 'index'])->middleware(AdminMiddleware::class)->name('categories.index');
    Route::get('categories/{category}', [CategoryController::class, 'show'])->middleware(AdminMiddleware::class)->name('categories.show');
    Route::post('categories', [CategoryController::class, 'store'])->middleware(AdminMiddleware::class)->name('categories.store');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->middleware(AdminMiddleware::class)->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->middleware(AdminMiddleware::class)->name('categories.destroy');

    Route::get('services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('services/{service}', [ServiceController::class, 'show'])->name('services.show');
    Route::post('services', [ServiceController::class, 'store'])->middleware(AdminMiddleware::class)->name('services.store');
    Route::put('services/{service}', [ServiceController::class, 'update'])->middleware(AdminMiddleware::class)->name('services.update');
    Route::delete('services/{service}', [ServiceController::class, 'destroy'])->middleware(AdminMiddleware::class)->name('services.destroy');
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
