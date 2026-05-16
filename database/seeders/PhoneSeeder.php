<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $phones = [
            [
                'name_ar' => 'هاتف المبيعات',
                'name_en' => 'Sales Phone',
                'phone' => '501234567',
                'code' => '966',
                'email' => 'sales@site.com',
                'description_ar' => 'هاتف مخصص للمبيعات والاستفسارات العامة',
                'description_en' => 'Phone dedicated to sales and general inquiries',
                'order' => 1,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'هاتف الدعم الفني',
                'name_en' => 'Technical Support Phone',
                'phone' => '107654321',
                'code' => '20',
                'email' => 'support@site.com',
                'description_ar' => 'هاتف مخصص للدعم الفني وحل المشاكل',
                'description_en' => 'Phone dedicated to technical support and problem solving',
                'order' => 2,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'هاتف الطوارئ',
                'name_en' => 'Emergency Phone',
                'phone' => '509876543',
                'code' => '966',
                'email' => 'emergency@site.com',
                'description_ar' => 'هاتف مخصص للطوارئ والحالات العاجلة',
                'description_en' => 'Phone dedicated to emergencies and urgent cases',
                'order' => 3,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'هاتف الإدارة',
                'name_en' => 'Management Phone',
                'phone' => '111222333',
                'code' => '20',
                'email' => 'admin@site.com',
                'description_ar' => 'هاتف مخصص للإدارة والشؤون الإدارية',
                'description_en' => 'Phone dedicated to management and administrative affairs',
                'order' => 4,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('phones')->insert($phones);
    }
}
