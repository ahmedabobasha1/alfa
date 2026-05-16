<?php

namespace App\Services\Seo;

use Google\Client as GoogleClient;
use Google\Service\AnalyticsData as GoogleAnalyticsData;
use Google\Service\AnalyticsData\DateRange;
use Google\Service\AnalyticsData\Dimension;
use Google\Service\AnalyticsData\Metric;
use Google\Service\AnalyticsData\RunReportRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GoogleAnalyticsService
{
    private GoogleClient $client;

    private GoogleAnalyticsData $service;

    private ?string $propertyId;

    private ?string $startDate;

    private ?string $endDate;

    public function __construct()
    {
        $config = config('google.analytics');

        $this->propertyId = $config['property_id'];
        $this->startDate = $config['start_date'] ?? '30daysAgo';
        $this->endDate = $config['end_date'] ?? 'today';

        $client = new GoogleClient;
        $client->setApplicationName(config('app.name').' Google Analytics');
        $client->setScopes($config['scopes'] ?? ['https://www.googleapis.com/auth/analytics.readonly']);

        $keyFile = $config['key_file'];
        if (! is_null($keyFile) && is_string($keyFile) && file_exists($keyFile)) {
            $client->setAuthConfig($keyFile);
        } else {
            // Allow JSON content via env inline
            $json = env('GOOGLE_ANALYTICS_CREDENTIALS_JSON');
            if ($json) {
                $client->setAuthConfig(json_decode($json, true));
            }
        }

        if (! empty($config['impersonate_user'])) {
            $client->setSubject($config['impersonate_user']);
        }

        $this->client = $client;
        $this->service = new GoogleAnalyticsData($client);
    }

    /**
     * Get basic analytics overview for dashboard
     */
    public function getDashboardOverview(string $period = '30d'): array
    {
        $cacheKey = "ga_dashboard_overview_{$period}";

        return Cache::remember($cacheKey, 3600, function () use ($period) {
            try {
                $dateRange = $this->getDateRange($period);

                $request = new RunReportRequest;
                $request->setProperty('properties/'.$this->propertyId);
                $request->setDateRanges([$dateRange]);

                // Metrics
                $request->setMetrics([
                    new Metric(['name' => 'totalUsers']),
                    new Metric(['name' => 'sessions']),
                    new Metric(['name' => 'screenPageViews']),
                    new Metric(['name' => 'bounceRate']),
                    new Metric(['name' => 'averageSessionDuration']),
                    new Metric(['name' => 'newUsers']),
                    new Metric(['name' => 'activeUsers']),
                ]);

                $response = $this->service->properties->runReport($this->propertyId, $request);

                if ($response->getRows() && count($response->getRows()) > 0) {
                    $row = $response->getRows()[0];
                    $metrics = $row->getMetricValues();

                    return [
                        'total_users' => (int) $metrics[0]->getValue(),
                        'sessions' => (int) $metrics[1]->getValue(),
                        'page_views' => (int) $metrics[2]->getValue(),
                        'bounce_rate' => round((float) $metrics[3]->getValue() * 100, 2),
                        'avg_session_duration' => $this->formatDuration((float) $metrics[4]->getValue()),
                        'new_users' => (int) $metrics[5]->getValue(),
                        'active_users' => (int) $metrics[6]->getValue(),
                        'period' => $period,
                        'start_date' => now()->subDays(30)->format('Y-m-d'),
                        'end_date' => now()->format('Y-m-d'),
                    ];
                }

                return $this->getDefaultOverview($period);

            } catch (\Throwable $e) {
                Log::error('Google Analytics dashboard overview error: '.$e->getMessage());

                return $this->getDefaultOverview($period);
            }
        });
    }

    /**
     * Get traffic sources breakdown
     */
    public function getTrafficSources(string $period = '30d'): array
    {
        $cacheKey = "ga_traffic_sources_{$period}";

        return Cache::remember($cacheKey, 3600, function () use ($period) {
            try {
                $dateRange = $this->getDateRange($period);

                $request = new RunReportRequest;
                $request->setProperty('properties/'.$this->propertyId);
                $request->setDateRanges([$dateRange]);

                $request->setDimensions([
                    new Dimension(['name' => 'sessionDefaultChannelGrouping']),
                ]);

                $request->setMetrics([
                    new Metric(['name' => 'sessions']),
                    new Metric(['name' => 'totalUsers']),
                    new Metric(['name' => 'bounceRate']),
                ]);

                $request->setLimit(10);

                $response = $this->service->properties->runReport($this->propertyId, $request);

                $sources = [];
                if ($response->getRows()) {
                    foreach ($response->getRows() as $row) {
                        $dimensions = $row->getDimensionValues();
                        $metrics = $row->getMetricValues();

                        $sources[] = [
                            'source' => $dimensions[0]->getValue(),
                            'sessions' => (int) $metrics[0]->getValue(),
                            'users' => (int) $metrics[1]->getValue(),
                            'bounce_rate' => round((float) $metrics[2]->getValue() * 100, 2),
                        ];
                    }
                }

                return $sources;

            } catch (\Throwable $e) {
                Log::error('Google Analytics traffic sources error: '.$e->getMessage());

                return [];
            }
        });
    }

    /**
     * Get top pages by page views
     */
    public function getTopPages(string $period = '30d', int $limit = 10): array
    {
        $cacheKey = "ga_top_pages_{$period}_{$limit}";

        return Cache::remember($cacheKey, 3600, function () use ($period, $limit) {
            try {
                $dateRange = $this->getDateRange($period);

                $request = new RunReportRequest;
                $request->setProperty('properties/'.$this->propertyId);
                $request->setDateRanges([$dateRange]);

                $request->setDimensions([
                    new Dimension(['name' => 'pagePath']),
                    new Dimension(['name' => 'pageTitle']),
                ]);

                $request->setMetrics([
                    new Metric(['name' => 'screenPageViews']),
                    new Metric(['name' => 'totalUsers']),
                    new Metric(['name' => 'averageSessionDuration']),
                    new Metric(['name' => 'bounceRate']),
                ]);

                $request->setLimit($limit);

                $response = $this->service->properties->runReport($this->propertyId, $request);

                $pages = [];
                if ($response->getRows()) {
                    foreach ($response->getRows() as $row) {
                        $dimensions = $row->getDimensionValues();
                        $metrics = $row->getMetricValues();

                        $pages[] = [
                            'path' => $dimensions[0]->getValue(),
                            'title' => $dimensions[1]->getValue(),
                            'page_views' => (int) $metrics[0]->getValue(),
                            'users' => (int) $metrics[1]->getValue(),
                            'avg_duration' => $this->formatDuration((float) $metrics[2]->getValue()),
                            'bounce_rate' => round((float) $metrics[3]->getValue() * 100, 2),
                        ];
                    }
                }

                return $pages;

            } catch (\Throwable $e) {
                Log::error('Google Analytics top pages error: '.$e->getMessage());

                return [];
            }
        });
    }

    /**
     * Get user behavior metrics
     */
    public function getUserBehavior(string $period = '30d'): array
    {
        $cacheKey = "ga_user_behavior_{$period}";

        return Cache::remember($cacheKey, 3600, function () use ($period) {
            try {
                $dateRange = $this->getDateRange($period);

                $request = new RunReportRequest;
                $request->setProperty('properties/'.$this->propertyId);
                $request->setDateRanges([$dateRange]);

                $request->setDimensions([
                    new Dimension(['name' => 'date']),
                ]);

                $request->setMetrics([
                    new Metric(['name' => 'totalUsers']),
                    new Metric(['name' => 'sessions']),
                    new Metric(['name' => 'screenPageViews']),
                ]);

                $response = $this->service->properties->runReport($this->propertyId, $request);

                $series = [];
                if ($response->getRows()) {
                    foreach ($response->getRows() as $row) {
                        $dimensions = $row->getDimensionValues();
                        $metrics = $row->getMetricValues();

                        $series[] = [
                            'date' => $dimensions[0]->getValue(),
                            'users' => (int) $metrics[0]->getValue(),
                            'sessions' => (int) $metrics[1]->getValue(),
                            'page_views' => (int) $metrics[2]->getValue(),
                        ];
                    }
                }

                return $series;

            } catch (\Throwable $e) {
                Log::error('Google Analytics user behavior error: '.$e->getMessage());

                return [];
            }
        });
    }

    /**
     * Get device breakdown
     */
    public function getDeviceBreakdown(string $period = '30d'): array
    {
        $cacheKey = "ga_device_breakdown_{$period}";

        return Cache::remember($cacheKey, 3600, function () use ($period) {
            try {
                $dateRange = $this->getDateRange($period);

                $request = new RunReportRequest;
                $request->setProperty('properties/'.$this->propertyId);
                $request->setDateRanges([$dateRange]);

                $request->setDimensions([
                    new Dimension(['name' => 'deviceCategory']),
                ]);

                $request->setMetrics([
                    new Metric(['name' => 'sessions']),
                    new Metric(['name' => 'totalUsers']),
                    new Metric(['name' => 'bounceRate']),
                ]);

                $response = $this->service->properties->runReport($this->propertyId, $request);

                $devices = [];
                if ($response->getRows()) {
                    foreach ($response->getRows() as $row) {
                        $dimensions = $row->getDimensionValues();
                        $metrics = $row->getMetricValues();

                        $devices[] = [
                            'device' => $dimensions[0]->getValue(),
                            'sessions' => (int) $metrics[0]->getValue(),
                            'users' => (int) $metrics[1]->getValue(),
                            'bounce_rate' => round((float) $metrics[2]->getValue() * 100, 2),
                        ];
                    }
                }

                return $devices;

            } catch (\Throwable $e) {
                Log::error('Google Analytics device breakdown error: '.$e->getMessage());

                return [];
            }
        });
    }

    /**
     * Get real-time data (last 30 minutes)
     */
    public function getRealTimeData(): array
    {
        $cacheKey = 'ga_realtime_data';

        return Cache::remember($cacheKey, 60, function () {
            try {
                $endDate = Carbon::now();
                $startDate = $endDate->copy()->subMinutes(30);

                $dateRange = new DateRange;
                $dateRange->setStartDate($startDate->format('Y-m-d'));
                $dateRange->setEndDate($endDate->format('Y-m-d'));

                $request = new RunReportRequest;
                $request->setProperty('properties/'.$this->propertyId);
                $request->setDateRanges([$dateRange]);

                $request->setMetrics([
                    new Metric(['name' => 'activeUsers']),
                    new Metric(['name' => 'screenPageViews']),
                ]);

                $response = $this->service->properties->runReport($this->propertyId, $request);

                if ($response->getRows() && count($response->getRows()) > 0) {
                    $row = $response->getRows()[0];
                    $metrics = $row->getMetricValues();

                    return [
                        'active_users' => (int) $metrics[0]->getValue(),
                        'page_views' => (int) $metrics[1]->getValue(),
                        'last_updated' => now()->format('H:i:s'),
                    ];
                }

                return [
                    'active_users' => 0,
                    'page_views' => 0,
                    'last_updated' => now()->format('H:i:s'),
                ];

            } catch (\Throwable $e) {
                Log::error('Google Analytics real-time data error: '.$e->getMessage());

                return [
                    'active_users' => 0,
                    'page_views' => 0,
                    'last_updated' => now()->format('H:i:s'),
                ];
            }
        });
    }

    /**
     * Test connection to Google Analytics
     */
    public function testConnection(): array
    {
        try {
            $overview = $this->getDashboardOverview('7d');

            if (isset($overview['total_users'])) {
                return [
                    'success' => true,
                    'message' => 'Connection successful',
                    'data' => $overview,
                ];
            }

            return [
                'success' => false,
                'message' => 'No data returned',
            ];

        } catch (\Throwable $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Clear all cached data
     */
    public function clearCache(): bool
    {
        try {
            Cache::forget('ga_dashboard_overview_*');
            Cache::forget('ga_traffic_sources_*');
            Cache::forget('ga_top_pages_*');
            Cache::forget('ga_user_behavior_*');
            Cache::forget('ga_device_breakdown_*');
            Cache::forget('ga_realtime_data');

            return true;
        } catch (\Throwable $e) {
            Log::error('Failed to clear Google Analytics cache: '.$e->getMessage());

            return false;
        }
    }

    /**
     * Helper method to get date range from period string
     */
    private function getDateRange(string $period): DateRange
    {
        $endDate = Carbon::today();

        switch ($period) {
            case '7d':
                $startDate = $endDate->copy()->subDays(7);
                break;
            case '14d':
                $startDate = $endDate->copy()->subDays(14);
                break;
            case '30d':
                $startDate = $endDate->copy()->subDays(30);
                break;
            case '90d':
                $startDate = $endDate->copy()->subDays(90);
                break;
            case '1y':
                $startDate = $endDate->copy()->subYear();
                break;
            default:
                $startDate = $endDate->copy()->subDays(30);
        }

        $dateRange = new DateRange;
        $dateRange->setStartDate($startDate->format('Y-m-d'));
        $dateRange->setEndDate($endDate->format('Y-m-d'));

        return $dateRange;
    }

    /**
     * Helper method to format duration from seconds
     */
    private function formatDuration(float $seconds): string
    {
        if ($seconds < 60) {
            return round($seconds, 1).'s';
        }

        $minutes = floor($seconds / 60);
        $remainingSeconds = $seconds % 60;

        if ($minutes < 60) {
            return $minutes.'m '.round($remainingSeconds).'s';
        }

        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;

        return $hours.'h '.$remainingMinutes.'m';
    }

    /**
     * Get default overview when API fails
     */
    private function getDefaultOverview(string $period): array
    {
        return [
            'total_users' => 0,
            'sessions' => 0,
            'page_views' => 0,
            'bounce_rate' => 0,
            'avg_session_duration' => '0s',
            'new_users' => 0,
            'active_users' => 0,
            'period' => $period,
            'start_date' => now()->subDays(30)->format('Y-m-d'),
            'end_date' => now()->format('Y-m-d'),
        ];
    }
}
