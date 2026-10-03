<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::truncate();

        Category::create([
            'name' => 'تطبيقات الجوال',
            'slug' => 'mobile-apps',
            'description' => 'تطبيقات الأندرويد و الآيفون الذكية',
            'icon' => 'fas fa-mobile-alt',
            'order' => 1,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'مواقع ومنصات الويب',
            'slug' => 'web-apps',
            'description' => 'المنصات الإلكترونية والمواقع التفاعلية',
            'icon' => 'fas fa-globe',
            'order' => 2,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'الأنظمة السحابية و ERP',
            'slug' => 'cloud-systems',
            'description' => 'أنظمة إدارة المؤسسات والموارد',
            'icon' => 'fas fa-server',
            'order' => 3,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'المتاجر الإلكترونية',
            'slug' => 'ecommerce',
            'description' => 'منصات ومتاجر البيع بالتجزئة والجملة',
            'icon' => 'fas fa-shopping-bag',
            'order' => 4,
            'is_active' => true,
        ]);
    }
}
