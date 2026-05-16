<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Service;
use App\Models\Tab;
use Illuminate\Database\Seeder;

class TabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create tabs for services
        $this->createServiceTabs();

        // Create tabs for projects
        $this->createProjectTabs();
    }

    /**
     * Create tabs for services
     */
    private function createServiceTabs(): void
    {
        $services = Service::all();

        if ($services->isEmpty()) {
            $this->command->warn('No services found. Skipping service tabs seeding.');

            return;
        }

        $this->command->info('Creating tabs for services...');

        foreach ($services->take(5) as $service) { // Create tabs for first 5 services
            $tabCount = rand(2, 5); // Random number of tabs per service

            for ($i = 1; $i <= $tabCount; $i++) {
                Tab::create([
                    'tabbable_id' => $service->id,
                    'tabbable_type' => Service::class,
                    'name_en' => "Service Tab {$i} - {$service->name_en}",
                    'name_ar' => "تبويب الخدمة {$i} - {$service->name_ar}",
                    'short_desc_en' => "Short description for service tab {$i}",
                    'short_desc_ar' => "وصف قصير لتبويب الخدمة {$i}",
                    'long_desc_en' => "<p>This is a detailed description for tab {$i} of service {$service->name_en}. It includes comprehensive information about this particular aspect of the service.</p><p>The content can be structured with multiple paragraphs and HTML formatting.</p>",
                    'long_desc_ar' => "<p>هذا وصف تفصيلي للتبويب {$i} من الخدمة {$service->name_ar}. يتضمن معلومات شاملة عن هذا الجانب المحدد من الخدمة.</p><p>يمكن تنظيم المحتوى بفقرات متعددة وتنسيق HTML.</p>",
                    'icon' => null,
                    'alt_icon' => "Tab {$i} Icon",
                    'status' => true,
                    'order' => $i,
                ]);
            }

            $this->command->info("Created {$tabCount} tabs for service: {$service->name_en}");
        }
    }

    /**
     * Create tabs for projects
     */
    private function createProjectTabs(): void
    {
        $projects = Project::all();

        if ($projects->isEmpty()) {
            $this->command->warn('No projects found. Skipping project tabs seeding.');

            return;
        }

        $this->command->info('Creating tabs for projects...');

        foreach ($projects->take(5) as $project) { // Create tabs for first 5 projects
            $tabCount = rand(2, 4); // Random number of tabs per project

            for ($i = 1; $i <= $tabCount; $i++) {
                Tab::create([
                    'tabbable_id' => $project->id,
                    'tabbable_type' => Project::class,
                    'name_en' => "Project Tab {$i} - {$project->name_en}",
                    'name_ar' => "تبويب المشروع {$i} - {$project->name_ar}",
                    'short_desc_en' => "Short description for project tab {$i}",
                    'short_desc_ar' => "وصف قصير لتبويب المشروع {$i}",
                    'long_desc_en' => "<p>This is a detailed description for tab {$i} of project {$project->name_en}. It showcases important aspects and features of this project component.</p><p>Additional details and specifications can be added here.</p>",
                    'long_desc_ar' => "<p>هذا وصف تفصيلي للتبويب {$i} من المشروع {$project->name_ar}. يعرض الجوانب والميزات المهمة لمكون المشروع هذا.</p><p>يمكن إضافة تفاصيل ومواصفات إضافية هنا.</p>",
                    'icon' => null,
                    'alt_icon' => "Tab {$i} Icon",
                    'status' => true,
                    'order' => $i,
                ]);
            }

            $this->command->info("Created {$tabCount} tabs for project: {$project->name_en}");
        }
    }
}
