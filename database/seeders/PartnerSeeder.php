<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        Partner::truncate();

        $partners = [
            [
                'name' => 'أرامكو السعودية',
                'description' => 'شريك استراتيجي في مجال الحلول الرقمية وإدارة أصول الطاقة والتحول الرقمي.',
                'website' => 'https://www.aramco.com',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'شركة سابك',
                'description' => 'التعاون والتطوير التقني لأنظمة تتبع سلاسل الإمداد ومراقبة الجودة.',
                'website' => 'https://www.sabic.com',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'شركة الاتصالات السعودية (STC)',
                'description' => 'شراكة تقنية في مجال الربط البرمجي والحوسبة السحابية والأمن السيبراني.',
                'website' => 'https://www.stc.com.sa',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'شركة معادن',
                'description' => 'تطوير المنصات الرقمية الخاصة بالمشاريع الصناعية وأنظمة الاتصالات الداخلية.',
                'website' => 'https://www.maaden.com.sa',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'المؤسسة العامة لتحلية المياه',
                'description' => 'شريك في برمجة أنظمة التحكم الرقمي والمراقبة الذكية.',
                'website' => 'https://www.swcc.gov.sa',
                'order' => 5,
                'is_active' => false,
            ],
            [
                'name' => 'أرامكو السعودية',
                'description' => 'شريك استراتيجي في مجال الحلول الرقمية وإدارة أصول الطاقة والتحول الرقمي.',
                'website' => 'https://www.aramco.com',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'شركة سابك',
                'description' => 'التعاون والتطوير التقني لأنظمة تتبع سلاسل الإمداد ومراقبة الجودة.',
                'website' => 'https://www.sabic.com',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'شركة الاتصالات السعودية (STC)',
                'description' => 'شراكة تقنية في مجال الربط البرمجي والحوسبة السحابية والأمن السيبراني.',
                'website' => 'https://www.stc.com.sa',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'شركة معادن',
                'description' => 'تطوير المنصات الرقمية الخاصة بالمشاريع الصناعية وأنظمة الاتصالات الداخلية.',
                'website' => 'https://www.maaden.com.sa',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'المؤسسة العامة لتحلية المياه',
                'description' => 'شريك في برمجة أنظمة التحكم الرقمي والمراقبة الذكية.',
                'website' => 'https://www.swcc.gov.sa',
                'order' => 5,
                'is_active' => false,
            ],
            [
                'name' => 'أرامكو السعودية',
                'description' => 'شريك استراتيجي في مجال الحلول الرقمية وإدارة أصول الطاقة والتحول الرقمي.',
                'website' => 'https://www.aramco.com',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'شركة سابك',
                'description' => 'التعاون والتطوير التقني لأنظمة تتبع سلاسل الإمداد ومراقبة الجودة.',
                'website' => 'https://www.sabic.com',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'شركة الاتصالات السعودية (STC)',
                'description' => 'شراكة تقنية في مجال الربط البرمجي والحوسبة السحابية والأمن السيبراني.',
                'website' => 'https://www.stc.com.sa',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'شركة معادن',
                'description' => 'تطوير المنصات الرقمية الخاصة بالمشاريع الصناعية وأنظمة الاتصالات الداخلية.',
                'website' => 'https://www.maaden.com.sa',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'المؤسسة العامة لتحلية المياه',
                'description' => 'شريك في برمجة أنظمة التحكم الرقمي والمراقبة الذكية.',
                'website' => 'https://www.swcc.gov.sa',
                'order' => 5,
                'is_active' => false,
            ],
            [
                'name' => 'أرامكو السعودية',
                'description' => 'شريك استراتيجي في مجال الحلول الرقمية وإدارة أصول الطاقة والتحول الرقمي.',
                'website' => 'https://www.aramco.com',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'شركة سابك',
                'description' => 'التعاون والتطوير التقني لأنظمة تتبع سلاسل الإمداد ومراقبة الجودة.',
                'website' => 'https://www.sabic.com',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'شركة الاتصالات السعودية (STC)',
                'description' => 'شراكة تقنية في مجال الربط البرمجي والحوسبة السحابية والأمن السيبراني.',
                'website' => 'https://www.stc.com.sa',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'شركة معادن',
                'description' => 'تطوير المنصات الرقمية الخاصة بالمشاريع الصناعية وأنظمة الاتصالات الداخلية.',
                'website' => 'https://www.maaden.com.sa',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'المؤسسة العامة لتحلية المياه',
                'description' => 'شريك في برمجة أنظمة التحكم الرقمي والمراقبة الذكية.',
                'website' => 'https://www.swcc.gov.sa',
                'order' => 5,
                'is_active' => false,
            ],
            [
                'name' => 'أرامكو السعودية',
                'description' => 'شريك استراتيجي في مجال الحلول الرقمية وإدارة أصول الطاقة والتحول الرقمي.',
                'website' => 'https://www.aramco.com',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'شركة سابك',
                'description' => 'التعاون والتطوير التقني لأنظمة تتبع سلاسل الإمداد ومراقبة الجودة.',
                'website' => 'https://www.sabic.com',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'شركة الاتصالات السعودية (STC)',
                'description' => 'شراكة تقنية في مجال الربط البرمجي والحوسبة السحابية والأمن السيبراني.',
                'website' => 'https://www.stc.com.sa',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'شركة معادن',
                'description' => 'تطوير المنصات الرقمية الخاصة بالمشاريع الصناعية وأنظمة الاتصالات الداخلية.',
                'website' => 'https://www.maaden.com.sa',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'المؤسسة العامة لتحلية المياه',
                'description' => 'شريك في برمجة أنظمة التحكم الرقمي والمراقبة الذكية.',
                'website' => 'https://www.swcc.gov.sa',
                'order' => 5,
                'is_active' => false,
            ],
            [
                'name' => 'أرامكو السعودية',
                'description' => 'شريك استراتيجي في مجال الحلول الرقمية وإدارة أصول الطاقة والتحول الرقمي.',
                'website' => 'https://www.aramco.com',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'شركة سابك',
                'description' => 'التعاون والتطوير التقني لأنظمة تتبع سلاسل الإمداد ومراقبة الجودة.',
                'website' => 'https://www.sabic.com',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'شركة الاتصالات السعودية (STC)',
                'description' => 'شراكة تقنية في مجال الربط البرمجي والحوسبة السحابية والأمن السيبراني.',
                'website' => 'https://www.stc.com.sa',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'شركة معادن',
                'description' => 'تطوير المنصات الرقمية الخاصة بالمشاريع الصناعية وأنظمة الاتصالات الداخلية.',
                'website' => 'https://www.maaden.com.sa',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'المؤسسة العامة لتحلية المياه',
                'description' => 'شريك في برمجة أنظمة التحكم الرقمي والمراقبة الذكية.',
                'website' => 'https://www.swcc.gov.sa',
                'order' => 5,
                'is_active' => false,
            ],
            [
                'name' => 'أرامكو السعودية',
                'description' => 'شريك استراتيجي في مجال الحلول الرقمية وإدارة أصول الطاقة والتحول الرقمي.',
                'website' => 'https://www.aramco.com',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'شركة سابك',
                'description' => 'التعاون والتطوير التقني لأنظمة تتبع سلاسل الإمداد ومراقبة الجودة.',
                'website' => 'https://www.sabic.com',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'شركة الاتصالات السعودية (STC)',
                'description' => 'شراكة تقنية في مجال الربط البرمجي والحوسبة السحابية والأمن السيبراني.',
                'website' => 'https://www.stc.com.sa',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'شركة معادن',
                'description' => 'تطوير المنصات الرقمية الخاصة بالمشاريع الصناعية وأنظمة الاتصالات الداخلية.',
                'website' => 'https://www.maaden.com.sa',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'المؤسسة العامة لتحلية المياه',
                'description' => 'شريك في برمجة أنظمة التحكم الرقمي والمراقبة الذكية.',
                'website' => 'https://www.swcc.gov.sa',
                'order' => 5,
                'is_active' => false,
            ],
            [
                'name' => 'أرامكو السعودية',
                'description' => 'شريك استراتيجي في مجال الحلول الرقمية وإدارة أصول الطاقة والتحول الرقمي.',
                'website' => 'https://www.aramco.com',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'شركة سابك',
                'description' => 'التعاون والتطوير التقني لأنظمة تتبع سلاسل الإمداد ومراقبة الجودة.',
                'website' => 'https://www.sabic.com',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'شركة الاتصالات السعودية (STC)',
                'description' => 'شراكة تقنية في مجال الربط البرمجي والحوسبة السحابية والأمن السيبراني.',
                'website' => 'https://www.stc.com.sa',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'شركة معادن',
                'description' => 'تطوير المنصات الرقمية الخاصة بالمشاريع الصناعية وأنظمة الاتصالات الداخلية.',
                'website' => 'https://www.maaden.com.sa',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'المؤسسة العامة لتحلية المياه',
                'description' => 'شريك في برمجة أنظمة التحكم الرقمي والمراقبة الذكية.',
                'website' => 'https://www.swcc.gov.sa',
                'order' => 5,
                'is_active' => false,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}
