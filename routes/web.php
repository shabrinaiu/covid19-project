<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.reports.home');
});

Route::get('/dashboard', 'SiteController@index')->name('dashboard');
Route::get('/home', 'ReportsController@home')->name('home');


Route::resource('public-response', 'PublicResponseController');

Route::prefix('reports')->group(function () {
    // Route::get('users', function () {
    // });
    Route::get('/', 'ReportsController@index')->name('reports.index');
    Route::get('/global', 'ReportsController@global')->name('global.index');

    // Route::get('/', 'ReportsController@index')->name('home.index');
    // Route::get('/home', 'ReportsController@home')->name('home.index');
    Route::get('/countries', 'ReportsController@countries')->name('countries.index');
    Route::get('/countries/{selected}', 'ReportsController@show')->name("countries.show");

    Route::get('/compare', 'ReportsController@compareCountryData')->name('compare.index');
    Route::post('/compare', 'ReportsController@processComparedData')->name('compare.post');

    Route::get('/compare-all', 'ReportsController@compareAllCountries')->name('compare-all.index');
    Route::post('/compare-all', 'ReportsController@processAllCountries')->name('compare-all.post');

    Route::get('public-response/get-beta-static/{country}', 'PublicResponseController@getBetaStatic')
        ->name('get-beta-static');
    Route::get('public-response/get-beta-dynamic/{country}', 'PublicResponseController@getBetaDynamic')
        ->name('get-beta-dynamic');
    Route::get('public-response/get-latest-news/{count}', 'PublicResponseController@getLatestNews')
        ->name('get-latest-news');
});
