<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::resource('users', CustomerController::class)->middleware(['permission:customer-crud']);
