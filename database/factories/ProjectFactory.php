<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(4),
            'image' => 'projects/default-project.jpg',
            'client_name' => fake()->optional(0.7)->company(),
            'completion_date' => fake()->optional(0.8)->dateTimeBetween('-2 years', 'now'),
            'location' => fake()->optional(0.6)->city(),
            'order' => fake()->numberBetween(0, 100),
            'is_featured' => fake()->boolean(30),
            'is_active' => fake()->boolean(85),
        ];
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
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
