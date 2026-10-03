<?php

namespace Database\Factories;

use App\Models\Statistic;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatisticFactory extends Factory
{
    protected $model = Statistic::class;

    public function definition(): array
    {
        $icons = [
            'fas fa-calendar-alt',
            'fas fa-project-diagram',
            'fas fa-users',
            'fas fa-trophy',
            'fas fa-award',
            'fas fa-star',
        ];

        $statistics = [
            ['title' => 'سنوات الخبرة', 'value' => '15+', 'label' => 'عام من الخبرة'],
            ['title' => 'المشاريع المنجزة', 'value' => '250+', 'label' => 'مشروع ناجح'],
            ['title' => 'العملاء السعداء', 'value' => '180+', 'label' => 'عميل راضٍ'],
            ['title' => 'الجوائز المحصلة', 'value' => '35+', 'label' => 'جائزة وتقدير'],
        ];

        $stat = $this->faker->randomElement($statistics);

        return [
            'title' => $stat['title'],
            'value' => $stat['value'],
            'label' => $stat['label'],
            'icon' => $this->faker->randomElement($icons),
            'order' => $this->faker->numberBetween(0, 10),
            'is_active' => $this->faker->boolean(80),
        ];
    }
}
