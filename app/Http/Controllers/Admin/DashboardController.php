<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Service;
use App\Models\Statistic;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Core Counts & Metrics
        $projectsCount = Project::count();
        $activeProjectsCount = Project::where('is_active', true)->count();
        $featuredProjectsCount = Project::where('is_featured', true)->count();

        $servicesCount = Service::count();
        $activeServicesCount = Service::where('is_active', true)->count();

        $messagesCount = ContactMessage::count();
        $unreadMessagesCount = ContactMessage::whereNull('read_at')->count();
        $repliedMessagesCount = ContactMessage::whereNotNull('replied_at')->count();

        $categoriesCount = Category::count();
        $partnersCount = Partner::count();
        $testimonialsCount = Testimonial::count();
        $statisticsCount = Statistic::count();

        // Recent Records
        $recentProjects = Project::with('category')->latest()->take(5)->get();
        $recentMessages = ContactMessage::latest()->take(5)->get();

        // Categories Distribution for Donut Chart
        $categoriesChartData = Category::withCount('projects')
            ->orderBy('projects_count', 'desc')
            ->get(['id', 'name']);

        $categoryNames = $categoriesChartData->pluck('name')->toArray();
        $categoryProjectsCounts = $categoriesChartData->pluck('projects_count')->toArray();

        // Monthly Contact Messages Statistics
        $driver = DB::connection()->getDriverName();
        $monthYearRaw = ($driver === 'sqlite')
            ? "strftime('%Y-%m', created_at)"
            : "DATE_FORMAT(created_at, '%Y-%m')";

        $monthlyMessagesData = ContactMessage::select(
            DB::raw('COUNT(id) as total'),
            DB::raw("{$monthYearRaw} as month_year")
        )
            ->groupBy(DB::raw($monthYearRaw))
            ->orderBy(DB::raw($monthYearRaw), 'asc')
            ->take(6)
            ->get();

        $monthlyLabels = $monthlyMessagesData->map(function ($item) {
            try {
                return \Carbon\Carbon::parse($item->month_year . '-01')->locale('ar')->translatedFormat('F');
            } catch (\Throwable $e) {
                return $item->month_year;
            }
        })->toArray();

        $monthlyCounts = $monthlyMessagesData->pluck('total')->toArray();

        $data = [
            'projectsCount' => $projectsCount,
            'activeProjectsCount' => $activeProjectsCount,
            'featuredProjectsCount' => $featuredProjectsCount,
            'servicesCount' => $servicesCount,
            'activeServicesCount' => $activeServicesCount,
            'messagesCount' => $messagesCount,
            'unreadMessagesCount' => $unreadMessagesCount,
            'repliedMessagesCount' => $repliedMessagesCount,
            'categoriesCount' => $categoriesCount,
            'partnersCount' => $partnersCount,
            'testimonialsCount' => $testimonialsCount,
            'statisticsCount' => $statisticsCount,
            'recentProjects' => $recentProjects,
            'recentMessages' => $recentMessages,
            'categoryNames' => $categoryNames,
            'categoryProjectsCounts' => $categoryProjectsCounts,
            'monthlyLabels' => $monthlyLabels,
            'monthlyCounts' => $monthlyCounts,
        ];

        return view('pages.admin.dashboard', $data);
    }

    public function help()
    {
        return view('pages.admin.help');
    }
}
