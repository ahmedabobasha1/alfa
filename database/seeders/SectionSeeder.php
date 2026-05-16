<?php

namespace Database\Seeders;

use App\Enums\SectionType;
use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            [
                'key' => SectionType::SERVICES,
                'title_en' => 'Our Services',
                'title_ar' => 'خدماتنا',
                'second_title_en' => 'Our Services',
                'second_title_ar' => 'خدماتنا',
                'short_desc_en' => 'Our Services',
                'short_desc_ar' => 'خدماتنا',
                'long_desc_en' => 'Our Services',
                'long_desc_ar' => 'خدماتنا',
                'status' => 1,
            ],
            [
                'key' => SectionType::PROJECTS,
                'title_en' => 'Our Projects',
                'title_ar' => 'المشاريع',
                'second_title_en' => 'Our Projects',
                'second_title_ar' => 'المشاريع',
                'short_desc_en' => 'Our Projects',
                'short_desc_ar' => 'المشاريع',
            ],

            [
                'key' => SectionType::CONTACT_SECTION,
                'title_en' => 'Contact Us',
                'title_ar' => 'تواصل معنا',
                'second_title_en' => 'Contact Us',
                'second_title_ar' => 'تواصل معنا',
                'short_desc_en' => 'Contact Us',
                'short_desc_ar' => 'تواصل معنا',
            ],

            [
                'key' => SectionType::SERVICES_PAGE,
                'title_en' => 'Our Services',
                'title_ar' => 'خدماتنا',
                'second_title_en' => 'Our Services',
                'second_title_ar' => 'خدماتنا',
                'short_desc_en' => 'We offer a wide range of services to meet your needs',
                'short_desc_ar' => 'نقدم مجموعة واسعة من الخدمات لتلبية احتياجاتك',
                'status' => 1,
            ],

            [
                'key' => SectionType::BLOGS,
                'title_en' => 'Stay Inspired with Our Blog',
                'title_ar' => 'ابق على اطلاع بمدونتنا',
                'second_title_en' => 'Recent News',
                'second_title_ar' => 'الأخبار الأخيرة',
                'short_desc_en' => 'The latest news and updates',
                'short_desc_ar' => 'أحدث الأخبار والتحديثات',
            ],

            [
                'key' => SectionType::CONTACT_US,
                'title_en' => 'Get in Touch',
                'title_ar' => 'تواصل معنا',
                'second_title_en' => 'Have Questions About Your Vascular Health? Let’s Talk!',
                'second_title_ar' => 'هل لديك أسئلة حول صحة الأوعية الدموية؟ لنتحدث!',
                'short_desc_en' => 'Have Questions About Your Vascular Health? Let’s Talk!',
                'short_desc_ar' => 'هل لديك أسئلة حول صحة الأوعية الدموية؟ لنتحدث!',
                'status' => 1,
            ],

            [
                'key' => SectionType::BREADCRUMB,
                'title_en' => 'Banner',
                'title_ar' => 'البانر',
                'second_title_en' => 'About Us',
                'second_title_ar' => 'عنا',
                'status' => 1,
            ],
        ];

        foreach ($data as $item) {
            Section::create($item);
        }
    }
}
