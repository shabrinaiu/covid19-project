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

Route::post('public-response', 'PublicResponseController@storeAsJson')
    ->name('store-public-response');
Route::get('public-response/json-beta-static/{country}', 'PublicResponseController@getBetaStaticJson')
    ->name('json-beta-static');
Route::get('public-response/json-beta-dynamic/{firstDate}/{endDate}/{country}', 'PublicResponseController@getBetaDynamicJson')
    ->name('json-beta-dynamic');

Route::get('public-response/json-latest-news/{count}', 'PublicResponseController@jsonLatestNews')
    ->name('json-latest-news');
