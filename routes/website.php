<?php

use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\ContactController;
use App\Http\Controllers\Website\SitemapController;
use Illuminate\Support\Facades\Route;

// Public Website Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');

// Maintenance Mode Preview
Route::get('/maintenance/preview', [HomeController::class, 'maintenancePreview'])->name('maintenance.preview');

// SEO Routes
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');

