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

    Route::prefix('admin/users/')->name('admin.users.')->group(function () {
        Route::resource('roles', RoleController::class);
    });

    Route::prefix('admin/')->name('admin.')->group(function () {
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

        // End Post
    });
});
