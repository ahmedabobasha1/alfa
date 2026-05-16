<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name_ar' => 'المدونة 1',
                'name_en' => 'Blog 1',
                'short_desc_ar' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.',
                'short_desc_en' => 'A paragraph is a series of related sentences developing a central idea, called the topic. Try to think about paragraphs in terms of thematic unity, and the paragraphs will be more successful.',
                'long_desc_ar' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.',
                'long_desc_en' => 'A paragraph is a series of related sentences developing a central idea, called the topic. Try to think about paragraphs in terms of thematic unity, and the paragraphs will be more successful.',
                'status' => 1,
                'show_in_home' => 1,
                'show_in_header' => 1,
                'slug_ar' => 'المدونة-1',
                'slug_en' => 'blog-1',
                'meta_title_ar' => 'المدونة 1',
                'meta_title_en' => 'Blog 1',
                'meta_desc_ar' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.',
                'meta_desc_en' => 'A paragraph is a series of related sentences developing a central idea, called the topic. Try to think about paragraphs in terms of thematic unity, and the paragraphs will be more successful.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'المدونة 2',
                'name_en' => 'Blog 2',
                'short_desc_ar' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.',
                'short_desc_en' => 'A paragraph is a series of related sentences developing a central idea, called the topic. Try to think about paragraphs in terms of thematic unity, and the paragraphs will be more successful.',
                'long_desc_ar' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.',
                'long_desc_en' => 'A paragraph is a series of related sentences developing a central idea, called the topic. Try to think about paragraphs in terms of thematic unity, and the paragraphs will be more successful.',
                'status' => 1,
                'show_in_home' => 1,
                'show_in_header' => 1,
                'slug_ar' => 'المدونة-2',
                'slug_en' => 'blog-2',
                'meta_title_ar' => 'المدونة 2',
                'meta_title_en' => 'Blog 2',
                'meta_desc_ar' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.',
                'meta_desc_en' => 'A paragraph is a series of related sentences developing a central idea, called the topic. Try to think about paragraphs in terms of thematic unity, and the paragraphs will be more successful.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'المدونة 3',
                'name_en' => 'Blog 3',
                'short_desc_ar' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.',
                'short_desc_en' => 'A paragraph is a series of related sentences developing a central idea, called the topic. Try to think about paragraphs in terms of thematic unity, and the paragraphs will be more successful.',
                'long_desc_ar' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.',
                'long_desc_en' => 'A paragraph is a series of related sentences developing a central idea, called the topic. Try to think about paragraphs in terms of thematic unity, and the paragraphs will be more successful.',
                'status' => 1,
                'show_in_home' => 1,
                'show_in_header' => 1,
                'slug_ar' => 'المدونة-3',
                'slug_en' => 'blog-3',
                'meta_title_ar' => 'المدونة 3',
                'meta_title_en' => 'Blog 3',
                'meta_desc_ar' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.',
                'meta_desc_en' => 'A paragraph is a series of related sentences developing a central idea, called the topic. Try to think about paragraphs in terms of thematic unity, and the paragraphs will be more successful.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data as $item) {
            Blog::create($item);
        }
    }
}
