<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'تطوير الويب',
            'تطبيقات الموبايل',
            'التصميم الجرافيكي',
            'التسويق الرقمي',
            'الذكاء الاصطناعي',
            'الأمن السيبراني',
            'تحليل البيانات',
            'الحوسبة السحابية',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->optional()->paragraph(),
            'icon' => fake()->randomElement([
                'fas fa-code',
                'fas fa-mobile-alt',
                'fas fa-paint-brush',
                'fas fa-bullhorn',
                'fas fa-brain',
                'fas fa-shield-alt',
                'fas fa-chart-line',
                'fas fa-cloud',
            ]),
            'order' => fake()->numberBetween(0, 10),
            'is_active' => fake()->boolean(80),
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
