<?php

namespace Database\Factories;

use App\Models\ContactMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactMessageFactory extends Factory
{
    protected $model = ContactMessage::class;

    public function definition(): array
    {
        $status = fake()->randomElement(['new', 'read', 'replied', 'archived']);
        $createdAt = fake()->dateTimeBetween('-6 months', 'now');

        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->optional(0.7)->phoneNumber(),
            'subject' => fake()->optional(0.8)->sentence(4),
            'message' => fake()->paragraph(3),
            'status' => $status,
            'admin_notes' => fake()->optional(0.4)->paragraph(2),
            'read_at' => $this->getReadAt($status, $createdAt),
            'replied_at' => $this->getRepliedAt($status, $createdAt),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }

    private function getReadAt(string $status, \DateTime $createdAt): ?\DateTime
    {
        if (in_array($status, ['read', 'replied', 'archived'])) {
            return fake()->dateTimeBetween($createdAt, 'now');
        }

        return null;
    }

    private function getRepliedAt(string $status, \DateTime $createdAt): ?\DateTime
    {
        if (in_array($status, ['replied', 'archived'])) {
            $readAt = $this->getReadAt($status, $createdAt);
            return fake()->dateTimeBetween($readAt ?? $createdAt, 'now');
        }

        return null;
    }

    public function statusNew(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'new',
            'read_at' => null,
            'replied_at' => null,
            'admin_notes' => null,
        ]);
    }

    public function statusRead(): static
    {
        return $this->state(function (array $attributes) {
            $createdAt = $attributes['created_at'] ?? now();
            return [
                'status' => 'read',
                'read_at' => fake()->dateTimeBetween($createdAt, 'now'),
                'replied_at' => null,
            ];
        });
    }

    public function statusReplied(): static
    {
        return $this->state(function (array $attributes) {
            $createdAt = $attributes['created_at'] ?? now();
            $readAt = fake()->dateTimeBetween($createdAt, 'now');
            return [
                'status' => 'replied',
                'read_at' => $readAt,
                'replied_at' => fake()->dateTimeBetween($readAt, 'now'),
                'admin_notes' => fake()->paragraph(2),
            ];
        });
    }

    public function statusArchived(): static
    {
        return $this->state(function (array $attributes) {
            $createdAt = $attributes['created_at'] ?? now();
            $readAt = fake()->dateTimeBetween($createdAt, 'now');
            return [
                'status' => 'archived',
                'read_at' => $readAt,
                'replied_at' => fake()->optional(0.7)->dateTimeBetween($readAt, 'now'),
                'admin_notes' => fake()->optional(0.6)->paragraph(2),
            ];
        });
    }
}
