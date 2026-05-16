<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name_ar' => 'د. أحمد محمد',
                'name_en' => 'Dr. Ahmed Mohamed',
                'position_ar' => 'استشاري طب وجراحة العيون',
                'position_en' => 'Ophthalmology Consultant',
                'text_ar' => 'خبير في جراحات العيون الدقيقة',
                'text_en' => 'Expert in precision eye surgeries',
                'bio_ar' => 'استشاري متخصص في جراحة العيون مع خبرة تزيد عن 15 عامًا',
                'bio_en' => 'Specialist consultant in eye surgery with over 15 years of experience',
                'facebook' => 'https://facebook.com',
                'twitter' => 'https://twitter.com',
                'linkedin' => 'https://linkedin.com',
                'instagram' => 'https://instagram.com',
                'status' => 1,
                'show_in_home' => 1,
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'د. فاطمة علي',
                'name_en' => 'Dr. Fatima Ali',
                'position_ar' => 'أخصائية طب العيون',
                'position_en' => 'Ophthalmology Specialist',
                'text_ar' => 'متخصصة في جراحات الليزك والليزر',
                'text_en' => 'Specialized in LASIK and Laser surgeries',
                'bio_ar' => 'أخصائية في علاج أمراض العيون وجراحات الليزك',
                'bio_en' => 'Specialist in eye diseases treatment and LASIK surgeries',
                'facebook' => 'https://facebook.com',
                'twitter' => 'https://twitter.com',
                'linkedin' => 'https://linkedin.com',
                'instagram' => 'https://instagram.com',
                'status' => 1,
                'show_in_home' => 1,
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'د. محمود حسن',
                'name_en' => 'Dr. Mahmoud Hassan',
                'position_ar' => 'استشاري جراحة الشبكية',
                'position_en' => 'Retinal Surgery Consultant',
                'text_ar' => 'رائد في علاج أمراض الشبكية',
                'text_en' => 'Pioneer in retinal disease treatment',
                'bio_ar' => 'متخصص في جراحات الشبكية والجسم الزجاجي',
                'bio_en' => 'Specialist in retinal and vitreous surgeries',
                'facebook' => 'https://facebook.com',
                'twitter' => 'https://twitter.com',
                'linkedin' => 'https://linkedin.com',
                'instagram' => 'https://instagram.com',
                'status' => 1,
                'show_in_home' => 1,
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($data as $item) {
            Team::create($item);
        }
    }
}
