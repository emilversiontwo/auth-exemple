<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('hello', function () {
    return collect(['name' => 'John Doe']);
});

Route::post('register', [AuthController::class, 'register'])->name('register');
