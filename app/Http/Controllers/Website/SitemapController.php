<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use App\Models\Project;
use App\Models\Service;

class SitemapController extends Controller
{
    /**
     * Generate dynamic XML Sitemap for search engines.
     */
    public function index()
    {
        $company = CompanyInfo::where('is_active', true)->first();
        $services = Service::where('is_active', true)->get();
        $projects = Project::where('is_active', true)->get();

        $lastMod = $company?->updated_at?->toAtomString() ?? now()->toAtomString();

        $content = view('pages.website.sitemap', compact('company', 'services', 'projects', 'lastMod'))->render();

        return response($content, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
            'X-Robots-Tag' => 'noindex, follow',
        ]);
    }

    /**
     * Dynamic robots.txt route fallback.
     */
    public function robots()
    {
        $sitemapUrl = url('/sitemap.xml');

        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= "Disallow: /admin/\n";
        $content .= "Disallow: /admin\n";
        $content .= "Disallow: /storage/framework/\n";
        $content .= "\n";
        $content .= "Sitemap: {$sitemapUrl}\n";

        return response($content, 200, [
            'Content-Type' => 'text/plain; charset=utf-8',
        ]);
    }
}
