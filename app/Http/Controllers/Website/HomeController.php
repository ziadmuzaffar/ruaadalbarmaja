<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CompanyInfo;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Service;
use App\Models\Statistic;
use App\Models\Testimonial;

class HomeController extends Controller
{
    /**
     * Display the website home page.
     */
    public function index()
    {
        $company = CompanyInfo::where('is_active', true)->first();

        // Fallback default company info if not present
        if (!$company) {
            $company = new CompanyInfo([
                'name' => 'رواد البرمجة',
                'description' => 'الشركة الرائدة في مجال البرمجة وتطوير البرمجيات والحلول الرقمية المتكاملة.',
                'about' => 'نحن شركة متخصصة في ابتكار وتطوير الحلول الرقمية، وتصميم المواقع والتطبيقات، ونظم إدارة المؤسسات وأحدث تقنيات الذكاء الاصطناعي بنماذج احترافية تناسب تطلعات عملائنا.',
                'email' => 'info@ruaadalbarmaja.com',
                'phone' => '+966500000000',
                'whatsapp' => '966500000000',
                'address' => 'المملكة العربية السعودية، الرياض',
                'founded_year' => 2020,
            ]);
        }

        $services = Service::where('is_active', true)->orderBy('order', 'asc')->get();
        $categories = Category::orderBy('name', 'asc')->get();
        $projects = Project::where('is_active', true)->with('category')->orderBy('order', 'asc')->get();
        $statistics = Statistic::where('is_active', true)->orderBy('order', 'asc')->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('order', 'asc')->get();
        $partners = Partner::where('is_active', true)->orderBy('order', 'asc')->get();

        return view('pages.website.home', compact(
            'company',
            'services',
            'categories',
            'projects',
            'statistics',
            'testimonials',
            'partners'
        ));
    }

    /**
     * Preview the website maintenance page.
     */
    public function maintenancePreview()
    {
        $company = CompanyInfo::first();

        if (!$company) {
            $company = new CompanyInfo([
                'name' => 'رواد البرمجة',
                'description' => 'الشركة الرائدة في مجال البرمجة وتطوير البرمجيات والحلول الرقمية المتكاملة.',
                'maintenance_title' => 'الموقع قيد الصيانة والتحديث حالياً',
                'maintenance_message' => 'نعمل حالياً على إجراء تحديثات وترقيات لأنظمتنا البرمجية لتقديم تجربة رقمية استثنائية تفوق توقعاتكم. سنعود للعمل قريباً جداً!',
                'email' => 'info@ruaadalbarmaja.com',
                'phone' => '+966500000000',
                'whatsapp' => '966500000000',
            ]);
        }

        return view('pages.website.maintenance', compact('company'));
    }
}
