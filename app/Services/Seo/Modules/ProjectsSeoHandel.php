<?php

namespace App\Services\Seo\Modules;

class ProjectsSeoHandel extends BaseSeoHandler
{
    protected function getTitle(): string
    {
        return $this->seo->projects_meta_title ?? '';
    }

    protected function getDescription(): string
    {
        return $this->seo->projects_meta_desc ?? '';
    }

    protected function getCanonicalUrl(): string
    {
        return route('website.projects');
    }

    protected function getIndexStatus(): bool
    {
        return $this->seo->projects_index ?? true;
    }

    protected function getRouteName(): string
    {
        return 'website.projects';
    }
}
