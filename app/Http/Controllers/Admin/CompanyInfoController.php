<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanyInfoRequest;
use App\Models\CompanyInfo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CompanyInfoController extends Controller
{
    private function getCompanyInfo(): CompanyInfo
    {
        return CompanyInfo::firstOrCreate([], [
            'name' => 'رواد البرمجة للحلول الرقمية',
            'description' => 'نبتكر المستقبل الرقمي ونحول الأفكار إلى حلول برمجية ذكية واستثنائية',
            'about' => 'شركة رواد البرمجة هي شركة سعودية رائدة متخصصة في تطوير البرمجيات، وتطبيقات الجوال، والمنصات السحابية، والأنظمة الإدارية للمؤسسات.',
            'email' => 'info@ruaadalbarmaja.com',
            'phone' => '+966 56 657 8146',
            'whatsapp' => '+966566578146',
            'address' => 'طريق الملك فهد - حي العليا - الرياض',
            'city' => 'الرياض',
            'district' => 'حي العليا',
            'street' => 'طريق الملك فهد',
            'founded_year' => 2018,
            'working_hours' => 'الأحد - الخميس | 8:00 صباحاً - 5:00 مساءً',
            'facebook_url' => 'https://facebook.com/ruaadalbarmaja',
            'twitter_url' => 'https://twitter.com/ruaadalbarmaja',
            'linkedin_url' => 'https://linkedin.com/company/ruaadalbarmaja',
            'instagram_url' => 'https://instagram.com/ruaadalbarmaja',
            'tiktok_url' => 'https://tiktok.com/@ruaadalbarmaja',
            'is_active' => true,
            'show_hero_section' => true,
            'show_about_section' => true,
            'show_services_section' => true,
            'show_statistics_section' => true,
            'show_projects_section' => true,
            'show_testimonials_section' => true,
            'show_partners_section' => true,
            'show_contact_section' => true,
        ]);
    }

    public function index(): RedirectResponse
    {
        return redirect()->route('admin.company-info.show');
    }

    public function show(): View
    {
        $companyInfo = $this->getCompanyInfo();

        return view('pages.admin.company-info.show', compact('companyInfo'));
    }

    public function edit(): View
    {
        $companyInfo = $this->getCompanyInfo();

        return view('pages.admin.company-info.edit', compact('companyInfo'));
    }

    public function update(CompanyInfoRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $companyInfo = $this->getCompanyInfo();

        if ($request->hasFile('logo')) {
            if ($companyInfo->logo && Storage::disk('public')->exists($companyInfo->logo)) {
                Storage::disk('public')->delete($companyInfo->logo);
            }
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');
        $data['is_maintenance'] = $request->boolean('is_maintenance');
        $data['show_hero_section'] = $request->boolean('show_hero_section');
        $data['show_about_section'] = $request->boolean('show_about_section');
        $data['show_services_section'] = $request->boolean('show_services_section');
        $data['show_statistics_section'] = $request->boolean('show_statistics_section');
        $data['show_projects_section'] = $request->boolean('show_projects_section');
        $data['show_testimonials_section'] = $request->boolean('show_testimonials_section');
        $data['show_partners_section'] = $request->boolean('show_partners_section');
        $data['show_contact_section'] = $request->boolean('show_contact_section');

        $companyInfo->update($data);

        return redirect()->route('admin.company-info.show')
            ->with('success', 'تم تحديث معلومات وإعدادات الموقع بنجاح');
    }

    public function toggleMaintenance(): RedirectResponse
    {
        $companyInfo = $this->getCompanyInfo();
        $newState = !$companyInfo->is_maintenance;
        $companyInfo->update([
            'is_maintenance' => $newState,
        ]);

        if ($newState) {
            return back()->with('warning', 'تم تفعيل وضع الصيانة بنجاح. الزوار العاديين سيشاهدون الآن صفحة الصيانة.');
        }

        return back()->with('success', 'تم إيقاف وضع الصيانة وعاد الموقع للعمل لجميع الزوار بنجاح.');
    }
}
