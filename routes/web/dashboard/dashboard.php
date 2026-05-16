<?php

use App\Http\Controllers\Dashboard\AIContentController;
use App\Http\Controllers\Dashboard\GoogleAnalyticsController;
use App\Http\Controllers\Dashboard\RedirectController;
use App\Http\Controllers\Dashboard\SearchConsoleController;
use App\Http\Controllers\Dashboard\SeoAIController;
use App\Http\Controllers\Dashboard\SeoTestingController;
use Illuminate\Support\Facades\Route;

Route::group(['controller' => \App\Http\Controllers\Dashboard\DashboardController::class], function () {
    Route::get('/', 'index')->name('home');
    Route::post('{modelname}/change-status/{ids}', 'changeStatus')->name('change.status');
});

Route::group(['prefix' => 'settings', 'controller' => \App\Http\Controllers\Dashboard\SettingController::class, 'as' => 'settings.'], function () {
    Route::get('/', 'show')->name('show');
    Route::patch('/', 'update')->name('update');
});

Route::group(['prefix' => 'configrations', 'controller' => \App\Http\Controllers\Dashboard\ConfigrationController::class, 'as' => 'configrations.'], function () {
    Route::get('{lang}', 'edit')->name('edit');
    Route::patch('{lang}', 'update')->name('update');
});

Route::group(['prefix' => 'career_applications', 'controller' => \App\Http\Controllers\Dashboard\CareerApplicationController::class, 'as' => 'career_applications.'], function () {
    Route::get('download-cv/{application}', 'downloadCV')->name('download.cv');
    Route::get('show/{application}', 'show')->name('show');
    Route::get('/', 'index')->name('index');
    Route::delete('{application}', 'destroy')->name('destroy');
});
Route::resource('job_positions', \App\Http\Controllers\Dashboard\JobPositionController::class);

Route::group(['prefix' => 'contact_messages', 'controller' => \App\Http\Controllers\Dashboard\ContactMessageController::class, 'as' => 'contact_messages.'], function () {
    Route::get('/', 'index')->name('index');
    Route::get('show/{message}', 'show')->name('show');
    Route::delete('{message}', 'destroy')->name('destroy');
});

Route::resource('subscribers', \App\Http\Controllers\Dashboard\SubscriberController::class)->only(['index', 'destroy']);

Route::group(['prefix' => 'about-us', 'controller' => \App\Http\Controllers\Dashboard\AboutUsController::class, 'as' => 'about.'], function () {
    Route::get('/', 'edit')->name('edit');
    Route::patch('{about}', 'update')->name('update');
});

Route::resource('menus', \App\Http\Controllers\Dashboard\MenuController::class);
Route::resource('about-structs', \App\Http\Controllers\Dashboard\AboutStructController::class);
Route::resource('sliders', \App\Http\Controllers\Dashboard\SliderController::class);
Route::resource('benefits', \App\Http\Controllers\Dashboard\BenefitController::class);
Route::resource('sections', \App\Http\Controllers\Dashboard\SectionController::class);
Route::resource('statistics', \App\Http\Controllers\Dashboard\StatisticController::class);
Route::resource('pages', \App\Http\Controllers\Dashboard\PageController::class);
Route::resource('faqs', \App\Http\Controllers\Dashboard\FaqController::class);
Route::resource('testimonials', \App\Http\Controllers\Dashboard\TestimonialController::class);
Route::resource('clients', \App\Http\Controllers\Dashboard\ClientController::class);
Route::resource('parteners', \App\Http\Controllers\Dashboard\PartenerController::class);
Route::resource('gallery_videos', \App\Http\Controllers\Dashboard\GalleryVideoController::class);
Route::resource('albums', \App\Http\Controllers\Dashboard\AlbumController::class);
Route::resource('albums.images', \App\Http\Controllers\Dashboard\AlbumImageController::class)->except(['create', 'edit', 'show', 'update']);
Route::delete('albums/{album}/images', [\App\Http\Controllers\Dashboard\AlbumImageController::class, 'destroyAllImages'])
    ->name('albums.images.destroyAll');
