<?php

namespace App\Http\Middleware;

use App\Models\Blog;
use App\Models\Product;
use App\Models\Project;
use App\Models\Service;
use Closure;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LocalizedSlugRedirect
{
    public function handle(Request $request, Closure $next)
    {
        // Skip API routes - they handle their own locale logic
        if ($request->is('api/*')) {
            return $next($request);
        }

        $locale = LaravelLocalization::getCurrentLocale();
        $path = $request->path();

        // Define models and base paths that have localized slugs
        $models = [
            'services' => Service::class,
            'projects' => Project::class,
            'products' => Product::class,
            'blogs' => Blog::class,
            'blog' => Blog::class,
        ];

        foreach ($models as $base => $model) {
            if (str_contains($path, $base)) {
                $slug = last(explode('/', $path));
                $decodedSlug = urldecode($slug);

                // Try to find by slug in the current language
                $item = $model::where("slug_{$locale}", $decodedSlug)->first();

                if (! $item) {
                    // Maybe user switched locale — find by any slug and redirect to correct localized one
                    $otherLocale = $locale === 'ar' ? 'en' : 'ar';
                    $item = $model::where("slug_{$otherLocale}", $decodedSlug)->first();

                    if ($item) {
                        $newSlug = $item->{"slug_{$locale}"};
                        $localizedUrl = LaravelLocalization::getLocalizedURL(
                            $locale,
                            "{$base}/{$newSlug}"
                        );

                        return redirect()->to($localizedUrl, 301);
                    }
                }
            }
        }

        return $next($request);
    }
}
