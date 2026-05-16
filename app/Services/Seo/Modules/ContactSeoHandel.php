<?php

namespace App\Services\Seo\Modules;

class ContactSeoHandel extends BaseSeoHandler
{
    protected function getTitle(): string
    {
        return $this->seo->contact_meta_title ?? '';
    }

    protected function getDescription(): string
    {
        return $this->seo->contact_meta_desc ?? '';
    }

    protected function getCanonicalUrl(): string
    {
        return route('website.contact-us');
    }

    protected function getIndexStatus(): bool
    {
        return $this->seo->contact_index ?? true;
    }

    protected function getRouteName(): string
    {
        return 'website.contact-us';
    }
}