Route::resource('site-addresses', \App\Http\Controllers\Dashboard\SiteAddressController::class);
Route::resource('phones', \App\Http\Controllers\Dashboard\PhoneController::class);
Route::resource('attributes', \App\Http\Controllers\Dashboard\AttributeController::class);
Route::resource('attributes.values', \App\Http\Controllers\Dashboard\AttributeValueController::class);
Route::resource('roles', \App\Http\Controllers\Dashboard\RoleController::class);
Route::resource('admins', \App\Http\Controllers\Dashboard\AdminController::class);

// Teams Routes
Route::resource('teams', \App\Http\Controllers\Dashboard\TeamController::class);

// Categories Routes
Route::resource('categories', \App\Http\Controllers\Dashboard\CategoryController::class);
Route::resource('categories.images', \App\Http\Controllers\Dashboard\CategoryImageController::class)->except(['create', 'edit', 'show', 'update']);
Route::delete('categories/{category}/images', [\App\Http\Controllers\Dashboard\CategoryImageController::class, 'destroyAllImages'])
    ->name('categories.images.destroyAll');

// Service Routes
Route::resource('services', \App\Http\Controllers\Dashboard\ServiceController::class);
Route::resource('services.images', \App\Http\Controllers\Dashboard\ServiceImageController::class)->except(['create', 'edit', 'show', 'update']);
Route::delete('services/{service}/images', [\App\Http\Controllers\Dashboard\ServiceImageController::class, 'destroyAllImages'])
    ->name('services.images.destroyAll');
Route::resource('services.tabs', \App\Http\Controllers\Dashboard\ServiceTabController::class);
Route::resource('services.benefits', \App\Http\Controllers\Dashboard\ServiceBenefitController::class);

// Product Routes
Route::resource('products', \App\Http\Controllers\Dashboard\ProductController::class);
Route::resource('products.images', \App\Http\Controllers\Dashboard\ProductImageController::class)->except(['create', 'edit', 'show', 'update']);
Route::delete('products/{product}/images', [\App\Http\Controllers\Dashboard\ProductImageController::class, 'destroyAllImages'])
    ->name('products.images.destroyAll');

// Project Routes
Route::resource('projects', \App\Http\Controllers\Dashboard\ProjectController::class);
Route::resource('projects.images', \App\Http\Controllers\Dashboard\ProjectImageController::class)->except(['create', 'edit', 'show', 'update']);
Route::delete('projects/{project}/images', [\App\Http\Controllers\Dashboard\ProjectImageController::class, 'destroyAllImages'])
    ->name('projects.images.destroyAll');
Route::resource('projects.tabs', \App\Http\Controllers\Dashboard\ProjectTabController::class);

// Blog Routes
Route::resource('blog_categories', \App\Http\Controllers\Dashboard\BlogCategoryController::class);
Route::resource('blogs', \App\Http\Controllers\Dashboard\BlogController::class);
Route::resource('blogs.faqs', \App\Http\Controllers\Dashboard\BlogFaqController::class);
Route::resource('blogs.images', \App\Http\Controllers\Dashboard\BlogImageController::class)->except(['create', 'edit', 'show', 'update']);
Route::delete('blogs/{blog}/images', [\App\Http\Controllers\Dashboard\BlogImageController::class, 'destroyAllImages'])
    ->name('blogs.images.destroyAll');
Route::resource('authors', \App\Http\Controllers\Dashboard\AuthorController::class);

// SEO Assistant Routes
Route::group(['prefix' => 'seo-assistants', 'controller' => \App\Http\Controllers\Dashboard\SeoAssistantController::class, 'as' => 'seo-assistants.'], function () {
    Route::get('/', 'index')->name('index');
    Route::get('edit', 'edit')->name('edit');
    Route::patch('update', 'update')->name('update');
});

Route::get('scan', [\App\Http\Controllers\Dashboard\ScanController::class, 'scan'])->name('scan.scan');
Route::post('scan/delete-line', [\App\Http\Controllers\Dashboard\ScanController::class, 'deleteLine'])->name('scan.deleteLine');

Route::get('/generate-sitemap', [\App\Http\Controllers\SitemapController::class, 'generate'])->name('dashboard.generate-sitemap');

