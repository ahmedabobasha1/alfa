<?php

namespace Database\Seeders;

use App\Models\AboutStruct;
use Illuminate\Database\Seeder;

class AboutStructSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title_ar' => 'اهدافنا',
                'title_en' => 'Our Goals',
                'text_ar' => 'اهدافنا هي التي تجعلنا نصبح أفضل شركة في المملكة العربية السعودية',
                'text_en' => 'Our goals are what make us the best company in the Kingdom of Saudi Arabia',
                'status' => 1,
                'alt_icon' => 'اهدافنا',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_ar' => 'رسالتنا',
                'title_en' => 'Our Mission',
                'text_ar' => 'رسالتنا هي التي تجعلنا نصبح أفضل شركة في المملكة العربية السعودية',
                'text_en' => 'Our mission is what makes us the best company in the Kingdom of Saudi Arabia',
                'status' => 1,
                'alt_icon' => 'رسالتنا',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_ar' => 'رؤيتنا',
                'title_en' => 'Our Vision',
                'text_ar' => 'رؤيتنا هي التي تجعلنا نصبح أفضل شركة في المملكة العربية السعودية',
                'text_en' => 'Our vision is what makes us the best company in the Kingdom of Saudi Arabia',
                'status' => 1,
                'alt_icon' => 'رؤيتنا',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data as $item) {
            AboutStruct::create($item);
        }
    }
}
