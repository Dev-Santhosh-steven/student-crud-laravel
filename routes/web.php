<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware('admin.auth')->group(function () {
    Route::get('/students', [StudentController::class, 'index']);
    Route::post('/students', [StudentController::class, 'store']);
    Route::get('/students/{student}', [StudentController::class, 'show']);  
    Route::put('/students/{student}', [StudentController::class, 'update']);
    Route::delete('/students/{student}', [StudentController::class, 'destroy']);
});

