<?php

namespace App\Console\Commands;

use App\Services\Seo\GoogleAnalyticsService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateGoogleAnalytics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'analytics:update {--period=30d : Period to update (7d, 14d, 30d, 90d, 1y)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Google Analytics data cache';

    /**
     * Execute the console command.
     */
    public function handle(GoogleAnalyticsService $gaService)
    {
        $period = $this->option('period');

        $this->info("🔄 Updating Google Analytics data for period: {$period}");

        try {
            // Clear existing cache
            $this->info('🧹 Clearing existing cache...');
            $gaService->clearCache();

            // Update overview data
            $this->info('📊 Updating overview data...');
            $overview = $gaService->getDashboardOverview($period);
            $this->info("✅ Overview updated: {$overview['total_users']} users, {$overview['sessions']} sessions");

            // Update traffic sources
            $this->info('🔄 Updating traffic sources...');
            $trafficSources = $gaService->getTrafficSources($period);
            $this->info('✅ Traffic sources updated: '.count($trafficSources).' sources');

            // Update top pages
            $this->info('📄 Updating top pages...');
            $topPages = $gaService->getTopPages($period, 20);
            $this->info('✅ Top pages updated: '.count($topPages).' pages');

            // Update user behavior
            $this->info('📈 Updating user behavior...');
            $userBehavior = $gaService->getUserBehavior($period);
            $this->info('✅ User behavior updated: '.count($userBehavior).' data points');

            // Update device breakdown
            $this->info('📱 Updating device breakdown...');
            $deviceBreakdown = $gaService->getDeviceBreakdown($period);
            $this->info('✅ Device breakdown updated: '.count($deviceBreakdown).' devices');

            // Update real-time data
            $this->info('⏰ Updating real-time data...');
            $realTime = $gaService->getRealTimeData();
            $this->info("✅ Real-time data updated: {$realTime['active_users']} active users");

            $this->info('🎉 Google Analytics data updated successfully!');

            // Log success
            Log::info("Google Analytics data updated successfully for period: {$period}");

        } catch (\Throwable $e) {
            $this->error('❌ Error updating Google Analytics data: '.$e->getMessage());
            Log::error('Google Analytics update failed: '.$e->getMessage());

            return 1;
        }

        return 0;
    }
}
