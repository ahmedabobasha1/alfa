<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'website', 'as' => 'website.'], function () {
    Route::get('/home', [App\Http\Controllers\Api\HomeController::class, 'index']);
    Route::group(['controller' => App\Http\Controllers\Api\WebsiteController::class], function () {
        Route::get('/about-us', 'about')->name('about-us');
        Route::get('/services', 'services')->name('services');
        Route::get('/services/{service}', 'serviceDetails')->name('serviceDetails');
        Route::get('/categories', 'categories')->name('categories');
        Route::get('/projects', 'projects')->name('projects');
        Route::get('/projects/{project}', 'projectDetails')->name('projectDetails');
        Route::get('/blogs', 'blogs')->name('blogs');
        Route::get('/blogs/{blog}', 'blogDetails')->name('blogDetails');
        Route::get('/contact-us', 'contactUs')->name('contactUs');
        Route::post('/save-contact-us', 'saveContactUs')->name('saveContactUs');

    });
});