// AI Content Routes
Route::group(['prefix' => 'ai-content', 'as' => 'ai-content.'], function () {
    Route::get('/', [AIContentController::class, 'index'])->name('index');
    Route::get('/create', [AIContentController::class, 'create'])->name('create');
    Route::post('/generate', [AIContentController::class, 'generate'])->name('generate');
    Route::post('/upload-image', [AIContentController::class, 'uploadImage'])->name('upload-image');
    Route::post('/save-image-to-service', [AIContentController::class, 'saveImageToService'])->name('save-image-to-service');
    Route::post('/save-image-to-blog', [AIContentController::class, 'saveImageToBlog'])->name('save-image-to-blog');
    Route::post('/test-image', function (Illuminate\Http\Request $request) {
        return response()->json([
            'success' => false,
            'error' => 'خدمات توليد الصور غير متاحة. يرجى إضافة API key',
            'enhanced_prompt' => 'Test enhanced prompt',
            'suggestion' => 'يمكنك استخدام الوصف المُحسن أدناه مع أي خدمة توليد صور أخرى',
            'details' => [
                'stability_error' => 'API key not configured',
                'openai_error' => 'API key not configured',
            ],
        ]);
    })->name('test-image');
    Route::get('/stats', [AIContentController::class, 'stats'])->name('stats');
    Route::get('/validate-api', [AIContentController::class, 'validateApi'])->name('validate-api');
    Route::get('/usage-info', [AIContentController::class, 'usageInfo'])->name('usage-info');
    Route::get('/{content}', [AIContentController::class, 'show'])->name('show');
    Route::put('/{content}/status', [AIContentController::class, 'updateStatus'])->name('update-status');
    Route::delete('/{content}', [AIContentController::class, 'destroy'])->name('destroy');
    Route::post('/{content}/apply', [AIContentController::class, 'applyToModel'])->name('apply-to-model');
});

// SEO Routes
Route::group(['prefix' => 'seo', 'as' => 'seo.', 'middleware' => ['web', 'auth:admin']], function () {
    // SEO Testing
    Route::get('testing', [SeoTestingController::class, 'index'])->name('testing');
    Route::post('testing/comprehensive', [SeoTestingController::class, 'runComprehensiveTest'])->name('testing.comprehensive');
    Route::post('testing/quick', [SeoTestingController::class, 'runQuickTest'])->name('testing.quick');
    Route::get('testing/sitemap', [SeoTestingController::class, 'testSitemap'])->name('testing.sitemap');
    Route::get('testing/recommendations', [SeoTestingController::class, 'getRecommendations'])->name('testing.recommendations');
    Route::post('testing/dynamic-page', [SeoTestingController::class, 'testDynamicPage'])->name('testing.dynamic-page');
    Route::get('testing/dynamic-pages-status', [SeoTestingController::class, 'checkDynamicPagesStatus'])->name('testing.dynamic-pages-status');

    // SEO AI Generation
    Route::post('generate', [SeoAIController::class, 'generateSEO'])->name('generate');
    Route::post('generate-field', [SeoAIController::class, 'generateField'])->name('generate-field');
});

// Search Console
Route::group(['prefix' => 'search-console', 'as' => 'search-console.', 'middleware' => ['web', 'auth:admin']], function () {
    Route::get('/', [SearchConsoleController::class, 'index'])->name('index');
    Route::get('/validate', [SearchConsoleController::class, 'validateConfig'])->name('validate');
});

// Google Analytics
Route::group(['prefix' => 'analytics', 'as' => 'analytics.', 'middleware' => ['web', 'auth:admin']], function () {
    Route::get('/', [GoogleAnalyticsController::class, 'index'])->name('index');
    Route::get('/data', [GoogleAnalyticsController::class, 'getData'])->name('getData');
    Route::get('/test-connection', [GoogleAnalyticsController::class, 'testConnection'])->name('testConnection');
    Route::get('/clear-cache', [GoogleAnalyticsController::class, 'clearCache'])->name('clearCache');
    Route::get('/summary', [GoogleAnalyticsController::class, 'getSummary'])->name('getSummary');
});

// Redirects Management
Route::resource('redirects', RedirectController::class)->names('redirects');
Route::get('redirects-import', [RedirectController::class, 'importForm'])->name('redirects.import-form');
Route::post('redirects-import', [RedirectController::class, 'import'])->name('redirects.import');
Route::get('redirects-template', [RedirectController::class, 'downloadTemplate'])->name('redirects.template');
