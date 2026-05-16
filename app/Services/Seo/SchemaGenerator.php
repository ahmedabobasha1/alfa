<?php

namespace App\Services\Seo;

use App\Interfaces\SchemaGeneratorInterface;

class SchemaGenerator implements SchemaGeneratorInterface
{
    private $schema = [];

    public function generateSchema(): array
    {

        return $this->schema;
    }

    public function toJson(): string
    {
        return json_encode($this->generateSchema(), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    public function toScript(): string
    {

        if (empty($this->schema)) {
            return '';
        }

        return '<script type="application/ld+json">'.$this->toJson().'</script>';
    }

    public function addSchema(array $schema)
    {

        $this->schema[] = $schema;

        return $this;
    }

    // Common schema types
    public function websiteSchema(string $name, string $url): self
    {
        $this->addSchema([
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => $name,
            'url' => $url,
        ]);

        return $this;
    }

    public function organization(string $name, string $url, string $logo): self
    {
        $this->addSchema([
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $name,
            'url' => $url,
            'logo' => $logo,
        ]);

        return $this;
    }

    public function article(string $title, string $description, string $url, string $image, string $datePublished): self
    {
        $this->addSchema([
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $title,
            'description' => $description,
            'url' => $url,
            'image' => $image,
            'datePublished' => $datePublished,
        ]);

        return $this;
    }

    public function webPage(string $title, string $description, string $url): self
    {
        $this->addSchema([
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => $title,
            'description' => $description,
            'url' => $url,
            'isPartOf' => [
                '@type' => 'WebSite',
                '@id' => $url.'#website',
            ],
        ]);

        return $this;
    }

    public function breadcrumbList(array $items): self
    {
        $this->addSchema([
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => array_map(function ($item) {
                return [
                    '@type' => 'ListItem',
                    'position' => $item['position'],
                    'name' => $item['name'],
                    'item' => $item['item'],
                ];
            }, $items),
        ]);

        return $this;
    }

    public function searchAction(string $targetUrl, string $queryInput = 'required name=search_term_string'): self
    {
        $this->addSchema([
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => $targetUrl,
                'query-input' => $queryInput,
            ],
        ]);

        return $this;
    }
}
