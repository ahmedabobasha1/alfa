<?php

namespace App\Observers;

use App\Models\Project as ModelsProject;
use App\Services\Seo\BuildSitemapService;

class ProjectObserver
{
    public function saved(ModelsProject $project)
    {
        app(BuildSitemapService::class)->generateSitemap();
    }

    public function deleting(ModelsProject $project)
    {
        app(BuildSitemapService::class)->generateSitemap();
    }

    public function deleted(ModelsProject $project)
    {

        app(BuildSitemapService::class)->generateSitemap();
    }

    public function forceDeleted(ModelsProject $project)
    {

        app(BuildSitemapService::class)->generateSitemap();
    }
}
