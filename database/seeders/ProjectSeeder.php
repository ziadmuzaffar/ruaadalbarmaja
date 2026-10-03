<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Category;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::truncate();

        $catMobile = Category::where('slug', 'mobile-apps')->first();
        $catWeb = Category::where('slug', 'web-apps')->first();
        $catCloud = Category::where('slug', 'cloud-systems')->first();
        $catEcommerce = Category::where('slug', 'ecommerce')->first();

        $projects = [
            [
                'category_id' => $catEcommerce?->id,
                'title' => 'منصة "سويفت باي" للتسوق والدفع الإلكتروني',
                'description' => 'منصة تجارة إلكترونية متكاملة تدعم تعدد التجار، ربط الدفع الفوري مع مدى وشركات الفيزا والتقسيط، بالإضافة إلى نظام تتبع الشحنات اللحظي وواجهة تحكم فائقة الأداء.',
                'image' => '',
                'client_name' => 'مجموعة الخليج للبيع بالتجزئة',
                'completion_date' => '2025-11-15',
                'location' => 'الرياض',
                'order' => 1,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $catMobile?->id,
                'title' => 'تطبيق "وصلني" للخدمات اللوجستية والتوصيل',
                'description' => 'تطبيق جوال مبتكر لتوصيل الشحنات والطلبات يعتمد على خرائط تفاعلية حية، وتوجيه ذكي للمندوبين، ونظام تقييم فوري وإشعارات لحظية.',
                'image' => '',
                'client_name' => 'شركة الأفق اللوجستية',
                'completion_date' => '2025-09-20',
                'location' => 'جدة',
                'order' => 2,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $catCloud?->id,
                'title' => 'نظام "ميديكير" لإدارة المستشفيات والمراكز الطبية',
                'description' => 'نظام ERP سحابي متكامل لإدارة ملفات المرضى، حجز المواعيد الآلي، الروشتة الإلكترونية، وربط المختبرات والتأمين الطبي بموثوقية وأمان عالي.',
                'image' => '',
                'client_name' => 'مجمع الشفاء الطبي',
                'completion_date' => '2025-06-10',
                'location' => 'الدمام',
                'order' => 3,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $catWeb?->id,
                'title' => 'منصة "عقاري" لإدارة وتأجير العقارات',
                'description' => 'بوابة رقمية تفاعلية لعرض العقارات وتأجيرها وإدارتها مع خاصية التجوّل الافتراضي الذكي والعقود الإلكترونية الموثقة ولوحة تحليل البيانات.',
                'image' => '',
                'client_name' => 'شركة العقارات المتحدة',
                'completion_date' => '2025-04-05',
                'location' => 'الرياض',
                'order' => 4,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $catMobile?->id,
                'title' => 'تطبيق "أكاديميتي" للتعليم والتدريب التفاعلي',
                'description' => 'منصة تعليمية ذكية تقدم بث مباشر للدورات، اختبارات أوتوماتيكية، وشهادات رقمية معتمدة مع حماية للمحتوى المرئي وتجربة تعلم ممتازة.',
                'image' => '',
                'client_name' => 'أكاديمية المستقبل',
                'completion_date' => '2025-02-18',
                'location' => 'الرياض',
                'order' => 5,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $catCloud?->id,
                'title' => 'نظام "إدارة الموارد البشرية HR Pro"',
                'description' => 'نظام سحابي لإدارة الحضور والانصراف، البصمة الذكية، كشوف المرتبات، الإجازات، وحساب المكافآت وفق قانون العمل السعودي.',
                'image' => '',
                'client_name' => 'مجموعة البناء الوطنية',
                'completion_date' => '2025-01-12',
                'location' => 'الخبر',
                'order' => 6,
                'is_featured' => true,
                'is_active' => true,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
