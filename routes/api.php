<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('profile', [UserController::class, 'profile'])->name('users.profile');
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
