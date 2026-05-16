<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name_ar = $this->faker->unique()->word;
        $name_en = $this->faker->unique()->word;

        return [
            'parent_id' => Product::inRandomOrder()->first()?->id, // Random parent ID or null
            'category_id' => \App\Models\Category::inRandomOrder()->first()?->id, // Random category ID or null
            'name_ar' => $this->faker->unique()->word,
            'name_en' => $this->faker->unique()->word,
            'short_desc_en' => $this->faker->sentence(),
            'short_desc_ar' => $this->faker->sentence(),
            'long_desc_en' => $this->faker->paragraph(),
            'long_desc_ar' => $this->faker->paragraph(),
            'alt_image' => $this->faker->word(),
            'alt_icon' => $this->faker->word(),
            'order' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->boolean(60),
            'show_in_home' => $this->faker->boolean(70),
            'show_in_header' => $this->faker->boolean(50),
            'show_in_footer' => $this->faker->boolean(50),
            'slug_ar' => preg_replace('/[\/\\\ ]/', '-', $name_ar),
            'slug_en' => preg_replace('/[\/\\\ ]/', '-', $name_en),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
