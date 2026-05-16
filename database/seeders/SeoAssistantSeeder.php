<?php

namespace Database\Seeders;

use App\Models\SeoAssistant;
use Illuminate\Database\Seeder;

class SeoAssistantSeeder extends Seeder
{
    public function run(): void
    {
        SeoAssistant::updateOrCreate(
            ['id' => 1],
            [
                'home_meta_title_en' => 'Home',
                'home_meta_desc_en' => 'Welcome to our website, your trusted partner for exceptional services and solutions.',
                'home_meta_title_ar' => 'الصفحة الرئيسية',
                'home_meta_desc_ar' => 'مرحبًا بكم في شركتك، شريكك الموثوق للخدمات والحلول الاستثنائية.',
                'home_index' => true,

                'about_meta_title_en' => 'About Us',
                'about_meta_desc_en' => 'Learn more about our company, our mission, vision, and the values that drive us.',
                'about_meta_title_ar' => 'معلومات عنا',
                'about_meta_desc_ar' => 'تعرف على المزيد حول شركتنا، مهمتنا، رؤيتنا، والقيم التي تحركنا.',
                'about_index' => true,

                'contact_meta_title_en' => 'Contact Us',
                'contact_meta_desc_en' => 'Get in touch with our company for inquiries, support, or feedback.',
                'contact_meta_title_ar' => 'اتصل بنا',
                'contact_meta_desc_ar' => 'تواصل معنا للاستفسارات، الدعم، أو الملاحظات.',
                'contact_index' => true,

                'blogs_meta_title_en' => 'Blog',
                'blogs_meta_desc_en' => 'Read the latest news, insights, and updates from our company.',
                'blogs_meta_title_ar' => 'مدونة',
                'blogs_meta_desc_ar' => 'اقرأ أحدث الأخبار، الرؤى، والتحديثات على موقعنا.',
                'blogs_index' => true,

                'services_meta_title_en' => 'Our Services',
                'services_meta_desc_en' => 'Discover the range of services offered by our company to meet your needs.',
                'services_meta_title_ar' => 'خدماتنا',
                'services_meta_desc_ar' => 'اكتشف مجموعة الخدمات التي تقدمها شركتنا لتلبية احتياجاتك.',
                'services_index' => true,

                'products_meta_title_en' => 'Our Products',
                'products_meta_desc_en' => 'Explore the innovative products developed by our company.',
                'products_meta_title_ar' => 'منتجاتنا',
                'products_meta_desc_ar' => 'استكشف المنتجات المبتكرة التي طورتها شركتنا.',
                'products_index' => true,

                'projects_meta_title_en' => 'Our Projects',
                'projects_meta_desc_en' => 'Take a look at some of the successful projects completed, by our company.',
                'projects_meta_title_ar' => 'مشاريعنا',
                'projects_meta_desc_ar' => 'إلق نظرة على بعض المشاريع الناجحة التي أكملتها شركتنا.',
                'projects_index' => true,

                'categories_meta_title_en' => 'Our Categories',
                'categories_meta_desc_en' => 'Browse through the various categories of services and products offered by our company.',
                'categories_meta_title_ar' => 'فئاتنا',
                'categories_meta_desc_ar' => 'تصفح من خلال الفئات المختلفة من الخدمات والمنتجات التي تقدمها شركتنا.',
                'categories_index' => true,
            ]
        );
    }
}
