<?php

namespace Database\Seeders;

use App\Enums\MenuRouteName;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name_en' => 'Home',
                'name_ar' => 'الرئيسية',
                'route_name' => MenuRouteName::HOME->value,
                'parent_id' => null,
                'order' => 1,
                'status' => true,
            ],
            [
                'name_en' => 'About Us',
                'name_ar' => 'من نحن',
                'route_name' => MenuRouteName::ABOUT_US->value,
                'parent_id' => null,
                'order' => 2,
                'status' => true,
            ],
            [
                'name_en' => 'services',
                'name_ar' => 'الخدمات',
                'route_name' => MenuRouteName::SERVICES->value,
                'parent_id' => null,
                'order' => 3,
                'status' => true,
            ],
            [
                'name_en' => 'Projects',
                'name_ar' => 'المشاريع',
                'route_name' => MenuRouteName::PROJECTS->value,
                'parent_id' => null,
                'order' => 4,
                'status' => true,
            ],
            // [
            //     'name_en' => 'Gallery',
            //     'name_ar' => 'المعرض',
            //     'route_name' => MenuRouteName::GALLERY->value,
            //     'parent_id' => null,
            //     'order' => 4,
            //     'status' => true,
            // ],

            // [
            //     'name_en' => 'Blogs',
            //     'name_ar' => 'المدونة',
            //     'route_name' => MenuRouteName::BLOGS->value,
            //     'parent_id' => null,
            //     'order' => 5,
            //     'status' => true,
            // ],
            [
                'name_en' => 'Contact Us',
                'name_ar' => 'تواصل معنا',
                'route_name' => MenuRouteName::CONTACT_US->value,
                'parent_id' => null,
                'order' => 5,
                'status' => true,
            ],

        ];

        foreach ($data as $item) {
            Menu::updateOrCreate(
                ['route_name' => $item['route_name']],
                $item
            );
        }

    }
}
