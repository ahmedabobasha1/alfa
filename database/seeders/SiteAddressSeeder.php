<?php

namespace Database\Seeders;

use App\Models\SiteAddress;
use Illuminate\Database\Seeder;

class SiteAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create only head office address
        SiteAddress::create([
            'type' => 'head_office',
            'title_en' => 'Head Office',
            'title_ar' => 'المكتب الرئيسي',
            'address_en' => '123 Main Street, Business District, Cairo, Egypt',
            'address_ar' => '123 الشارع الرئيسي، الحي التجاري، القاهرة، مصر',
            'email' => 'info@begroup.com',
            'phone' => '+20 100 123 4567',
            'phone2' => '+20 100 765 4321',
            'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3452.5221691591773!2d31.330127787486845!3d30.079228310203483!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14583e176f99d6a5%3A0x92096e6818b66f6a!2s25%20Asmaa%20Fahmi%2C%20Al%20Golf%2C%20Heliopolis%2C%20Cairo%20Governorate%204451333!5e0!3m2!1sen!2seg!4v1745182621605!5m2!1sen!2seg',
            'order' => 1,
            'status' => true,
        ]);

        $this->command->info('Head office address created successfully.');
    }
}
