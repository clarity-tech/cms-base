<?php

namespace ClarityTech\Cms\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Taxonomy>
 */
class TaxonomyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'type_of' => fake()->randomElement(['Category', 'Tag', 'Author']),
            'custom_properties' => [fake()->word() => fake()->word()],
            'created_by' => User::factory(),
            'updated_by' => null,
            'deleted_by' => null
        ];
    }
}
