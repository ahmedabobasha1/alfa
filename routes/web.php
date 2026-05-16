<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

// Authentication routes
Auth::routes();

// Offline page route
Route::get('/offline', function () {
    // Get site settings
    $site_name = \App\Models\Setting::where('key', 'site_name')->first();
    $whatsapp_number = \App\Models\Setting::where('key', 'site_whatsapp')->first();

    $settings = (object) [
        'site_name' => $site_name ? $site_name->value : config('app.name', 'Tulip'),
        'whatsapp_number' => $whatsapp_number ? $whatsapp_number->value : null,
    ];

    // Load dynamic contact info with error handling
    $phones = collect();
    $site_addresses = collect();

    try {
        $phones = \App\Models\Phone::active()->get();
    } catch (\Exception $e) {
        Log::warning('Failed to load phones for offline page: '.$e->getMessage());
    }

    try {
        $site_addresses = \App\Models\SiteAddress::active()->orderBy('order')->get();
    } catch (\Exception $e) {
        Log::warning('Failed to load site addresses for offline page: '.$e->getMessage());
    }

    // Load social media links
    $socialMediaLinks = [
        'whatsapp' => config('settings.site_whatsapp') ? 'https://wa.me/'.ltrim(config('settings.site_whatsapp'), '+') : '#',
        'facebook' => config('settings.site_facebook') ?? '#',
        'twitter' => config('settings.site_twitter') ?? '#',
        'instagram' => config('settings.site_instagram') ?? '#',
        'youtube' => config('settings.site_youtube') ?? '#',
        'linkedin' => config('settings.site_linkedin') ?? '#',
        'tiktok' => config('settings.site_tiktok') ?? '#',
        'snapchat' => config('settings.site_snapchat') ?? '#',
        'pinterest' => config('settings.site_pinterest') ?? '#',
        'telegram' => config('settings.site_telegram') ?? '#',
    ];

    return view('offline', compact('settings', 'phones', 'site_addresses', 'socialMediaLinks'));
})->name('offline');

// API endpoint for offline page data
Route::get('/api/offline-data', [\App\Http\Controllers\OfflineController::class, 'getOfflineData'])->name('api.offline-data');

// Note: Website routes are loaded in bootstrap/app.php with localization middleware
// Do not load them here to avoid duplicate routes

// Dashboard routes
Route::prefix('dashboard')
    ->name('dashboard.')
    ->middleware(['web', 'auth:admin'])
    ->group(function () {
        require __DIR__.'/web/dashboard/auth.php';
        require __DIR__.'/web/dashboard/dashboard.php';
    });
