<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\Service;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MigrateOldDatabase extends Command
{
    protected $signature = 'migrate:old-database';

    protected $description = 'Migrate all data from old database to new database structure';

    public function handle()
    {

        $this->migrateBlogs();
        $this->migrateServices();
    }

    private function migrateBlogs()
    {
        DB::connection('old_db')->disableQueryLog();
        $oldBlogs = DB::connection('old_db')->table('blogitems')->get();

        foreach ($oldBlogs as $key => $oldBlog) {
            Blog::create([
                'id' => $oldBlog->id,
                'name_en' => $oldBlog->title_en,
                'name_ar' => $oldBlog->title_ar,
                'date' => $oldBlog->date,
                'short_desc_en' => Str::limit($oldBlog->text_en, 200),
                'short_desc_ar' => Str::limit($oldBlog->text_ar, 200),
                'long_desc_en' => $oldBlog->text_en,
                'long_desc_ar' => $oldBlog->text_ar,
                'image' => $oldBlog->image,
                'alt_image' => $oldBlog->alt_img,
                'meta_title_en' => $oldBlog->meta_title_en,
                'meta_title_ar' => $oldBlog->meta_title_ar,
                'meta_desc_en' => $oldBlog->meta_desc_en,
                'meta_desc_ar' => $oldBlog->meta_desc_ar,
                'slug_en' => $oldBlog->link_en,
                'slug_ar' => $oldBlog->link_ar,
                'status' => $oldBlog->status == null ? true : $oldBlog->status,
                'show_in_home' => true,
                'show_in_header' => false,
                'show_in_footer' => false,
                'index' => $oldBlog->meta_robots,
                'order' => $key + 1,
                'created_at' => $oldBlog->created_at,
                'updated_at' => $oldBlog->updated_at,
            ]);
        }
        $this->info('Blogs migrated successfully');
    }

    private function migrateServices()
    {
        DB::connection('old_db')->disableQueryLog();
        $oldServices = DB::connection('old_db')->table('services')->get();
        foreach ($oldServices as $key => $oldService) {
            Service::create([
                'id' => $oldService->id,
                'name_en' => $oldService->name_en,
                'name_ar' => $oldService->name_ar,
                'short_desc_en' => Str::limit($oldService->text_en, 150),
                'short_desc_ar' => Str::limit($oldService->text_ar, 150),
                'long_desc_en' => $oldService->text_en,
                'long_desc_ar' => $oldService->text_ar,
                'image' => $oldService->img,
                'alt_image' => $oldService->alt_img ?? $oldService->name_en,
                'meta_title_en' => $oldService->meta_title_en,
                'meta_title_ar' => $oldService->meta_title_ar,
                'meta_desc_en' => $oldService->meta_desc_en,
                'meta_desc_ar' => $oldService->meta_desc_ar,
                'slug_en' => $oldService->link_en,
                'slug_ar' => $oldService->link_ar,
                'status' => $oldService->status == null ? true : $oldService->status,
                'show_in_home' => true,
                'show_in_header' => false,
                'show_in_footer' => false,
                'index' => $oldService->meta_robots,
                'order' => $key + 1,
                'created_at' => $oldService->created_at,
                'updated_at' => $oldService->updated_at,
            ]);
        }
    }
}
