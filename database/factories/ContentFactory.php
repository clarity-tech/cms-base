<?php

namespace Database\Factories;

use ClarityTech\Cms\Enums\ContentType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content>
 */
class ContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(6, true);

        return [
            // 'author_id' => Taxonomy::factory(), // FIXME: disabled author_id in content table temporarily
            'layout' => "default",
            'title' => $title,
            'slug' => Str::slug($title),
            'type' => fake()->randomElement(ContentType::cases()),
            'content' => fake()->paragraphs(3, true),
            'excerpt' => fake()->sentence(15, true),
            'meta_tags' => [fake()->word() => fake()->word()],
            'custom_properties' => [fake()->word() => fake()->word()],
            'order_column' => fake()->numberBetween(1, 100),
            'created_by' => User::factory(),
            'updated_by' => null,
            'deleted_by' => null,
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
