<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        return [
            'title_ar' => fake()->sentence(3),
            'title_en' => fake()->sentence(3),
            'description_ar' => fake()->paragraph(),
            'description_en' => fake()->paragraph(),
            'icon' => 'fas fa-'.fake()->randomElement(['cog', 'tools', 'building', 'oil-can', 'headset']),
            'image' => null,
            'order' => fake()->numberBetween(0, 100),
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
