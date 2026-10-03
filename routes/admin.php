<?php

// Admin Routes (Protected)

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CompanyInfoController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [LoginController::class, 'login'])->middleware('throttle:5,1');
});
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Company Info & Settings
    Route::get('/company-info', [CompanyInfoController::class, 'show'])->name('company-info.show');
    Route::get('/company-info/index', [CompanyInfoController::class, 'index'])->name('company-info.index');
    Route::get('/company-info/edit', [CompanyInfoController::class, 'edit'])->name('company-info.edit');
    Route::put('/company-info', [CompanyInfoController::class, 'update'])->name('company-info.update');
    Route::post('/company-info/toggle-maintenance', [CompanyInfoController::class, 'toggleMaintenance'])->name('company-info.toggle-maintenance');

    // Settings Aliases
    Route::get('/settings', [CompanyInfoController::class, 'edit'])->name('settings.index');
    Route::put('/settings', [CompanyInfoController::class, 'update'])->name('settings.update');
    Route::post('/settings/toggle-maintenance', [CompanyInfoController::class, 'toggleMaintenance'])->name('settings.toggle-maintenance');

    // Services
    Route::resource('services', ServiceController::class);

    // Categories
    Route::resource('categories', CategoryController::class);

    // Projects
    Route::resource('projects', ProjectController::class);

    // Contact Messages
    Route::post('/contact-messages/mark-all-read', [ContactMessageController::class, 'markAllAsRead'])->name('contact-messages.mark-all-read');
    Route::resource('contact-messages', ContactMessageController::class);

    // Statistics
    Route::resource('statistics', StatisticController::class)->except(['show']);

    // Testimonials
    Route::resource('testimonials', TestimonialController::class)->except(['show']);

    // Partners
    Route::resource('partners', PartnerController::class);

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Help
    Route::get('/help', [DashboardController::class, 'help'])->name('help');

    // Fallback Route for Invalid Admin Sub-paths
    Route::fallback(function () {
        return redirect()->route('admin.dashboard')->with('error', 'الصفحة المطلوبة غير موجودة.');
    });
});
