<?php

namespace App\Services\Seo;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Models\Project;
use App\Models\Service;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class BuildSitemapService
{
    public function generateSitemap()
    {

        Sitemap::create()
            ->add($this->build_index(Blog::active()->get(), 'sitemap_blogs.xml'))
           // ->add($this->build_index(Category::active()->get(), 'sitemap_categories.xml'))
           // ->add($this->build_index(Project::active()->get(), 'sitemap_projects.xml'))
           // ->add($this->build_index(Product::active()->get(), 'sitemap_products.xml'))
            ->add($this->build_index(Service::active()->get(), 'sitemap_services.xml'))
            ->add(Url::create('/')->setPriority(1)->setChangeFrequency(Url::CHANGE_FREQUENCY_ALWAYS))
            ->add(Url::create('/about-us')->setPriority(0.5)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/contact-us')->setPriority(0.5)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->writeToFile(public_path('sitemap.xml'));

        $this->generateRobotsTxt();
    }

    protected function build_index($model, $path)
    {

        Sitemap::create()
            ->add($model)
            ->writeToFile(public_path($path));

        return $path;

    }

    private function generateRobotsTxt(): void
    {
        $lines = [
            'User-agent: *',
            'Disallow: /admin/',
            'Disallow: /dashboard/',
            'Allow: /',
            'Sitemap: '.url('sitemap.xml'),
            'Sitemap: '.url('sitemap_blogs.xml'),
            // "Sitemap: " . url('sitemap_categories.xml'),
            // "Sitemap: " . url('sitemap_projects.xml'),
            // "Sitemap: " . url('sitemap_products.xml'),
            'Sitemap: '.url('sitemap_services.xml'),
        ];

        file_put_contents(public_path('robots.txt'), implode("\n", $lines));
    }
}
