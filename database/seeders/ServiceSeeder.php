<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name_ar' => 'الخدمة 1',
                'name_en' => 'Service 1',
                'short_desc_ar' => 'الخدمة 1 سريعة وآمنة',
                'short_desc_en' => 'Fast and secure service 1',
                'long_desc_ar' => 'الخدمة 1 موثوق وسريع مع دعم فني على مدار الساعة',
                'long_desc_en' => 'Reliable and fast service 1 with 24/7 support',
                'status' => 1,
                'show_in_home' => 1,
                'show_in_header' => 1,
                'slug_ar' => 'الخدمة-1',
                'slug_en' => 'service-1',
                'meta_title_ar' => 'الخدمة 1',
                'meta_title_en' => 'Service 1',
                'meta_desc_ar' => 'الخدمة 1 موثوق وسريع مع دعم فني على مدار الساعة',
                'meta_desc_en' => 'Reliable and fast service 1 with 24/7 support',
                'index' => 1,
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'الخدمة 2',
                'name_en' => 'Service 2',
                'short_desc_ar' => 'الخدمة 2 سريعة وآمنة',
                'short_desc_en' => 'Fast and secure service 2',
                'long_desc_ar' => 'الخدمة 2 موثوق وسريع مع دعم فني على مدار الساعة',
                'long_desc_en' => 'Reliable and fast service 2 with 24/7 support',
                'status' => 1,
                'show_in_home' => 1,
                'show_in_header' => 1,
                'slug_ar' => 'الخدمة-2',
                'slug_en' => 'service-2',
                'meta_title_ar' => 'الخدمة 2',
                'meta_title_en' => 'Service 2',
                'meta_desc_ar' => 'الخدمة 2 موثوق وسريع مع دعم فني على مدار الساعة',
                'meta_desc_en' => 'Reliable and fast service 2 with 24/7 support',
                'index' => 1,
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'الخدمة 3',
                'name_en' => 'Service 3',
                'short_desc_ar' => 'الخدمة 3 سريعة وآمنة',
                'short_desc_en' => 'Fast and secure service 3',
                'long_desc_ar' => 'الخدمة 3 موثوق وسريع مع دعم فني على مدار الساعة',
                'long_desc_en' => 'Reliable and fast service 3 with 24/7 support',
                'status' => 1,
                'show_in_home' => 1,
                'show_in_header' => 1,
                'slug_ar' => 'الخدمة-3',
                'slug_en' => 'service-3',
                'meta_title_ar' => 'الخدمة 3',
                'meta_title_en' => 'Service 3',
                'meta_desc_ar' => 'الخدمة 3 موثوق وسريع مع دعم فني على مدار الساعة',
                'meta_desc_en' => 'Reliable and fast service 3 with 24/7 support',
                'index' => 1,
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data as $item) {
            Service::create($item);
        }
    }
}
