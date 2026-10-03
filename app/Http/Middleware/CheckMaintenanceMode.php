<?php

namespace App\Http\Middleware;

use App\Models\CompanyInfo;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    /**
     * Handle an incoming request and check if website maintenance mode is active.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Exclude internal, admin and authentication paths
        if ($request->is('admin') || $request->is('admin/*') || $request->is('up') || $request->is('maintenance/preview')) {
            return $next($request);
        }

        // 2. Allow authenticated administrators to access and test the site
        if (auth()->check()) {
            return $next($request);
        }

        // 3. Check maintenance mode in settings
        $company = null;
        if (\Illuminate\Support\Facades\Schema::hasTable('company_info')) {
            $company = CompanyInfo::first();
        }

        if ($company && $company->is_maintenance) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $company->maintenance_title ?: 'الموقع قيد الصيانة حالياً، سنعود قريباً.',
                    'details' => $company->maintenance_message ?: 'نعمل حالياً على تحديث وتطوير أنظمتنا لتقديم تجربة أفضل.',
                    'ends_at' => $company->maintenance_ends_at ? $company->maintenance_ends_at->toIso8601String() : null,
                ], 503, ['Retry-After' => '3600']);
            }

            return response()->view('pages.website.maintenance', [
                'company' => $company,
            ], 503, [
                'Retry-After' => '3600',
            ]);
        }

        return $next($request);
    }
}
