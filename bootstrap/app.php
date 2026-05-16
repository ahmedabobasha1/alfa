<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(function () {
        Route::middleware(['web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'localizedSlugRedirect'])
            ->prefix(LaravelLocalization::setLocale())
            ->name('website.')
            ->group(base_path('routes/web/website/website.php'));

        Route::middleware('web')
            ->prefix(LaravelLocalization::setLocale())
            ->group(base_path('routes/web.php'));

        Route::middleware(['web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])
            ->prefix(LaravelLocalization::setLocale().'/dashboard')
            ->name('dashboard.')
            ->group(base_path('routes/web/dashboard/auth.php'));

        Route::middleware(['web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:admin'])
            ->prefix(LaravelLocalization::setLocale().'/dashboard')
            ->name('dashboard.')
            ->group(base_path('routes/web/dashboard/dashboard.php'));

        Route::middleware([
            'api',
            App\Http\Middleware\Api\AlwaysAcceptJsonMiddleware::class,
        ])
            ->prefix('api')
            ->name('api.')
            ->group(base_path('routes/api/website.php'));
    })
    ->withMiddleware(function ($middleware) {

        // Redirect unauthenticated admin users to dashboard login
        $middleware->redirectGuestsTo(fn () => route('dashboard.login'));

        // Prepend LanguageMiddleware to 'api' group so it runs BEFORE SubstituteBindings
        $middleware->prependToGroup('api', \App\Http\Middleware\Api\LanguageMiddleware::class);

        //  Add localized slug redirect middleware globally
        $middleware->append(\App\Http\Middleware\LocalizedSlugRedirect::class);

        $middleware->alias([

            'localize' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
            'localizationRedirect' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
            'localeSessionRedirect' => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
            'localeCookieRedirect' => \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
            'localeViewPath' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class,

            'localizedSlugRedirect' => \App\Http\Middleware\LocalizedSlugRedirect::class,

        ]);
    })
    ->withExceptions(function ($exceptions) {
        // Always return JSON for API routes, even in debug mode
        $exceptions->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Resource not found.',
                    'error' => env('APP_DEBUG') ? $e->getMessage() : null,
                ], 404);
            }

            // For web routes, show custom 404 page only in production
            if (! env('APP_DEBUG', false)) {
                return response()->view('errors.404', [], 404);
            }
        });

        // Handle other exceptions for API
        $exceptions->renderable(function (\Throwable $e, $request) {
            if ($request->is('api/*') && ! ($e instanceof NotFoundHttpException)) {
                return response()->json([
                    'message' => 'An error occurred.',
                    'error' => env('APP_DEBUG') ? $e->getMessage() : null,
                ], 500);
            }
        });
    })
    ->withCommands([
        \App\Console\Commands\SitemapGenerate::class,

    ])

    ->create();
