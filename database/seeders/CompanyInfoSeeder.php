<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyInfo;

class CompanyInfoSeeder extends Seeder
{
    public function run(): void
    {
        CompanyInfo::truncate();

        CompanyInfo::create([
            'name' => 'رواد البرمجة للحلول الرقمية',
            'description' => 'نبتكر المستقبل الرقمي ونحول الأفكار إلى حلول برمجية ذكية واستثنائية',
            'about' => 'شركة رواد البرمجة هي شركة سعودية رائدة متخصصة في تطوير البرمجيات، وتطبيقات الجوال، والمنصات السحابية، والأنظمة الإدارية للمؤسسات. نعتمد على أحدث التقنيات لنقدم لعملائنا حلولاً رقمية متكاملة تتميز بالأداء العالي، الأمان والمظهر العصري المبتكر.',
            'logo' => '',
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
        ]);
    }
}
