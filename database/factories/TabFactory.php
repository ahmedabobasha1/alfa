<?php

namespace Database\Factories;

use App\Models\Tab;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tab>
 */
class TabFactory extends Factory
{
    protected $model = Tab::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_en' => fake()->words(3, true),
            'name_ar' => fake()->words(3, true),
            'short_desc_en' => fake()->sentence(10),
            'short_desc_ar' => fake()->sentence(10),
            'long_desc_en' => fake()->paragraphs(3, true),
            'long_desc_ar' => fake()->paragraphs(3, true),
            'icon' => null, // Will be handled separately if needed
            'alt_icon' => fake()->words(3, true),
            'status' => fake()->boolean(80), // 80% chance of being active
            'order' => fake()->numberBetween(1, 10),
        ];
    }

    /**
     * Indicate that the tab is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => true,
        ]);
    }

    /**
     * Indicate that the tab is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => false,
        ]);
    }

    /**
     * Set a specific order for the tab.
     */
    public function order(int $order): static
    {
        return $this->state(fn (array $attributes) => [
            'order' => $order,
        ]);
    }
}
