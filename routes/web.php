<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', 'SiteController@index')->name('dashboard');

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
});

