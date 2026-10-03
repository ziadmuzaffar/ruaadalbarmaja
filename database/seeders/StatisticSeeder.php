<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Statistic;

class StatisticSeeder extends Seeder
{
    public function run(): void
    {
        Statistic::truncate();

        $statistics = [
            [
                'title' => 'مشروع برمجي منجز',
                'value' => '+180',
                'label' => 'مشروع ناجح',
                'icon' => 'fas fa-check-circle',
                'order' => 1,
                'is_active' => true,
                'type' => 'manual',
            ],
            [
                'title' => 'نسبة رضا العملاء',
                'value' => '99%',
                'label' => 'رضا وتوصية',
                'icon' => 'fas fa-smile',
                'order' => 2,
                'is_active' => true,
                'type' => 'manual',
            ],
            [
                'title' => 'خبير ومطور برمجيات',
                'value' => '+45',
                'label' => 'مهندس ومطور',
                'icon' => 'fas fa-users',
                'order' => 3,
                'is_active' => true,
                'type' => 'manual',
            ],
            [
                'title' => 'ساعات دعم فني',
                'value' => '24/7',
                'label' => 'متابعة مستمرة',
                'icon' => 'fas fa-headset',
                'order' => 4,
                'is_active' => true,
                'type' => 'manual',
            ],
        ];

        foreach ($statistics as $stat) {
            Statistic::create($stat);
        }
    }
}
