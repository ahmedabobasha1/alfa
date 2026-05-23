<?php

namespace App\Providers;

use App\Enums\SectionType;
use App\Models\Blog;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Phone;
use App\Models\Product;
use App\Models\Project;
use App\Models\Section;
use App\Models\Service;
use App\Models\Setting;
use App\Models\SiteAddress;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Load language-specific data and menus after middleware sets locale
        View::composer(['components.website.*', 'Website.*'], function ($view) {
            // Use request-level cache to prevent duplicate queries within the same request
            $requestCacheKey = 'view_composer_data_'.app()->getLocale();

            // Check if data is already loaded in this request
            if (app()->bound($requestCacheKey)) {
                $data = app($requestCacheKey);
                foreach ($data as $key => $value) {
                    $view->with($key, $value);
                }

                return;
            }

            $lang = app()->getLocale();

            // Load settings (language-independent)
            $settings = Cache::remember('settings', 60, function () {
                return Setting::where('lang', 'all')
                    ->get()
                    ->mapWithKeys(function ($item) {
                        return [$item->key => $item->value];
                    })->toArray();
            });
            Config::set('settings', $settings);

            // Load configrations (language-specific) - NOW CACHED
            $configrations = Cache::remember("configrations_{$lang}", 60, function () use ($lang) {
                return Setting::where('lang', $lang)
                    ->get()
                    ->mapWithKeys(function ($item) {
                        return [$item->key => $item->value];
                    })->toArray();
            });
            Config::set('configrations', $configrations);

            // Load menus
            $menus = Cache::remember('menus', 60, function () {
                return Menu::with(['parent', 'children' => function ($query) {
                    $query->active()->orderBy('order', 'asc');
                }])
                    ->active()
                    ->whereNull('parent_id')
                    ->orderBy('order', 'asc')
                    ->get();
            });

            // get header services
            $headerServices = Cache::remember('header_services', 60, function () {
                return Service::header()->active()->take(4)->get();
            });

            $footerServices = Cache::remember('footer_services', 60, function () {
                return Service::footer()->active()->take(4)->get();
            });

            // get site addresses
            $site_addresses = Cache::remember('site_addresses', 60, function () {
                return SiteAddress::active()->orderBy('order')->get();
            });

            // get main address
            $main_address = Cache::remember('main_address', 60, function () {
                return SiteAddress::active()->type('head_office')->first();
            });

            // get breadcrumb
            $breadcrumb = Cache::remember('breadcrumb', 60, function () {
                return Section::type(SectionType::BREADCRUMB)->first();
            });

            // get pages
            $pages = Cache::remember('pages', 60, function () {
                return Page::active()->get();
            });

            // get phones
            $phones = Cache::remember('phones', 60, function () {
                return Phone::active()->get();
            });
            
            $headerCategories = Cache::remember('header_categories', 60, function () {
                return Category::with('projects')->whereHas('projects', function ($query) {
                    $query->active()->orderBy('order');
                })->active()->get();
            });

            // get call to action phone numbers
            $cta_phone_full = $settings['phone'] ?? ''; // e.g. +201061560915
            $cta_phone = ltrim($cta_phone_full, '+');
            $cta_whatsapp_full = $settings['site_whatsapp'] ?? '';
            $cta_whatsapp = ltrim($cta_whatsapp_full, '+');

            // Store all data in request-level cache
            $data = [
                'settings' => $settings,
                'configrations' => $configrations,
                'menus' => $menus,
                'headerServices' => $headerServices,
                'footerServices' => $footerServices,
                'site_addresses' => $site_addresses,
                'main_address' => $main_address,
                'breadcrumb' => $breadcrumb,
                'pages' => $pages,
                'phones' => $phones,
                'headerCategories' => $headerCategories,
                'cta_phone_full' => $cta_phone_full,
                'cta_phone' => $cta_phone,
                'cta_whatsapp_full' => $cta_whatsapp_full,
                'cta_whatsapp' => $cta_whatsapp,
            ];

            // Bind to container for this request
            app()->instance($requestCacheKey, $data);

            // Share with view
            foreach ($data as $key => $value) {
                $view->with($key, $value);
            }
        });

        View::composer(['components.website.partials._header', 'components.website.partials._navbar'], function ($view) {

            // Language switcher logic
            $currentLocale = app()->getLocale();
            $altLangLink = null;
            $route = Route::current();
            $routeParameters = $route ? $route->parameters() : [];
            $targetLang = $currentLocale === 'ar' ? 'en' : 'ar';
            $currentPath = $route ? $route->uri() : '';

            if ($route) {
                $slug = null;
                $model = null;
                $targetPath = null;

                // تحديد المعلمة والنموذج المناسب
                if (str_contains($currentPath, 'services')) {
                    $slug = $routeParameters['slug'] ?? null;
                    $model = Service::class;
                    $targetPath = 'services';
                } elseif (str_contains($currentPath, 'projects')) {
                    $item = $routeParameters['project'] ?? null;
                    if ($item instanceof Project) {
                        $slug = $item->{'slug_'.$currentLocale};
                    } else {
                        $slug = $item;
                    }
                    $model = Project::class;
                    $targetPath = 'projects';
                } elseif (str_contains($currentPath, 'products')) {
                    $item = $routeParameters['product'] ?? null;
                    if ($item instanceof Product) {
                        $slug = $item->{'slug_'.$currentLocale};
                    } else {
                        $slug = $item;
                    }
                    $model = Product::class;
                    $targetPath = 'products';
                } elseif (str_contains($currentPath, 'blogs')) {
                    $item = $routeParameters['blog'] ?? null;
                    if ($item instanceof Blog) {
                        $slug = $item->{'slug_'.$currentLocale};
                    } else {
                        $slug = $item;
                    }
                    $model = Blog::class;
                    $targetPath = 'blogs';
                }

                // البحث عن العنصر وإنشاء الرابط
                if ($slug && $model && $targetPath) {
                    $item = $model::where('slug_'.$currentLocale, $slug)->first();
                    if ($item) {
                        $targetSlug = $item->{'slug_'.$targetLang};
                        if ($targetSlug) {
                            $altLangLink = LaravelLocalization::getLocalizedURL(
                                $targetLang,
                                $targetPath.'/'.$targetSlug
                            );
                        }
                    }
                }
            }

            if (! $altLangLink) {
                $altLangLink = LaravelLocalization::getLocalizedURL($targetLang);
            }

            $view->with('altLangLink', $altLangLink);
        });

        View::composer(['components.dashboard.*'], function ($view) {
            $lang = app()->getLocale();
            $configrations = Cache::remember("configrations_{$lang}", 60, function () use ($lang) {
                return Setting::where('lang', $lang)
                    ->get()
                    ->mapWithKeys(function ($item) {
                        return [$item->key => $item->value];
                    })->toArray();
            });
            Config::set('configrations', $configrations);
            $view->with('configrations', $configrations);
        });
    }

    public function register(): void
    {
        //
    }
}
