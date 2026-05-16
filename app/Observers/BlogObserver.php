<?php

namespace App\Observers;

use App\Models\Blog;
use App\Services\Seo\BuildSitemapService;

class BlogObserver
{
    public function saved(Blog $blog)
    {
        app(BuildSitemapService::class)->generateSitemap();
    }

    public function deleting(Blog $blog)
    {
        app(BuildSitemapService::class)->generateSitemap();
    }

    public function deleted(Blog $blog)
    {
        app(BuildSitemapService::class)->generateSitemap();
    }

    public function forceDeleted(Blog $blog)
    {
        app(BuildSitemapService::class)->generateSitemap();
    }
}
