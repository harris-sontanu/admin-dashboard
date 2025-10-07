<?php

use App\Admin\Controllers\Auth\LoginController;
use App\Admin\Controllers\Auth\LogoutController;
use App\Admin\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('show.form.login');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::get('forgot-password', [LoginController::class, 'showForgotPasswordForm'])->name('show.form.forgot');
});
Route::group(['middleware' => 'auth'], function () {
    Route::prefix('admin/')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('logout', [LogoutController::class, 'logout'])->name('logout');
    });
});