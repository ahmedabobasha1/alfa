<?php

use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::group(['controller' => WebsiteController::class], function () {
    Route::get('about-us', 'about')->name('about-us');
    Route::get('doctors', 'teams')->name('teams');
    Route::get('doctors/{team}', 'teamDetails')->name('teamDetails');
    Route::get('products', 'products')->name('products');
    Route::get('products/{product}', 'productDetails')->name('productDetails');
    Route::get('blogs', 'blogs')->name('blogs');
    Route::get('blogs/{blog}', 'blogDetails')->name('blogDetails');
    Route::get('contact-us', 'showContactUs')->name('contact-us');
    Route::post('save-contact-us', 'saveContactUs')->name('saveConatct')->middleware('throttle:2');
    Route::get('gallery', 'gallery')->name('gallery');
    Route::get('before-after', 'beforeAfter')->name('beforeAfter');
    Route::get('videos', 'videos')->name('videos');

    Route::get('services', 'services')->name('services');
    Route::get('services/{service}', 'serviceDetails')->name('serviceDetails');

    Route::get('categories', 'categories')->name('categories');
    Route::get('categories/{category}', 'categoryDetails')->name('categoryDetails');
    Route::get('projects', 'projects')->name('projects');
    Route::get('projects/{project}', 'projectDetails')->name('projectDetails');

    Route::post('save-application', 'saveApplication')->name('saveApplication');
    Route::get('partners', 'partners')->name('partners');
    Route::get('pages/{page}', 'pageDetails')->name('pageDetails');
    Route::post('subscribe', 'saveSubscribe')->name('subscribe');
});
Route::get('sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'generate'])->name('sitemap');
