<?php

use App\Http\Controllers\User\CourseController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\LessonController;
use App\Http\Controllers\User\TrackController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::controller(TrackController::class)->group(function () {
    Route::get('tracks', 'index')->name('tracks.index');
    Route::get('tracks/show/{id}', 'show')->name('tracks.show');
});

Route::controller(CourseController::class)->group(function () {
    Route::get('courses', 'index')->name('courses.index');
    Route::get('courses/show/{id}', 'show')->name('courses.show');
});