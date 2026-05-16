<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use App\Models\Setting;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Force HTTPS in production
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Prevent lazy loading in non-production environments
        Model::preventLazyLoading(! $this->app->environment('production'));

        // Custom Blade directive to check if SEO handler is set and valid
        Blade::if('seo', function ($seoHandler) {
            return isset($seoHandler) && is_object($seoHandler) &&
                method_exists($seoHandler, 'renderMetaTags') &&
                method_exists($seoHandler, 'renderSchema');
        });

        $settings = Cache::remember('settings', 60, function () {
            return Setting::where('lang', 'all')
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->key => $item->value];
                })->toArray();
        });
        Config::set('settings', $settings);
    }
}
