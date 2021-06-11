<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndonesiaController;

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

    //mengambil nilai Beta statis
    Route::get('public-response/get-beta-static/{country}', 'PublicResponseController@getBetaStatic')
        ->name('get-beta-static');

    //mengambil nilai beta dinamis
    Route::get('public-response/get-beta-dynamic/{firstDate}/{endDate}/{country}', 'PublicResponseController@getBetaDynamic')
        ->name('get-beta-dynamic');

    //mengambill berita terakhir dgn input jumlah berita
    Route::get('public-response/get-latest-news/{count}', 'PublicResponseController@getLatestNews')
        ->name('get-latest-news');
});

Route::prefix('predictions')->name('predictions.')->group(function(){
    Route::prefix('indonesia')->name('indonesia.')->group(function(){
        Route::get('/', 'IndonesiaController@index')->name('index');
        Route::post('/', 'IndonesiaController@dateFilter')->name('date-filter');
    });
});


