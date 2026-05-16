<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // One top_header
        // Slider::factory()->topHeader()->create();
        // One home slider
        Slider::factory()->home()->count(2)->create();
        // One offer slider
        Slider::factory()->offer()->count(2)->create();

    }
}
