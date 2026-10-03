<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyInfo>
 */
class CompanyInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'description' => fake()->sentence(10),
            'about' => fake()->paragraph(5),
            'logo' => null,
            'email' => fake()->companyEmail(),
            'phone' => fake()->phoneNumber(),
            'whatsapp' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'city' => 'الرياض',
            'district' => 'السلي',
            'street' => fake()->streetName(),
            'founded_year' => fake()->numberBetween(1990, 2020),
            'working_hours' => 'الأحد - الخميس | 8:00 صباحاً - 5:00 مساءً',
            'facebook_url' => 'https://facebook.com/'.fake()->userName(),
            'twitter_url' => 'https://twitter.com/'.fake()->userName(),
            'linkedin_url' => 'https://linkedin.com/company/'.fake()->userName(),
            'instagram_url' => 'https://instagram.com/'.fake()->userName(),
            'tiktok_url' => 'https://tiktok.com/@'.fake()->userName(),
            'is_active' => true,
        ];
    }
}
