<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthCheck;
use Illuminate\Support\Facades\Route;


Route::get('hello', function () {
    return collect(['name' => 'John Doe']);
})->middleware(AuthCheck::class);

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('close-all-sessions', [AuthController::class, 'closeAllSessions'])->name('closeAllSessions');
