<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\TrackController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::view('admins/login', 'pages.admins.auth.login')->name('login');
    Route::post('admins/login', [AuthController::class, 'login'])->name('admins.login');
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth:web')->group(function () {
    Route::get('admins/dashboard', [DashboardController::class, 'index'])->name('admins.dashboard');
    
    Route::resource('admins/tracks', TrackController::class)->names([
        'index' => 'admins.tracks.index',
        'create' => 'admins.tracks.create',
        'store' => 'admins.tracks.store',
        'edit' => 'admins.tracks.edit',
        'update' => 'admins.tracks.update',
        'destroy' => 'admins.tracks.destroy'
    ]);

    Route::resource('admins/courses', CourseController::class)->names([
        'index' => 'admins.courses.index',
        'create' => 'admins.courses.create',
        'store' => 'admins.courses.store',
        'edit' => 'admins.courses.edit',
        'update' => 'admins.courses.update',
        'destroy' => 'admins.courses.destroy'
    ]);

    Route::resource('admins/lessons', LessonController::class)->names([
        'index' => 'admins.lessons.index',
        'create' => 'admins.lessons.create',
        'store' => 'admins.lessons.store',
        'edit' => 'admins.lessons.edit',
        'update' => 'admins.lessons.update',
        'destroy' => 'admins.lessons.destroy'
    ]);
    
    Route::resource('admins/users', UserController::class)->names([
        'index' => 'admins.users.index',
        'create' => 'admins.users.create',
        'store' => 'admins.users.store',
        'edit' => 'admins.users.edit',
        'update' => 'admins.users.update',
        'destroy' => 'admins.users.destroy'
    ]);;
});