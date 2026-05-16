<?php

namespace App\Services\Seo\Modules;

use App\Models\Project;

class ProjectDetailsSeoHandler extends BaseDetailSeoHandler
{
    public function __construct(Project $project)
    {
        parent::__construct($project);
    }

    protected function getRouteName(): string
    {
        return 'website.projectDetails';
    }

    protected function getRouteParameterName(): string
    {
        return 'project';
    }
}
