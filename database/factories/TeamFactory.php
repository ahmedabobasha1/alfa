<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_ar' => $this->faker->name(),
            'name_en' => $this->faker->name(),
            'position_ar' => $this->faker->jobTitle(),
            'position_en' => $this->faker->jobTitle(),
            'text_ar' => $this->faker->optional()->sentence(),
            'text_en' => $this->faker->optional()->sentence(),
            'bio_ar' => $this->faker->optional()->paragraph(),
            'bio_en' => $this->faker->optional()->paragraph(),
            'facebook' => $this->faker->optional()->url(),
            'twitter' => $this->faker->optional()->url(),
            'linkedin' => $this->faker->optional()->url(),
            'instagram' => $this->faker->optional()->url(),
            'status' => $this->faker->boolean(80), // 80% chance of being active
            'show_in_home' => $this->faker->boolean(50),
            'order' => $this->faker->numberBetween(0, 100),
        ];
    }
}
