<?php

namespace App\Services\Seo;

use Google\Client as GoogleClient;
use Google\Service\SearchConsole\ApiDimensionFilter;
use Google\Service\SearchConsole\ApiDimensionFilterGroup;
use Google\Service\SearchConsole as GoogleSearchConsole;
use Google\Service\SearchConsole\SearchAnalyticsQueryRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class SearchConsoleService
{
    private GoogleClient $client;

    private GoogleSearchConsole $service;

    private ?string $siteUrl;

    public function __construct()
    {
        $config = config('google.search_console');

        $this->siteUrl = $config['site_url'];

        $client = new GoogleClient;
        $client->setApplicationName(config('app.name').' Search Console');
        $client->setScopes($config['scopes'] ?? [GoogleSearchConsole::WEBMASTERS_READONLY]);

        $keyFile = $config['key_file'];
        if (! is_null($keyFile) && is_string($keyFile) && file_exists($keyFile)) {
            $client->setAuthConfig($keyFile);
        } else {
            // Allow JSON content via env inline
            $json = env('GOOGLE_SC_CREDENTIALS_JSON');
            if ($json) {
                $client->setAuthConfig(json_decode($json, true));
            }
        }

        if (! empty($config['impersonate_user'])) {
            $client->setSubject($config['impersonate_user']);
        }

        $this->client = $client;
        $this->service = new GoogleSearchConsole($client);
    }

    public function getVerifiedSites(): array
    {
        $sites = $this->service->sites->listSites();

        return array_map(static fn ($s) => $s->siteUrl, $sites->getSiteEntry() ?? []);
    }

    public function querySearchAnalytics(
        ?string $siteUrl,
        string $startDate,
        string $endDate,
        array $dimensions = ['date'],
        int $rowLimit = 1000,
        int $startRow = 0,
        ?array $dimensionFilter = null
    ): array {
        $site = $siteUrl ?: $this->siteUrl;
        if (! $site) {
            throw new \InvalidArgumentException('Search Console site URL is not configured.');
        }

        $request = new SearchAnalyticsQueryRequest;
        $request->setStartDate($startDate);
        $request->setEndDate($endDate);
        $request->setDimensions($dimensions);
        $request->setRowLimit($rowLimit);
        $request->setStartRow($startRow);

        if ($dimensionFilter) {
            $filters = [];
            foreach ($dimensionFilter as $filter) {
                $f = new ApiDimensionFilter;
                $f->setDimension($filter['dimension']);
                $f->setOperator($filter['operator'] ?? 'equals');
                $f->setExpression($filter['expression']);
                $filters[] = $f;
            }
            $group = new ApiDimensionFilterGroup;
            $group->setFilters($filters);
            $group->setGroupType('and');
            $request->setDimensionFilterGroups([$group]);
        }

        try {
            $response = $this->service->searchanalytics->query($site, $request);

            return $response->getRows() ? array_map(static function ($row) {
                return [
                    'keys' => $row->getKeys(),
                    'clicks' => $row->getClicks(),
                    'impressions' => $row->getImpressions(),
                    'ctr' => $row->getCtr(),
                    'position' => $row->getPosition(),
                ];
            }, $response->getRows()) : [];
        } catch (\Throwable $e) {
            Log::error('Search Console query error: '.$e->getMessage());

            return [];
        }
    }

    public function getSummaryLast28Days(?string $siteUrl = null): array
    {
        $end = Carbon::today();
        $start = $end->copy()->subDays(28);
        $rows = $this->querySearchAnalytics(
            $siteUrl,
            $start->toDateString(),
            $end->toDateString(),
            ['date'],
            1000
        );

        $totalClicks = 0.0;
        $totalImpressions = 0.0;
        $avgCtr = 0.0;
        $avgPosition = 0.0;
        $n = max(count($rows), 1);

        foreach ($rows as $r) {
            $totalClicks += $r['clicks'];
            $totalImpressions += $r['impressions'];
            $avgCtr += $r['ctr'];
            $avgPosition += $r['position'];
        }

        return [
            'clicks' => (int) round($totalClicks),
            'impressions' => (int) round($totalImpressions),
            'ctr' => $avgCtr / $n,
            'position' => $n > 0 ? $avgPosition / $n : 0,
            'series' => $rows,
            'start' => $start->toDateString(),
            'end' => $end->toDateString(),
        ];
    }

    public function topQueries(string $startDate, string $endDate, int $limit = 20): array
    {
        return $this->querySearchAnalytics(null, $startDate, $endDate, ['query'], $limit);
    }

    public function topPages(string $startDate, string $endDate, int $limit = 20): array
    {
        return $this->querySearchAnalytics(null, $startDate, $endDate, ['page'], $limit);
    }
}
