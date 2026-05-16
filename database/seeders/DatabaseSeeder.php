<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            AdminSeeder::class,
            MenuSeeder::class,
            SettingSeeder::class,
            SectionSeeder::class,
            AboutUsSeeder::class,
            SeoAssistantSeeder::class,
            SiteAddressSeeder::class,

            // local seeders
            SliderSeeder::class,
            AboutStructSeeder::class,
            CategorySeeder::class,
            FaqSeeder::class,
            BenefitSeeder::class,
            TestimonialSeeder::class,
            AttributeSeeder::class,
            AttributeValueSeeder::class,
            ServiceSeeder::class,

            ProductSeeder::class,
            BlogCategorySeeder::class,
            AuthorSeeder::class,
            BlogSeeder::class,
            ClientSeeder::class,
            StatisticSeeder::class,
            JobPositionSeeder::class,
            PageSeeder::class,

            PhoneSeeder::class,
            ProjectSeeder::class,
            TabSeeder::class, // Must be after ServiceSeeder and ProjectSeeder
            AlbumSeeder::class,
            PartenerSeeder::class,
            AnalyticsPermissionsSeeder::class,
            TeamSeeder::class,
        ]);
    }
}
