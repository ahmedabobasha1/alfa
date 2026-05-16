<?php

namespace App\Observers;

use App\Models\Service;
use App\Services\Seo\BuildSitemapService;

class ServiceObserver
{
    public function saved(Service $service)
    {
        app(BuildSitemapService::class)->generateSitemap();
    }

    public function deleting(Service $service)
    {
        app(BuildSitemapService::class)->generateSitemap();
    }

    public function deleted(Service $service)
    {
        // No cache clearing needed - cache is disabled
        app(BuildSitemapService::class)->generateSitemap();
    }

    public function forceDeleted(Service $service)
    {
        // No cache clearing needed - cache is disabled
        app(BuildSitemapService::class)->generateSitemap();
    }
}
