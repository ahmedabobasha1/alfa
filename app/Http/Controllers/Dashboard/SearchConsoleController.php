<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Seo\SearchConsoleService;
use Illuminate\Http\Request;

class SearchConsoleController extends Controller
{
    public function __construct(private SearchConsoleService $sc) {}

    public function index(Request $request)
    {
        $period = $request->get('period', '28d');
        $end = now()->toDateString();
        $start = match ($period) {
            '7d' => now()->subDays(7)->toDateString(),
            '14d' => now()->subDays(14)->toDateString(),
            '90d' => now()->subDays(90)->toDateString(),
            default => now()->subDays(28)->toDateString(),
        };

        $error = null;
        $summary = [
            'clicks' => 0,
            'impressions' => 0,
            'ctr' => 0,
            'position' => 0,
            'series' => [],
            'start' => $start,
            'end' => $end,
        ];
        $topQueries = [];
        $topPages = [];

        try {
            $summary = $this->sc->getSummaryLast28Days();
            // For top queries/pages use selected period
            $topQueries = $this->sc->topQueries($start, $end, 20);
            $topPages = $this->sc->topPages($start, $end, 20);
        } catch (\Throwable $e) {
            $error = $e->getMessage();
        }

        return view('Dashboard.SearchConsole.index', compact('summary', 'topQueries', 'topPages', 'start', 'end', 'period', 'error'));
    }

    public function validateConfig()
    {
        try {
            $sites = $this->sc->getVerifiedSites();

            return response()->json([
                'ok' => true,
                'configured_site' => config('google.search_console.site_url'),
                'verified_sites' => $sites,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'ok' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
