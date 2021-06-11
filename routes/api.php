<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//5. mengambil data negara sesuai slug dan tgl yg diambil
Route::get('/country-json/{slug}/{date}', 'ReportsController@showCountryJson')->name("country-json");

//6. mengambil data negara sesuai slug dan sesuai rentang periode yg diambil
Route::get('/country-json/{slug}/{firstDate}/{endDate}', 'ReportsController@showCountryPeriodJson')->name("country-json");

// seed update country details
Route::post('seed-country-details', 'ReportsController@seedCountryDetails')
    ->name('seed-country-details');

Route::post('public-response', 'PublicResponseController@storeAsJson')
    ->name('store-public-response'); //menambahkan public response
Route::get('public-response/json-allbeta-static', 'PublicResponseController@getAllBetaStaticJson')
    ->name('json-allbeta-static'); //1. mengambil rata2 dari semua response value
Route::get('public-response/json-beta-static/{country}', 'PublicResponseController@getBetaStaticJson')
    ->name('json-beta-static'); //2. mengambil rerata response value dari negara yg dicari
Route::get('public-response/json-beta-dynamic/{firstDate}/{endDate}/{country}', 'PublicResponseController@getBetaDynamicJson')
    ->name('json-beta-dynamic'); //3. mengambil rerata reponse value sesuai dgn periode yg diinputkan

Route::get('public-response/json-latest-news/{count}', 'PublicResponseController@jsonLatestNews')
    ->name('json-latest-news'); //mengambil berita terakhir sejumlah {count}
