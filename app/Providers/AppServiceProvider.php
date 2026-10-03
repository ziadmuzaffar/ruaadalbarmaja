<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Share company info, notifications, and header stats with views
        view()->composer('*', function ($view) {
            $companyInfo = null;
            $unreadNotificationsCount = 0;
            $headerNotifications = collect();
            $headerStatsCount = [
                'projects' => 0,
                'services' => 0,
                'partners' => 0,
                'testimonials' => 0,
                'categories' => 0,
            ];

            if (\Illuminate\Support\Facades\Schema::hasTable('company_info')) {
                $companyInfo = \App\Models\CompanyInfo::first();
            }

            if (\Illuminate\Support\Facades\Schema::hasTable('contact_messages')) {
                $unreadNotificationsCount = \App\Models\ContactMessage::where('status', 'new')->count();
                $headerNotifications = \App\Models\ContactMessage::latest()->take(5)->get();
            }

            if (\Illuminate\Support\Facades\Schema::hasTable('projects')) {
                $headerStatsCount['projects'] = \App\Models\Project::count();
            }
            if (\Illuminate\Support\Facades\Schema::hasTable('services')) {
                $headerStatsCount['services'] = \App\Models\Service::count();
            }
            if (\Illuminate\Support\Facades\Schema::hasTable('partners')) {
                $headerStatsCount['partners'] = \App\Models\Partner::count();
            }
            if (\Illuminate\Support\Facades\Schema::hasTable('testimonials')) {
                $headerStatsCount['testimonials'] = \App\Models\Testimonial::count();
            }
            if (\Illuminate\Support\Facades\Schema::hasTable('categories')) {
                $headerStatsCount['categories'] = \App\Models\Category::count();
            }

            $view->with([
                'companyInfo' => $companyInfo,
                'unreadNotificationsCount' => $unreadNotificationsCount,
                'headerNotifications' => $headerNotifications,
                'headerStatsCount' => $headerStatsCount,
            ]);
        });
    }
}
