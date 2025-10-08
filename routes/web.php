<?php

use App\Admin\Controllers\Auth\ForgotPasswordController;
use App\Admin\Controllers\Auth\LoginController;
use App\Admin\Controllers\Auth\LogoutController;
use App\Admin\Controllers\Dashboard\DashboardController;
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
        Route::resource('users', UserController::class);
    });
});
