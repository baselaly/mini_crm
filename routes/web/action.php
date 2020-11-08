<?php

use App\Http\Controllers\ActionController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'permission:action-crud'], function () {
    Route::get('actions/customers/{customerId}', [ActionController::class, 'getCustomerActions'])->name('customers.action');
    Route::get('actions/{customerId}/create', [ActionController::class, 'create'])->name('actions.create');
    Route::post('actions/{customerId}', [ActionController::class, 'store'])->name('actions.store');
});
