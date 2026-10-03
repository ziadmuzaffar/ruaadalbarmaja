<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PartnerFactory extends Factory
{
    public function definition(): array
    {
        $companies = [
            'أرامكو السعودية',
            'سابك',
            'شركة الكهرباء السعودية',
            'المؤسسة العامة لتحلية المياه المالحة',
            'شركة معادن',
            'الخطوط السعودية',
        ];

        return [
            'name' => fake()->randomElement($companies),
            'image' => null,
            'description' => fake()->sentence(10),
            'website' => fake()->url(),
            'order' => fake()->numberBetween(0, 100),
            'is_active' => fake()->boolean(80),
        ];
    }
}
