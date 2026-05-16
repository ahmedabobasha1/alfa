<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Http\Request;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Get language from header or default to 'en'
        $locale = $request->header('Accept-Language', 'en');

        // Ensure we only accept our supported languages
        $locale = in_array($locale, ['en', 'ar']) ? $locale : 'en';

        // Set application locale
        app()->setLocale($locale);

        return $next($request);
    }
}
