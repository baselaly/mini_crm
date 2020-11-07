<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'getlogin'])->name('login.get');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth');
