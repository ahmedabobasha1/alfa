<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Seo\GoogleAnalyticsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GoogleAnalyticsController extends Controller
{
    public function __construct(private GoogleAnalyticsService $gaService) {}

    /**
     * Display Google Analytics dashboard
     */
    public function index(Request $request)
    {
        $this->authorize('analytics.view');

        $period = $request->get('period', '30d');
        $refresh = $request->get('refresh', false);

        // Clear cache if refresh requested
        if ($refresh) {
            $this->gaService->clearCache();
        }

        try {
            // Get all analytics data
            $overview = $this->gaService->getDashboardOverview($period);
            $trafficSources = $this->gaService->getTrafficSources($period);
            $topPages = $this->gaService->getTopPages($period, 10);
            $userBehavior = $this->gaService->getUserBehavior($period);
            $deviceBreakdown = $this->gaService->getDeviceBreakdown($period);
            $realTimeData = $this->gaService->getRealTimeData();

            return view('Dashboard.GoogleAnalytics.index', compact(
                'overview',
                'trafficSources',
                'topPages',
                'userBehavior',
                'deviceBreakdown',
                'realTimeData',
                'period'
            ));

        } catch (\Throwable $e) {
            return view('Dashboard.GoogleAnalytics.index', [
                'error' => $e->getMessage(),
                'period' => $period,
                'overview' => [],
                'trafficSources' => [],
                'topPages' => [],
                'userBehavior' => [],
                'deviceBreakdown' => [],
                'realTimeData' => [],
            ]);
        }
    }

    /**
     * Get analytics data via AJAX
     */
    public function getData(Request $request)
    {
        $this->authorize('analytics.view');

        $period = $request->get('period', '30d');
        $type = $request->get('type', 'overview');

        try {
            switch ($type) {
                case 'overview':
                    $data = $this->gaService->getDashboardOverview($period);
                    break;
                case 'traffic_sources':
                    $data = $this->gaService->getTrafficSources($period);
                    break;
                case 'top_pages':
                    $limit = $request->get('limit', 10);
                    $data = $this->gaService->getTopPages($period, $limit);
                    break;
                case 'user_behavior':
                    $data = $this->gaService->getUserBehavior($period);
                    break;
                case 'device_breakdown':
                    $data = $this->gaService->getDeviceBreakdown($period);
                    break;
                case 'realtime':
                    $data = $this->gaService->getRealTimeData();
                    break;
                default:
                    return response()->json(['error' => 'Invalid data type'], 400);
            }

            return response()->json([
                'success' => true,
                'data' => $data,
                'period' => $period,
                'type' => $type,
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Test Google Analytics connection
     */
    public function testConnection()
    {
        $this->authorize('analytics.view');

        try {
            $result = $this->gaService->testConnection();

            return response()->json($result);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Clear analytics cache
     */
    public function clearCache()
    {
        $this->authorize('analytics.view');

        try {
            $success = $this->gaService->clearCache();

            if ($success) {
                return response()->json([
                    'success' => true,
                    'message' => 'Cache cleared successfully',
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to clear cache',
            ], 500);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get analytics summary for main dashboard
     */
    public function getSummary()
    {
        $this->authorize('analytics.view');

        try {
            $overview = $this->gaService->getDashboardOverview('7d');
            $realTime = $this->gaService->getRealTimeData();

            return response()->json([
                'success' => true,
                'data' => [
                    'overview' => $overview,
                    'realtime' => $realTime,
                ],
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
