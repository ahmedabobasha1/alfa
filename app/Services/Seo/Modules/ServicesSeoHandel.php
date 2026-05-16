<?php

namespace App\Services\Seo\Modules;

class ServicesSeoHandel extends BaseSeoHandler
{
    protected function getTitle(): string
    {
        return $this->seo->services_meta_title ?? '';
    }

    protected function getDescription(): string
    {
        return $this->seo->services_meta_desc ?? '';
    }

    protected function getCanonicalUrl(): string
    {
        return route('website.services');
    }

    protected function getIndexStatus(): bool
    {
        return $this->seo->services_index ?? true;
    }

    protected function getRouteName(): string
    {
        return 'website.services';
    }
}
