<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\DashboardController;


Route::group(['prefix' => 'admin'], function () {

    Route::controller(AuthController::class)->group(function () {

        Route::get('/login', 'login')->name('admin.login');

        Route::post('/login-form', 'login_form')->name('admin.login.form');

        Route::get('/logout', 'logout')->name('admin.logout');
    });

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard.index');
    });
});
