<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        Testimonial::truncate();

        $testimonials = [
            [
                'client_name' => 'م. خالد العتيبي',
                'client_position' => 'الرئيس التنفيذي',
                'client_company' => 'شركة الأفق اللوجستية',
                'testimonial' => 'تعاملنا مع شركة رواد البرمجة لتطوير تطبيقنا الخاص بالتوصيل، وكانت التجربة استثنائية من حيث الاحترافية في المواعيد والجودة العالية للأنظمة الكودية والتصميم الفائق.',
                'rating' => 5,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'client_name' => 'د. سارة الغامدي',
                'client_position' => 'مديرة التخطيط والتحول الرقمي',
                'client_company' => 'مجمع الشفاء الطبي',
                'testimonial' => 'نظام ميديكير الذي تم تطويره من قِبل رواد البرمجة أحدث نقلة نوعية في كفاءة أعمالنا الطبية وسرعة خدمة المرضى. دعمهم الفني متواجد دائماً ويستحقون كل التقدير.',
                'rating' => 5,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'client_name' => 'أ. فهد الشمري',
                'client_position' => 'مدير قطاع التجارة الإلكترونية',
                'client_company' => 'مجموعة الخليج للبيع بالتجزئة',
                'testimonial' => 'منصة التسوق التي أنشأوها لنا حققت زيادة في المبيعات بنسبة 40% خلال الأشهر الأولى بفضل سرعة التصفح وتجربة المستخدم المتميزة سهلة الاستخدام.',
                'rating' => 5,
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
