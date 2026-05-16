<?php

namespace App\Services\Seo\Modules;

class HomeSeoHandel extends BaseSeoHandler
{
    protected function getTitle(): string
    {
        return $this->seo->home_meta_title ?? '';
    }

    protected function getDescription(): string
    {
        return $this->seo->home_meta_desc ?? '';
    }

    protected function getCanonicalUrl(): string
    {
        return route('website.home');
    }

    protected function getIndexStatus(): bool
    {
        return $this->seo->home_index ?? true;
    }

    protected function getRouteName(): string
    {
        return 'website.home';
    }

    protected function buildSchema(): void
    {
        // 1. WebSite Schema
        $this->schemaGenerator->websiteSchema(
            $this->seo->author,
            route('website.home')
        );

        // 2. Organization Schema with contact info
        $this->addOrganizationWithContact();

        // 3. WebPage Schema
        $this->schemaGenerator->webPage(
            $this->seo->home_meta_title,
            $this->seo->home_meta_desc,
            route('website.home')
        );

        // 4. BreadcrumbList Schema
        $this->schemaGenerator->breadcrumbList([
            [
                'position' => 1,
                'name' => 'Home',
                'item' => route('website.home'),
            ],
        ]);
    }

    private function addOrganizationWithContact(): void
    {
        // Get contact information from settings
        $email = config('settings.site_email');
        $phone = config('settings.site_phone');

        $organizationSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $this->seo->author,
            'url' => route('website.home'),
            'logo' => $this->seo->image_path,
        ];

        // Add contact point if available
        if ($email || $phone) {
            $contactPoint = [
                '@type' => 'ContactPoint',
                'contactType' => 'customer service',
            ];

            if ($phone) {
                $contactPoint['telephone'] = $phone;
            }

            if ($email) {
                $contactPoint['email'] = $email;
            }

            $organizationSchema['contactPoint'] = $contactPoint;
        }

        $this->schemaGenerator->addSchema($organizationSchema);
    }
}
