<?php

namespace App\Services\Seo\Modules;

use App\Interfaces\SeoHandlerInterface;
use App\Models\SeoAssistant;
use App\Services\Seo\SchemaGenerator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

abstract class BaseSeoHandler implements SeoHandlerInterface
{
    protected SeoAssistant $seo;

    protected SchemaGenerator $schemaGenerator;

    public function __construct(SeoAssistant $seo)
    {
        $this->seo = $seo;
        $this->schemaGenerator = new SchemaGenerator;
    }

    /**
     * Get the meta title from SEO model
     */
    abstract protected function getTitle(): string;

    /**
     * Get the meta description from SEO model
     */
    abstract protected function getDescription(): string;

    /**
     * Get the canonical URL
     */
    abstract protected function getCanonicalUrl(): string;

    /**
     * Get the index status
     */
    abstract protected function getIndexStatus(): bool;

    /**
     * Get the route name for hreflang
     */
    abstract protected function getRouteName(): string;

    /**
     * Get route parameters for hreflang (override if needed)
     */
    protected function getRouteParameters(): array
    {
        return [];
    }

    /**
     * Build custom schema (override if needed)
     */
    protected function buildSchema(): void
    {
        $this->schemaGenerator->websiteSchema(
            $this->seo->author,
            $this->getCanonicalUrl()
        );
    }

    public function getMetaTags(): array
    {
        return [
            'content_type' => 'text/html; charset=utf-8',
            'title' => $this->getTitle(),
            'author' => $this->seo->author,
            'description' => $this->getDescription(),
            'canonical' => $this->getCanonicalUrl(),
            'robots' => $this->getIndexStatus() ? 'index' : 'noindex',
        ];
    }

    public function getOpenGraph(): array
    {
        return [
            'og:title' => $this->getTitle(),
            'og:description' => $this->getDescription(),
            'og:url' => $this->getCanonicalUrl(),
            'og:image' => $this->seo->image_path ?? '',
            'og:type' => 'article',
        ];
    }

    public function getTwitterCard(): array
    {
        return [
            'twitter:card' => 'summary_large_image',
            'twitter:title' => $this->getTitle(),
            'twitter:description' => $this->getDescription(),
            'twitter:image' => $this->seo->image_path ?? '',
        ];
    }

    public function getHreflangTags(): array
    {
        $hreflangTags = [];
        $supportedLocales = array_keys(LaravelLocalization::getSupportedLocales());
        $routeName = $this->getRouteName();
        $routeParams = $this->getRouteParameters();

        foreach ($supportedLocales as $locale) {
            $hreflangTags[$locale] = LaravelLocalization::localizeURL(
                route($routeName, $routeParams, false),
                $locale
            );
        }

        // Add x-default
        $defaultLang = config('app.locale');
        $hreflangTags['x-default'] = LaravelLocalization::localizeURL(
            route($routeName, $routeParams, false),
            $defaultLang
        );

        return $hreflangTags;
    }

    public function getSchema(): array
    {
        $this->buildSchema();

        return $this->schemaGenerator->generateSchema();
    }

    public function renderMetaTags(): string
    {
        $metaTags = $this->getMetaTags();
        $openGraph = $this->getOpenGraph();
        $twitterCard = $this->getTwitterCard();
        $hreflangTags = $this->getHreflangTags();

        return view('components.seo.meta-tags', compact('metaTags', 'openGraph', 'twitterCard', 'hreflangTags'))->render();
    }

    public function renderSchema(): string
    {
        $schemaArray = $this->getSchema();

        if (empty($schemaArray)) {
            return '';
        }

        $json = json_encode($schemaArray, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

        return '<script type="application/ld+json">'.$json.'</script>';
    }

    /**
     * Get all meta tags formatted for API response
     */
    public function getMetaTagsForApi(): array
    {
        return [
            'meta_tags' => $this->getMetaTags(),
            'open_graph' => $this->getOpenGraph(),
            'twitter_card' => $this->getTwitterCard(),
            'hreflang_tags' => $this->getHreflangTags(),
        ];
    }

    /**
     * Get schema formatted for API response
     */
    public function getSchemaForApi(): array
    {
        return $this->getSchema();
    }

    /**
     * Get all SEO data for API response
     */
    public function getSeoDataForApi(): array
    {
        return [
            'meta' => $this->getMetaTagsForApi(),
            'schema' => $this->getSchemaForApi(),
        ];
    }
}
