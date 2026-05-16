<?php

namespace Database\Factories;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Factories\Factory;

class SliderFactory extends Factory
{
    protected $model = Slider::class;

    public function definition()
    {
        return [
            'title_ar' => $this->faker->sentence(3),
            'title_en' => $this->faker->sentence(3),
            'title2_ar' => $this->faker->sentence(2),
            'title2_en' => $this->faker->sentence(2),
            'text_ar' => $this->faker->paragraph(1),
            'text_en' => $this->faker->paragraph(1),
            'second_text_ar' => $this->faker->paragraph(1),
            'second_text_en' => $this->faker->paragraph(1),
            'order' => $this->faker->numberBetween(1, 10),
            'alt_image_en' => $this->faker->words(2, true),
            'alt_image_ar' => $this->faker->words(2, true),
            'mobile_alt_image_en' => $this->faker->words(2, true),
            'mobile_alt_image_ar' => $this->faker->words(2, true),
            'status' => 1,
        ];
    }

    public function topHeader()
    {
        return $this->state([
            'type' => 'top_header',
        ]);
    }

    public function home()
    {
        return $this->state([
            'type' => 'home',
        ]);
    }

    public function offer()
    {
        return $this->state([
            'type' => 'offer',
        ]);
    }
}
