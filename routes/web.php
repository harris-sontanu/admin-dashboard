<?php

use App\Admin\Controllers\Auth\ForgotPasswordController;
use App\Admin\Controllers\Auth\LoginController;
use App\Admin\Controllers\Auth\LogoutController;
use App\Admin\Controllers\Category\CategoryController;
use App\Admin\Controllers\Dashboard\DashboardController;
use App\Admin\Controllers\Post\PostController;
use App\Admin\Controllers\User\RoleController;
use App\Admin\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('show.form.login');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('show.form.forgot');
    Route::post('forgot-password', [ForgotPasswordController::class, 'checkEmail'])->name('handle.form.forgot');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::put('reset-password', [ForgotPasswordController::class, 'updatePassword'])->name('password.update');
});

Route::group(['middleware' => 'auth'], function () {
    Route::prefix('admin/')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('logout', [LogoutController::class, 'logout'])->name('logout');
    });

    Route::prefix('admin/')->name('admin.')->group(function () {

        Route::controller(RoleController::class)->group(function () {
            Route::get('users/roles', 'index')->name('users.roles.index')
                ->middleware('permission:view role');
            Route::post('users/roles', 'store')->name('users.roles.store')
                ->middleware('permission:create role');
            Route::get('users/roles/{role}/edit', 'edit')->name('users.roles.edit')
                ->middleware('permission:edit role');
            Route::put('users/roles/{role}', 'update')->name('users.roles.update')
                ->middleware('permission:edit role');
            Route::delete('users/roles/{role}', 'destroy')->name('users.roles.destroy')
                ->middleware('permission:delete role');
        });

        Route::controller(UserController::class)->group(function () {
            Route::get('users', 'index')->name('users.index')
                ->middleware(middleware: 'permission:view user');
            Route::post('users', 'store')->name('users.store')
                ->middleware('permission:create user');
            Route::get('users/{user}/edit', 'edit')->name('users.edit')
                ->middleware('permission:edit user');
            Route::put('users/{user}', 'update')->name('users.update')
                ->middleware('permission:edit user');
            Route::delete('users/{user}', 'destroy')->name('users.destroy')
                ->middleware('permission:delete user');
        });

        Route::resource('users', UserController::class);

        // News Category
        Route::get('category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('category/create', [CategoryCOntroller::class, 'create'])->name('category.create');
        Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('category/{id}/update', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('category/{id}/delete', [CategoryController::class, 'destroy'])->name('category.destroy');
        // End News Category

        // Post
        Route::get('post', [PostController::class, 'index'])->name('post.index');
        Route::get('post/create', [PostController::class, 'create'])->name('post.create');
        Route::post('post/store', [PostController::class, 'store'])->name('post.store');
        Route::get('post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
        Route::put('post/{id}/update', [PostController::class, 'update'])->name('post.update');
        Route::delete('post/{id}/delete', [PostController::class, 'destroy'])->name('post.destroy');
        Route::get('post/{id}', [PostController::class, 'show'])->name('post.show');
        // End Post
    });
});
