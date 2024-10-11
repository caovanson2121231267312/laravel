<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;

Route::group(['prefix' => 'admin'], function () {

    Route::controller(AuthController::class)->group(function () {

        Route::get('/login', 'login')->name('admin.login');

        Route::post('/login-form', 'login_form')->name('admin.login.form');

        Route::get('/logout', 'logout')->name('admin.logout');
    });


    Route::middleware(['checkAdminLogin'])->group(function () {

        Route::controller(DashboardController::class)->group(function () {
            Route::get('/', 'index')->name('dashboard.index');
        });

        Route::controller(CategoryController::class)->group(function () {
            Route::get('/categories', 'index')->name('category.index');
            Route::get('/categories/create', 'create')->name('category.create');
            Route::post('/categories/store', 'store')->name('category.store');

            Route::get('/categories/edit/{id}', 'edit')->name('category.edit');
            Route::post('/categories/update/{id}', 'update')->name('category.update');

            Route::delete('/categories/delete/{id}', 'destroy')->name('category.delete');

        });

        Route::controller(UserController::class)->group(function () {
            Route::get('/users', 'index')->name('users.index');
            Route::get('/users/export', 'export')->name('users.export');
            // Route::get('/users/create', 'create')->name('users.create');
            Route::post('/users/store', 'store')->name('users.store');

            Route::get('/users/edit/{id}', 'edit')->name('users.edit');
            Route::post('/users/update/{id}', 'update')->name('users.update');
            Route::post('/changepassword', 'changepassword')->name('user.changepassword');
            Route::post('sendmail','sendmail')->name('user.sendmail');

            Route::delete('/users/delete/{id}', 'destroy')->name('users.delete');
        });

        Route::controller(RoleController::class)->group(function () {
            Route::get('/roles','index')->name('role.index');
            Route::post('/role/store','store')->name('role.store');
            Route::get('/role/edit/{id}','edit')->name('role.edit');
            Route::post('role/update/{id}','update')->name('role.update');
        });

        Route::controller(ProductController::class)->group(function () {
            Route::get('/products', 'index')->name('product.index');
            Route::post('/products/store', 'store')->name('product.store');
        });
        Route::controller(OrderController::class)->group(function () {
            Route::get('/orders', 'index')->name('order.index');
            Route::get('/orders/show/{id}', 'show')->name('order.show');
            Route::post('/confirm', 'confirm')->name('order.confirm');
        });
    });
});
