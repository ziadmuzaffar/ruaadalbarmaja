<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::truncate();

        $services = [
            [
                'title' => 'تطوير تطبيقات الجوال',
                'description' => 'تصميم وتطوير تطبيقات أندرويد و iOS باستخدام أحدث التقنيات مثل Flutter و Native لتجارب مستخدم فائقة السلاسة والأداء.',
                'icon' => 'fas fa-mobile-alt',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'تصميم وتطوير مواقع الويب',
                'description' => 'بناء مواقع إلكترونية ومجموعات منصات ويب مخصصة ذات سرعة عالية وأمان متقدم لتلبية متطلبات وتطلعات سوق العمل.',
                'icon' => 'fas fa-laptop-code',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'الأنظمة الإدارية و ERP',
                'description' => 'تطوير أنظمة سحابية مخصصة لإدارة الحسابات، المخازن، الموارد البشرية، وتتبع المبيعات بدقة عالية وكفاءة تشغيلية.',
                'icon' => 'fas fa-network-wired',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'حلول المتاجر الإلكترونية',
                'description' => 'إنشاء متاجر إلكترونية متكاملة ترتبط بجميع بوابات الدفع الإلكتروني وشركات الشحن لزيادة مبيعاتك وتوسيع تجارتك.',
                'icon' => 'fas fa-shopping-cart',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'حلول الذكاء الاصطناعي والأتمتة',
                'description' => 'دمج تقنيات الذكاء الاصطناعي وبوتات المحادثة الذكية وأتمتة المهام اليومية لرفع الإنتاجية وتقليل التكاليف.',
                'icon' => 'fas fa-brain',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'الحماية والأمن السيبراني',
                'description' => 'تأمين الأنظمة وقواعد البيانات، وإجراء فحص الثغرات، وتوفير استضافات سحابية عالية السرعة والأمان.',
                'icon' => 'fas fa-shield-alt',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
