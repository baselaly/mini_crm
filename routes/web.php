<?php

use Illuminate\Support\Facades\Route;

require 'web/auth.php';

Route::group(['middleware' => 'auth'], function () {
    require 'web/employee.php';
    require 'web/customer.php';
    require 'web/action.php';
});
