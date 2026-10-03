<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    public function definition(): array
    {
        return [
            'client_name' => fake()->name(),
            'client_position' => fake()->jobTitle(),
            'client_company' => fake()->company(),
            'testimonial' => fake()->paragraph(3),
            'client_image' => null,
            'rating' => fake()->numberBetween(3, 5),
            'order' => fake()->numberBetween(0, 10),
            'is_active' => fake()->boolean(80),
        ];
    }
}
