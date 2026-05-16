<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Update Google Analytics data every hour
        $schedule->command('analytics:update')
            ->hourly()
            ->withoutOverlapping()
            ->runInBackground();

        // Update real-time data every 5 minutes during business hours
        $schedule->command('analytics:update --period=7d')
            ->everyFiveMinutes()
            ->between('08:00', '18:00')
            ->withoutOverlapping()
            ->runInBackground();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
